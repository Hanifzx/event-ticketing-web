<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>E-Ticket</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .ticket-box {
            border: 2px dashed #ccc;
            padding: 20px;
            position: relative;
        }
        .header {
            border-bottom: 2px solid #fc563c;
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: table;
            width: 100%;
        }
        .header-left {
            display: table-cell;
            text-align: left;
            vertical-align: middle;
        }
        .header-right {
            display: table-cell;
            text-align: right;
            vertical-align: middle;
        }
        .event-title {
            font-size: 24px;
            font-weight: bold;
            color: #111827;
            margin: 0;
        }
        .event-meta {
            color: #6b7280;
            font-size: 14px;
        }
        .content {
            display: table;
            width: 100%;
        }
        .info-column {
            display: table-cell;
            width: 65%;
            vertical-align: top;
        }
        .qr-column {
            display: table-cell;
            width: 35%;
            text-align: center;
            vertical-align: top;
        }
        .label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
        }
        .value {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .footer {
            margin-top: 30px;
            font-size: 10px;
            text-align: center;
            color: #9ca3af;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        .badge {
            background-color: #d1fae5;
            color: #065f46;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="ticket-box">
        <div class="header">
            <div class="header-left">
                <h1 class="event-title">{{ $booking->ticket->event->name }}</h1>
                <div class="event-meta">
                    {{ $booking->ticket->event->location }}
                </div>
            </div>
            <div class="header-right">
                <span class="badge">TIKET {{ $sequence }}</span>
            </div>
        </div>

        <div class="content">
            <div class="info-column">
                <div class="label">Waktu Pelaksanaan</div>
                <div class="value">
                    {{ format_date($booking->ticket->event->date_time) }}, 
                    {{ format_time($booking->ticket->event->date_time) }} WIB
                </div>

                <div class="label">Pemegang Tiket</div>
                <div class="value">{{ $booking->user->name }}</div>

                <div class="label">Jenis Tiket</div>
                <div class="value">{{ $booking->ticket->name }}</div>

                <div class="label">Kode Unik Tiket</div>
                <div class="value">#{{ $ticketId }}</div>
            </div>

            <div class="qr-column">
                <img src="data:image/svg+xml;base64,{{ $qrcode }}" width="150" />
                <p style="font-size: 10px; color: #666; margin-top: 5px;">Scan untuk Validasi</p>
            </div>
        </div>

        <div class="footer">
            Tiket {{ $sequence }} dari {{ $booking->quantity }} tiket dalam Pesanan #{{ $booking->id }}.<br>
            Dilarang menggandakan tiket ini. Satu tiket berlaku untuk satu orang.<br>
            Dicetak pada: {{ now()->format('d M Y H:i') }}
        </div>
    </div>
</body>
</html>