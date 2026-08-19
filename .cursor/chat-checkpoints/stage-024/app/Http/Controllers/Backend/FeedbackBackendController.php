<?php

namespace App\Http\Controllers\Backend;

use App\Exports\FeedbackExport;
use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FeedbackBackendController extends Controller
{
    public function index(Request $request)
    {
        $feedback = $this->filteredQuery($request)
            ->with('user')
            ->latest()
            ->get();

        return view('backend.feedback.index', [
            'feedback' => $feedback,
            'filters' => [
                'q' => $request->get('q', ''),
                'date_from' => $request->get('date_from', ''),
                'date_to' => $request->get('date_to', ''),
            ],
        ]);
    }

    public function export(Request $request)
    {
        $filename = 'customer-feedback-' . now()->format('Y-m-d-His') . '.xlsx';

        return Excel::download(
            new FeedbackExport($this->filteredQuery($request)),
            $filename
        );
    }

    public function show($id)
    {
        $item = Feedback::with('user')->findOrFail($id);

        return view('backend.feedback.show', compact('item'));
    }

    public function destroy($id)
    {
        $item = Feedback::findOrFail($id);
        $item->delete();

        return redirect()
            ->route('manager.feedback.index')
            ->with('success', 'Feedback deleted successfully.');
    }

    protected function filteredQuery(Request $request): Builder
    {
        $query = Feedback::query();

        if ($request->filled('q')) {
            $term = trim((string) $request->q);
            $query->where(function (Builder $q) use ($term) {
                $q->where('email', 'like', "%{$term}%")
                    ->orWhere('subject', 'like', "%{$term}%")
                    ->orWhere('message', 'like', "%{$term}%")
                    ->orWhereHas('user', function (Builder $userQuery) use ($term) {
                        $userQuery->where('name', 'like', "%{$term}%")
                            ->orWhere('email', 'like', "%{$term}%")
                            ->orWhere('phone_number', 'like', "%{$term}%");
                    });
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        return $query;
    }
}
