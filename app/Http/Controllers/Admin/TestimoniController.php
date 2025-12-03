<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    private function checkLogin()
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }
    }

    public function index()
    {
        $this->checkLogin();
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