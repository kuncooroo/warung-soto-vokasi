<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #8B4513; color: white; padding: 20px; text-align: center; border-radius: 5px; }
        .content { background: #f5f5f5; padding: 20px; margin: 20px 0; border-radius: 5px; }
        .item { background: white; padding: 10px; margin: 10px 0; border-left: 4px solid #8B4513; }
        .footer { text-align: center; color: #666; font-size: 12px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🍜 Warung Soto Vokasi</h1>
            <p>Konfirmasi Pesanan</p>
        </div>

        <div class="content">
            <p>Halo {{ $order->customer_name }},</p>
            
            <p>Terima kasih telah memesan di Warung Soto Vokasi. Berikut detail pesanan Anda:</p>

            <h3>Detail Pesanan</h3>
            <p><strong>Nomor Pesanan:</strong> {{ $order->order_number }}</p>
            <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>

            <h3>Item Pesanan</h3>
            {{-- Pastikan relasi items sudah dimuat --}}
            @foreach($order->items as $item)
            <div class="item">
                <strong>{{ $item->product->name ?? 'Produk' }}</strong><br>
                Jumlah: {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}<br>
                Subtotal: Rp {{ number_format($item->subtotal, 0, ',', '.') }}
            </div>
            @endforeach

            <h3 style="border-top: 2px solid #ddd; padding-top: 10px;">
                Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}
            </h3>

            <p><strong>Alamat Pengiriman:</strong><br>{{ $order->customer_address }}</p>

            @if($order->notes)
            <p><strong>Catatan:</strong><br>{{ $order->notes }}</p>
            @endif
        </div>

        <div class="footer">
            <p>Status pembayaran: <strong>{{ ucfirst($order->payment_status) }}</strong></p>
            <p>&copy; {{ date('Y') }} Warung Soto Vokasi. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>