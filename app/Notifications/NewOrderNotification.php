<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Order $order)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pesanan Baru - ' . $this->order->order_number)
            ->greeting('Ada pesanan baru!')
            ->line('Pelanggan: ' . $this->order->customer_name)
            ->line('Nomor pesanan: ' . $this->order->order_number)
            ->line('Total: Rp ' . number_format($this->order->total_amount, 0, ',', '.'))
            ->line('Metode pembayaran: ' . ($this->order->payment_method ?? 'Belum dipilih'))
            ->action('Lihat Pesanan', route('admin.orders.show', $this->order));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
        ];
    }
}