<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f6f8fa;
            font-family: 'Inter', sans-serif;
            margin: 0;
            min-height: 100vh;
        }
        .navbar {
            background: #044FA0;
            color: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar .brand {
            font-weight: 600;
            font-size: 1.2rem;
        }
        .container {
            max-width: 600px;
            margin: 3rem auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(4, 79, 160, 0.08);
            padding: 2.5rem 2rem;
            text-align: center;
        }
        .greeting {
            font-size: 1.5rem;
            color: #044FA0;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .logout-btn {
            background: #fff;
            color: #044FA0;
            border: 1px solid #044FA0;
            padding: 0.5rem 1.2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }
        .logout-btn:hover {
            background: #044FA0;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="brand">Dashboard</div>
        <form action="{{ route('logout') }}" method="POST" style="margin:0;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
    <div class="container">
        <div class="greeting">Halo, {{ Auth::user()->nama ?? Auth::user()->username }}!</div>
        <p>Selamat datang di dashboard aplikasi pengaduan siswa.</p>
    </div>
</body>
</html>
