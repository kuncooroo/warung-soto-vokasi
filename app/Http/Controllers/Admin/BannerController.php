<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBannerRequest;
use App\Http\Requests\Admin\UpdateBannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('page')->orderByDesc('id')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(StoreBannerRequest $request)
    {
        $banner = new Banner();
        $banner->page = $request->page;
        $banner->title = $request->title;
        $banner->subtitle = $request->subtitle;
        $banner->button_text = $request->button_text;
        $banner->button_url = $request->button_url;
        $banner->is_active = $request->boolean('is_active', true);

        if ($request->hasFile('background_image')) {
            $banner->background_image = $this->storeImage($request);
        }

        $banner->save();

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil ditambahkan');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $banner->page = $request->page;
        $banner->title = $request->title;
        $banner->subtitle = $request->subtitle;
        $banner->button_text = $request->button_text;
        $banner->button_url = $request->button_url;
        $banner->is_active = $request->boolean('is_active', false);

        if ($request->hasFile('background_image')) {
            $banner->background_image = $this->storeImage($request);
        }

        $banner->save();

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil diperbarui');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil dihapus');
    }

    private function storeImage(Request $request): string
    {
        $image = $request->file('background_image');
        $imageName = Str::random(24) . '.' . $this->extFromMime($image->getMimeType());
        $image->move(public_path('images/banners'), $imageName);
        return 'images/banners/' . $imageName;
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