<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order)
    {
    }

    public function envelope()
    {
        return new \Illuminate\Mail\Mailables\Envelope(
            subject: 'Konfirmasi Pesanan - ' . $this->order->order_number,
        );
    }

    public function content()
    {
        return new \Illuminate\Mail\Mailables\Content(
            view: 'emails.order-confirmation',
            with: [
                'order' => $this->order,
            ],
        );
    }

    public function attachments()
    {
        return [];
    }
}