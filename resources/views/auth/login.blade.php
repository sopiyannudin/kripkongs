<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Kripkongs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow-lg border-0 rounded-4 p-4" style="width: 100%; max-width: 400px;">
        <h4 class="text-center fw-bold text-dark mb-4">🔐 Login Admin Kripkongs</h4>
        
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Email Admin</label>
                <input type="email" name="email" class="form-control rounded-pill px-3" placeholder="admin@kripkongs.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control rounded-pill px-3" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-warning fw-bold text-dark rounded-pill w-100 mt-2">Masuk Dashboard</button>
        </form>
        <div class="text-center mt-3">
            <a href="{{ route('home') }}" class="text-muted small text-decoration-none">← Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>