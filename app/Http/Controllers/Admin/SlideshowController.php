<?php

namespace App\Http\Controllers\Admin;

use App\Services\Interfaces\SlideshowServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slideshow;

class SlideshowController extends Controller
{
    public function __construct(protected SlideshowServiceInterface $slideshowService)
    {
        $this->slideshowService = $slideshowService;
    }

    public function index()
    {
        if (\Gate::denies('admin.slideshow.index')) {
            return redirect()->route('admin.dashboard')->with('danger', 'Unauthorized access attempt.');
        }

        $data = [];
        $data['slideshows'] = Slideshow::whereNull('deleted_at')->get();

        return view('admin.slideshows.index', $data);
    }

    public function create()
    {
        if (\Gate::denies('admin.slideshow.create')) {
            return redirect()->route('admin.dashboard')->with('danger', 'Unauthorized access attempt.');
        }

        return view('admin.slideshows.create');
    }

    public function store(Request $request)
    {
        if (\Gate::denies('admin.slideshow.create')) {
            return redirect()->route('admin.dashboard')->with('danger', 'Unauthorized access attempt.');
        }

        $validated = $request->validate([
            'is_active' => 'required|boolean',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'required|string|max:255',
        ]);

        $this->slideshowService->create($validated);

        return redirect()->route('admin.slideshow.index')->with('success', 'Slideshow created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        if (\Gate::denies('admin.slideshow.edit')) {
            return redirect()->route('admin.dashboard')->with('danger', 'Unauthorized access attempt.');
        }

        $data = [];
        $data['slideshow'] = Slideshow::findOrFail($id);

        return view('admin.slideshows.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        if (\Gate::denies('admin.slideshow.edit')) {
            return redirect()->route('admin.dashboard')->with('danger', 'Unauthorized access attempt.');
        }

        $validated = $request->validate([
            'is_active' => 'required|boolean',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'required|string|max:255',
        ]);

        $this->slideshowService->update((int)$id, $validated);

        return redirect()->route('admin.slideshow.index')->with('success', 'Slideshow updated successfully.');
    }

    public function destroy(string $id)
    {
        if (\Gate::denies('admin.slideshow.delete')) {
            return redirect()->route('admin.dashboard')->with('danger', 'Unauthorized access attempt.');
        }

        $this->slideshowService->delete((int)$id);

        return redirect()->route('admin.slideshow.index')->with('success', 'Slideshow deleted successfully.');
    }
}
