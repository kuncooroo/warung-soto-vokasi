<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
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
        $faqs = Faq::orderBy('order')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $this->checkLogin();
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string'
        ]);

        Faq::create($request->all());
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil ditambahkan');
    }

    public function edit(Faq $faq)
    {
        $this->checkLogin();
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string'
        ]);

        $faq->update($request->all());
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil diperbarui');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil dihapus');
    }
}