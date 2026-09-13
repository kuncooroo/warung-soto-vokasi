<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFaqRequest;
use App\Http\Requests\Admin\UpdateFaqRequest;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('order')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(StoreFaqRequest $request)
    {
        Faq::create([
            ...$request->validated(),
            'order' => Faq::max('order') + 1,
        ]);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil ditambahkan');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        $faq->update($request->validated());
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil diperbarui');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil dihapus');
    }

    public function move(Faq $faq, string $direction)
    {
        abort_unless(in_array($direction, ['up', 'down']), 422);

        $neighbor = $direction === 'up'
            ? Faq::where('order', '<', $faq->order)->orderByDesc('order')->first()
            : Faq::where('order', '>', $faq->order)->orderBy('order')->first();

        if ($neighbor) {
            [$faq->order, $neighbor->order] = [$neighbor->order, $faq->order];
            $faq->save();
            $neighbor->save();
        }

        return back();
    }
}