<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display testimonial page with all approved testimonials
     */
    public function index()
    {
        // Ambil semua testimoni yang sudah di-approve, urutkan terbaru
        $approvedTestimonials = Testimoni::where('is_approved', true)
                                        ->latest()
                                        ->get();
        
        return view('public.testimonial', compact('approvedTestimonials'));
    }

    /**
     * Store new testimonial from user
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle upload gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('testimonials', $imageName, 'public');
            $imagePath = 'storage/' . $imagePath;
        }

        // Simpan testimoni ke database
        Testimoni::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'rating' => $validated['rating'],
            'message' => $validated['message'],
            'image' => $imagePath,
            'is_approved' => false // Default belum di-approve, perlu approval admin
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('testimonial')
                        ->with('success', 'Terima kasih! Testimoni Anda telah dikirim dan sedang menunggu persetujuan admin.');
    }
}