<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .info-box {
            background: #f5f5f5;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Pesan Baru dari Warung Soto Website</h2>

        <div class="info-box">
            <p><strong>Nama:</strong> {{ $contact->name }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            <p><strong>No. Telepon:</strong> {{ $contact->phone }}</p>
            <p><strong>Subjek:</strong> {{ $contact->subject }}</p>
            <p><strong>Tanggal:</strong> {{ $contact->created_at->format('d M Y H:i') }}</p>
        </div>

        <h3>Pesan:</h3>
        <p>{!! nl2br(e($contact->message)) !!}</p>

        <hr>
        <p style="font-size: 12px; color: #666;">
            Balas ke: <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
        </p>
    </div>
</body>

</html>
