<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 20px; border-radius: 5px; }
        .order-number { background: #8B4513; color: white; padding: 20px; text-align: center; font-size: 24px; border-radius: 5px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="success">
            <h2>✓ Pembayaran Berhasil!</h2>
            <p>Pesanan Anda telah dikonfirmasi dan sedang diproses.</p>
        </div>

        <div class="order-number">
            {{ $order->order_number }}
        </div>

        <p>Halo {{ $order->customer_name }},</p>
        
        <p>Kami telah menerima pembayaran Anda sebesar Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>

        <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method ?? 'Midtrans' }}</p>
        <p><strong>Tanggal Pembayaran:</strong> {{ $order->updated_at->format('d M Y H:i') }}</p>

        <p>Pesanan Anda akan segera disiapkan dan disampaikan ke alamat:</p>
        <p>{{ $order->customer_address }}</p>

        <p>Terima kasih telah berbelanja di Warung Soto Vokasi!</p>

        <hr>
        <p style="font-size: 12px; color: #666;">
            Jika ada pertanyaan, silakan hubungi kami di (021) 123-4567 atau info@warungsoto.com
        </p>
    </div>
</body>
</html>