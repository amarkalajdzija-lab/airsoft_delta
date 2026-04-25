<?php

namespace App\Http\Controllers;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $images = Gallery::latest()->get();
        return view('gallery', compact('images'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'title' => $request->title,
            'image' => $path,
        ]);

        return redirect()->route('gallery')
                         ->with('success', 'Slika je uspješno dodana.');
    }

    public function destroy($id)
{
    $image = Gallery::findOrFail($id);
    Storage::disk('public')->delete($image->image);
    $image->delete();

    return redirect()->route('gallery')
                     ->with('success', 'Slika je uspješno obrisana.');
}
}

