<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\StoreContactRequest;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactNotification;

class ContactController extends Controller
{
    public function contact()
    {
        return view('public.contact');
    }

    public function storeContact(StoreContactRequest $request)
    {
        $message = ContactMessage::create($request->validated());

        try {
            Mail::to(config('mail.from.address'))->queue(new ContactNotification($message));
        } catch (\Exception $e) {
            Log::error('Gagal mengirim notifikasi kontak: ' . $e->getMessage());
        }

        return back()->with('success', 'Pesan dikirim. Kami akan segera menghubungi Anda!');
    }
}