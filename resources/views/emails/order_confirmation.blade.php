<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #166534; 
            padding: 20px;
            margin: 0;
        }

        .receipt-wrapper {
            max-width: 350px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.2);
            border: 1px dashed #ddd;
        }

        .receipt-header {
            text-align: center;
        }

        .receipt-header img {
            width: 50px;
            margin-bottom: 5px;
        }

        h2 {
            margin: 5px 0;
            font-size: 18px;
        }

        .subtitle {
            font-size: 12px;
            color: #444;
            line-height: 1.4;
        }

        .section-title {
            margin-top: 15px;
            font-weight: bold;
            border-top: 1px dashed #999;
            padding-top: 10px;
        }

        .item {
            margin: 10px 0;
            font-size: 13px;
        }

        .item strong {
            font-size: 14px;
        }

        .line {
            border-top: 1px dashed #ccc;
            margin: 12px 0;
        }

        .total-box {
            font-size: 16px;
            font-weight: bold;
            text-align: right;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 15px;
            color: #555;
        }

        .qr-wrapper {
            text-align: center;
            margin-top: 10px;
        }

        .qr-wrapper img {
            width: 120px;
        }
    </style>
</head>

<body>

<div class="receipt-wrapper">

    <div class="receipt-header">
        <img src="https://cdn-icons-png.flaticon.com/512/869/869636.png" alt="icon">
        <h2>Warung Soto Vokasi</h2>
        <p class="subtitle">
            Konfirmasi Pesanan<br>
            Jl. Veteran Jl. Cikampek No.15,Penanggungan, Kec. Klojen,Kota Malang, Jawa<br>
            Terima kasih telah memesan
        </p>
    </div>

    <div class="line"></div>

    <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
    <p><strong>Nomor Pesanan:</strong> {{ $order->order_number }}</p>
    <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>

    <div class="section-title">Item Pesanan</div>

    @foreach($order->items as $item)
    <div class="item">
        <strong>{{ $item->product->name ?? 'Produk' }}</strong><br>
        {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
        <div style="text-align:right;">
            <strong>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong>
        </div>
    </div>
    @endforeach

    <div class="line"></div>

    <div class="total-box">
        Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}
    </div>

    <p><strong>Alamat Pengiriman:</strong><br>{{ $order->customer_address }}</p>

    @if($order->notes)
        <p><strong>Catatan:</strong><br>{{ $order->notes }}</p>
    @endif

    <div class="footer">
        Status pembayaran: <strong>{{ ucfirst($order->payment_status) }}</strong>
        <br>Terima kasih telah memesan di tempat kami
    </div>

    <div class="qr-wrapper">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $order->order_number }}">
    </div>

</div>

</body>
</html>
