<?php

namespace App\Http\Controllers;

use App\Models\Slideshow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideshowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slideshows = Slideshow::orderBy('created_at', 'asc')->get();
        return view('admin.slideshow.index', compact('slideshows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Slideshow::count() >= 3) {
            return redirect()->route('admin.slideshow.index')->withErrors(['max' => 'Maksimal 3 slide diperbolehkan.']);
        }
        return view('admin.slideshow.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Enforce maximum of 3 slides total
        if (Slideshow::count() >= 3) {
            return redirect()->route('admin.slideshow.index')->withErrors(['max' => 'Maksimal 3 slide diperbolehkan. Hapus salah satu untuk menambah baru.']);
        }
        $data = $request->validate([
            'files' => 'nullable|image|max:3072',
        ]);

        if ($request->hasFile('files')) {
            $path = $request->file('files')->store('slideshows', 'public');
            $data['files'] = $path; // stored relative to storage/app/public
        }

        Slideshow::create($data);

        return redirect()->route('admin.slideshow.index')->with('success', 'Slide berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slideshow $slideshow)
    {
        return view('admin.slideshow.show', compact('slideshow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slideshow $slideshow)
    {
        return view('admin.slideshow.edit', compact('slideshow'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slideshow $slideshow)
    {
        $data = $request->validate([
            'files' => 'nullable|image|max:3072',
        ]);

        if ($request->hasFile('files')) {
            // delete old if exists
            if ($slideshow->files && Storage::disk('public')->exists($slideshow->files)) {
                Storage::disk('public')->delete($slideshow->files);
            }
            $data['files'] = $request->file('files')->store('slideshows', 'public');
        }

        $slideshow->update($data);

        return redirect()->route('admin.slideshow.index')->with('success', 'Slide berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slideshow $slideshow)
    {
        if ($slideshow->files && Storage::disk('public')->exists($slideshow->files)) {
            Storage::disk('public')->delete($slideshow->files);
        }
        $slideshow->delete();

        return redirect()->route('admin.slideshow.index')->with('success', 'Slide berhasil dihapus');
    }
}
