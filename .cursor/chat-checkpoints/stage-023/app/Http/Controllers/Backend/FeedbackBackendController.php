<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackBackendController extends Controller
{
    public function index(Request $request)
    {
        $feedback = Feedback::with('user')
            ->latest()
            ->get();

        return view('backend.feedback.index', compact('feedback'));
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
}
