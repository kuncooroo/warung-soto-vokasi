<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactNotification;

class ContactController extends Controller
{
    public function contact()
    {
        return view('public.contact');
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'subject' => 'required|string',
            'message' => 'required|string'
        ]);

        $message = ContactMessage::create($request->all());

        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactNotification($message));

        return back()->with('success', 'Pesan dikirim. Kami akan segera menghubungi Anda!');
    }

    public function testimonial()
    {
        return view('public.testimonial');
    }

    public function storeTestimonial(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $testimoni = new Testimoni();
        $testimoni->name = $request->name;
        $testimoni->email = $request->email;
        $testimoni->message = $request->message;
        $testimoni->rating = $request->rating;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/testimonials'), $imageName);
            $testimoni->image = 'images/testimonials/' . $imageName;
        }

        $testimoni->save();

        return back()->with('success', 'Testimoni Anda akan ditampilkan setelah disetujui admin');
    }
}
