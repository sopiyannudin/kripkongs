<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pemesanan - Kripkongs</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #fcf8f2; }
        .navbar { background: linear-gradient(135deg, #2c1d0c, #4a2e12) !important; }
        .btn-custom { background-color: #d97706; color: white; border-radius: 30px; font-weight: 600; }
        .btn-custom:hover { background-color: #b45309; color: white; }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="{{ route('home') }}"><i class="fa-solid fa-seedling text-warning me-2"></i>Kripkongs</a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav align-items-center gap-3">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('katalog') }}"><i class="fa-solid fa-store me-1"></i> Katalog Produk</a></li>
                    <li class="nav-item"><a class="nav-link active fw-semibold text-warning" href="{{ route('pesan') }}"><i class="fa-solid fa-cart-shopping me-1"></i> Pesan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#tentang">Tentang Kami</a></li>
                    
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-sm rounded-pill px-3 fw-bold text-dark">
                                <i class="fa-solid fa-gauge me-1"></i> Dashboard Admin
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA PEMESANAN -->
    <main class="container my-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-4 mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-lg border-0 bg-white rounded-4 my-4">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-2">Pemesanan Online</span>
                    <h2 class="fw-bold text-dark">Formulir Pemesanan Kripkongs</h2>
                    <p class="text-muted">Isi data pengiriman kamu di bawah ini secara lengkap.</p>
                </div>
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama Pemesan</label>
                            <input type="text" name="nama_pemesan" class="form-control rounded-pill px-3 py-2" required placeholder="Contoh: Naja Fitriani">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nomor HP / WhatsApp</label>
                            <input type="text" name="nomor_hp" class="form-control rounded-pill px-3 py-2" required placeholder="08xxxxxxxxxx">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Pilih Produk</label>
                            <select name="produk_pilihan" class="form-select rounded-pill px-3 py-2" required>
                                <option value="">-- Pilih Varian Produk --</option>
                                @foreach($products as $p)
                                    <option value="{{ $p->nama }}">{{ $p->nama }} - Rp {{ number_format($p->harga, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jumlah (Bungkus)</label>
                            <input type="number" name="jumlah" class="form-control rounded-pill px-3 py-2" min="1" value="1" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Alamat Pengiriman Lengkap</label>
                        <textarea name="alamat" class="form-control rounded-4 p-3" rows="3" required placeholder="Kecamatan, Kota, Patokan rumah..."></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-custom btn-lg px-5 shadow">Kirim Pesanan Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- FOOTER DENGAN IDENTITAS KELOMPOK CC -->
    <footer class="bg-dark text-white text-center py-5 mt-5">
    <div class="container">
        <h5 class="fw-bold mb-3"><i class="fa-solid fa-seedling text-warning me-2"></i>Kripkongs UMKM</h5>
        <p class="mb-1 text-secondary">Praktikum Cloud Computing - Universitas Pamulang</p>
        <p class="small text-warning mb-2">
            <strong>Kelompok 3:</strong> Arini (Cloud Architect) | Naja (Infrastructure Engineer) | Sopiyan (Security & Governance) | Fauzan (Cost & Ops)
        </p>
        <hr class="border-secondary my-3">
        <p class="small text-muted mb-0">
            &copy; {{ date('Y') }} Kripkongs. All rights reserved.
        </p>
    </div>
</footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>