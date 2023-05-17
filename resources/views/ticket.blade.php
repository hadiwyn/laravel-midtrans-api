<!DOCTYPE html>
<html>

<head>
    <title>Tiket Elektronik</title>
    <style>
        /* CSS styles for formatting */
        .container {
            width: auto;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 40px;
        }

        .header {
            text-align: center;
        }

        .header h1 {
            font-size: 70px;
            margin: 0;
            margin-top: 0;
        }

        .header img {
            margin-top: 100;
            width: 500px;
            margin-bottom: 30;
        }

        .info {
            margin-top: 60px;
        }

        .info p {
            font-size: 30px;
            margin: 0;
        }

        .info span {
            font-weight: bold;
        }

        .details {
            margin-top: 50px;
        }

        .details table {
            font-size: 30;
            width: 100%;
            border-collapse: collapse;
        }

        .details th,
        .details td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        .details th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 100px;
            text-align: center;
        }

        /* Media query for screens smaller than 600px */
        @media (max-width: 600px) {
            .container {
                width: 100%;
                margin: 0;
                border: 0;
                padding: 10px;
            }

            /* CSS styles for other elements */
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <img src="{{ asset('logo.png') }}" alt="Company Logo">
            <h1>Tiket Wisata Elektronik</h1>
            <h1>Daerah Donorojo</h1>
        </div>
        <div class="info">
            <p>Nama: <span>{{ $order->name }}</span></p>
            <p>Nomor Telepon: <span>{{ $order->phone }}</span></p>
            <p>Tanggal Pembelian: <span>{{ $order->created_at }}</span></p>
            <p>Tanggal Kunjungan: <span>{{ $order->date_visit }}</span></p>
        </div>
        <div class="details">
            <table>
                <tr>
                    <th>Nama Wisata</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                </tr>
                <tr>
                    <td>
                        {{ $order->tour_name }}
                    </td>
                    <td>
                        {{ $order->qty }}
                    </td>
                    <td>Rp.
                        {{ $order->price }}
                    </td>
                </tr>
                <tr>
                    <th colspan="2">Total</th>
                    <th>Rp.
                        {{ $order->total_price }}
                    </th>
                </tr>
            </table>
        </div>
        <div class="footer">
            <p style="font-size: 30;">Terima kasih telah membeli tiket wisata dari daerah kami. Harap
                <b>*SCREENSHOOT*</b> tiket elektronik ini untuk ditunjukkan petugas untuk pemeriksaan.
                <b>Setelah anda keluar dari halaman ini, sistem tidak dapat menampilkan tiket yang anda beli lagi.</b>
                Jika ada masalah dengan tiket, silakan hubungi kami melalui email atau nomor telepon yang tercantum.
