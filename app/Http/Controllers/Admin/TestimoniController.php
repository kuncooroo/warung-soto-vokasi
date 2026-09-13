<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimoni = Testimoni::all();
        return view('admin.testimoni.index', compact('testimoni'));
    }

    public function approve(Testimoni $testimoni)
    {
        $testimoni->is_approved = true;
        $testimoni->save();
        return back()->with('success', 'Testimoni disetujui');
    }

    public function reject(Testimoni $testimoni)
    {
        $testimoni->delete();
        return back()->with('success', 'Testimoni dihapus');
    }
}