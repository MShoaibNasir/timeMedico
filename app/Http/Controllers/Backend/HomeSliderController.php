<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlider;
use Auth;
use Illuminate\Support\Facades\Storage;

class HomeSliderController extends Controller
{
    public function index(Request $request)
    {


        $query = HomeSlider::latest();
        if ($request->has('export')) {

            $filename = 'Policies-Category.csv';
            $headers = [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$filename",
            ];
            $classes = $query->get();
            $callback = function () use ($classes) {

                $file = fopen('php://output', 'w');
                // Header row
                fputcsv($file, ['Name', 'status']);
                foreach ($classes as $data) {
                    fputcsv($file, [
                        ucwords($data->name),
                        $data->status == 1 ? 'Active' : 'In active'
                    ]);
                }
                fclose($file);
            };
            return response()->stream($callback, 200, $headers);
        }
        $classes = $query->paginate(10);
        return view('backend.slider.index', compact('classes'));
    }

    public function create()
    {
        return view('backend.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'image' => [
                    'required',
                    'image',
                    'mimes:jpg,jpeg,png,svg',
                    'max:2048',
                    $request->type == 'mobile'
                        ? 'dimensions:width=1520,height=704'
                        : 'dimensions:width=1760,height=608',
                ],
                'status' => 'required|boolean',
                'type' => 'required|in:mobile,website',
            ],
            [
                'image.dimensions' => $request->type == 'mobile'
                    ? 'Mobile slider image must be exactly 852 × 398 pixels.'
                    : 'Website slider image must be exactly 1760 × 608 pixels.',
            ]
        );

        $logoPath = null;

        if ($request->hasFile('image')) {
            $logoPath = $request->file('image')->store('homeslider', 'public');
        }

        HomeSlider::create([
            'image' => $logoPath,
            'status' => $request->status,
            'type' => $request->type,
            'admin_id' => Auth::id(),
        ]);

        return redirect()
            ->route('manager.slider.index')
            ->with('success', 'Slider created successfully');
    }

    public function edit($id)
    {
        $class = HomeSlider::findOrFail($id);
        return view('backend.slider.edit', compact('class'));
    }

    public function update(Request $request, $id)
    {
        $class = HomeSlider::findOrFail($id);

        $request->validate(
            [
                'image' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,svg',
                    'max:2048',
                    $request->type == 'mobile'
                        ? 'dimensions:width=1520,height=704'
                        : 'dimensions:width=1760,height=608',
                ],
                'status' => 'required|boolean',
                'type' => 'required|in:mobile,website',
            ],
            [
                'image.dimensions' => $request->type == 'mobile'
                    ? 'Mobile slider image must be exactly 852 × 398 pixels.'
                    : 'Website slider image must be exactly 1760 × 608 pixels.',
            ]
        );

        $logoPath = $class->image;

        if ($request->hasFile('image')) {

            // Delete old image
            if ($class->image && Storage::disk('public')->exists($class->image)) {
                Storage::disk('public')->delete($class->image);
            }

            $logoPath = $request->file('image')->store('homeslider', 'public');
        }

        $class->update([
            'image'    => $logoPath,
            'status'   => $request->status,
            'type'     => $request->type,
            'admin_id' => Auth::id(),
        ]);

        return redirect()
            ->route('manager.slider.index')
            ->with('success', 'Slider updated successfully');
    }

    public function destroy($id)
    {
        $class = HomeSlider::findOrFail($id);
        if ($class->logo && Storage::disk('public')->exists($class->logo)) {
            Storage::disk('public')->delete($class->logo);
        }
        $class->delete();
        return redirect()->route('manager.slider.index')
            ->with('success', 'Slider deleted successfully');
    }

    // 🔥 OPTIONAL: quick toggle active/inactive
    public function toggleStatus($id)
    {
        $class = HomeSlider::findOrFail($id);

        $class->status = !$class->status;
        $class->save();

        return back()->with('success', 'Status updated successfully');
    }
}
