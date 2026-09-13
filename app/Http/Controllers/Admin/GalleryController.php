<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGalleryRequest;
use App\Http\Requests\Admin\UpdateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('order')->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(StoreGalleryRequest $request)
    {
        $gallery = new Gallery();
        $gallery->image = $this->storeImage($request);
        $gallery->caption = $request->caption;
        $gallery->order = Gallery::max('order') + 1;
        $gallery->is_active = $request->boolean('is_active', true);
        $gallery->save();

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil ditambahkan');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $gallery->caption = $request->caption;
        $gallery->is_active = $request->boolean('is_active', false);

        if ($request->hasFile('image')) {
            $gallery->image = $this->storeImage($request);
        }

        $gallery->save();

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil diperbarui');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil dihapus');
    }

    public function move(Gallery $gallery, string $direction)
    {
        abort_unless(in_array($direction, ['up', 'down']), 422);

        $neighbor = $direction === 'up'
            ? Gallery::where('order', '<', $gallery->order)->orderByDesc('order')->first()
            : Gallery::where('order', '>', $gallery->order)->orderBy('order')->first();

        if ($neighbor) {
            [$gallery->order, $neighbor->order] = [$neighbor->order, $gallery->order];
            $gallery->save();
            $neighbor->save();
        }

        return back();
    }

    private function storeImage(Request $request): string
    {
        $image = $request->file('image');
        $imageName = Str::random(24) . '.' . $this->extFromMime($image->getMimeType());
        $image->move(public_path('images/galleries'), $imageName);
        return 'images/galleries/' . $imageName;
    }

    private function extFromMime(?string $mime): string
    {
        return match ($mime) {
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/avif' => 'avif',
            'image/webp' => 'webp',
            default => 'jpg',
        };
    }
}