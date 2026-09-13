<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->get();
        return view('admin.contact.index', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        $message->is_read = true;
        $message->save();
        return view('admin.contact.show', compact('message'));
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.contact.index')->with('success', 'Pesan dihapus');
    }
}