<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
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
        $messages = ContactMessage::latest()->get();
        return view('admin.contact.index', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        $this->checkLogin();
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