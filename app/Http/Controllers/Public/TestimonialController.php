<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\StoreTestimonialRequest;
use App\Models\Testimoni;
use App\Models\Banner;
use App\Models\Gallery;

class TestimonialController extends Controller
{
    public function index()
    {
        $approvedTestimonials = Testimoni::where('is_approved', true)
                                        ->latest()
                                        ->get();

        $banner = Banner::active()->where('page', 'testimonial')->latest('id')->first();
        $galleries = Gallery::active()->orderBy('order')->get();

        return view('public.testimonial', compact('approvedTestimonials', 'banner', 'galleries'));
    }

    public function store(StoreTestimonialRequest $request)
    {
        $validated = $request->validated();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = 'storage/' . $request->file('image')->store('testimonials', 'public');
        }

        Testimoni::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'rating' => $validated['rating'],
            'message' => $validated['message'],
            'image' => $imagePath,
            'is_approved' => false,
        ]);

        return redirect()->route('testimonial')
                        ->with('success', 'Terima kasih! Testimoni Anda telah dikirim dan sedang menunggu persetujuan admin.');
    }
}