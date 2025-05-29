<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #e6e6e6;
        }
        .header {
            background-color: #800000; /* Merah Maroon */
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .content h2 {
            margin-top: 0;
            color: #800000;
        }
        .content p {
            font-size: 16px;
            line-height: 1.5;
            margin: 10px 0;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #800000;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #a83232;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #e6e6e6;
            background-color: #f9f9f9;
        }
        .footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Selamat Datang!</h1>
        </div>
        <div class="content">
            <h2>Hai, [Nama Pengguna]</h2>
            <p>Selamat datang di sistem magang Balai Layanan Perpustakaan DPAD DIY.</p>
            <p>Kami sangat senang Anda bergabung bersama kami. Jelajahi fitur-fitur kami dan dapatkan pengalaman terbaik dalam sistem magang ini.</p>
            <a href="#" class="btn">Mulai Sekarang</a>
        </div>
        <div class="footer">
            <p>© 2025 Balai Layanan Perpustakaan DPAD DIY</p>
            <p>Email ini dikirim secara otomatis, mohon tidak membalas.</p>
        </div>
    </div>
</body>
</html>
