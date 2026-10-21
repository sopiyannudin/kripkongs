<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - Kripkongs</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #fcf8f2; }
        .navbar { background: linear-gradient(135deg, #2c1d0c, #4a2e12) !important; }
        .card { transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius: 18px; overflow: hidden; }
        .card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(217, 119, 6, 0.25); }
        .product-img { height: 220px; object-fit: cover; width: 100%; transition: transform 0.5s ease; }
        .card:hover .product-img { transform: scale(1.05); }
        .img-container { overflow: hidden; position: relative; background-color: #eee; }
        .btn-custom { background-color: #d97706; color: white; border-radius: 30px; font-weight: 600; }
        .btn-custom:hover { background-color: #b45309; color: white; }
        .btn-upload {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.65);
            color: #fff;
            border-radius: 20px;
            padding: 5px 12px;
            font-size: 0.78rem;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.3);
            transition: all 0.2s;
            z-index: 2;
        }
        .btn-upload:hover { background: #d97706; color: #fff; }
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
                    <li class="nav-item"><a class="nav-link active fw-semibold text-warning" href="{{ route('katalog') }}"><i class="fa-solid fa-store me-1"></i> Katalog Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pesan') }}"><i class="fa-solid fa-cart-shopping me-1"></i> Pesan</a></li>
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

    <!-- HEADER KATALOG -->
    <div class="bg-white py-5 shadow-sm text-center border-bottom">
        <div class="container">
            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-2">Pilihan Terbaik</span>
            <h1 class="fw-bold text-dark mb-2">Katalog Produk Unggulan</h1>
            <p class="text-muted mb-0">Nikmati aneka varian rasa keripik singkong renyah kualitas premium!</p>
        </div>
    </div>

    <!-- DAFTAR PRODUK BERGAMBAR -->
    <main class="container my-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-4 mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @foreach($products as $product)
                @php
                    // Merubah backslash (\) menjadi slash (/) agar URL gambar valid
                    $pathGambar = str_replace('\\', '/', $product->gambar);
                    
                    // Cek apakah berupa URL eksternal atau file lokal public
                    if (\Illuminate\Support\Str::startsWith($pathGambar, ['http://', 'https://'])) {
                        $urlGambar = $pathGambar;
                    } else {
                        $urlGambar = asset($pathGambar);
                    }
                @endphp

                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm position-relative">
                        <!-- CONTAINER GAMBAR & TOMBOL UPLOAD -->
                        <div class="img-container">
                            <!-- HANYA ADMIN YANG DAPAT MELIHAT TOMBOL UPLOAD -->
                            @if(Auth::check() && Auth::user()->role === 'admin')
                                <button class="btn btn-upload shadow-sm" data-bs-toggle="modal" data-bs-target="#uploadModal{{ $product->id }}">
                                    <i class="fa-solid fa-camera me-1"></i> Ganti Gambar
                                </button>
                            @endif
                            
                            <img src="{{ $urlGambar }}" class="product-img" alt="{{ $product->nama }}">
                        </div>

                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-warning text-dark rounded-pill px-3 py-1 fw-bold">{{ $product->kategori }}</span>
                                <small class="text-muted"><i class="fa-solid fa-tag me-1"></i>{{ $product->varian }}</small>
                            </div>
                            <h4 class="card-title fw-bold text-dark mb-2">{{ $product->nama }}</h4>
                            <p class="card-text text-muted flex-grow-1">{{ $product->deskripsi }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                <div>
                                    <small class="text-muted d-block" style="font-size: 0.75rem;">Harga per Bungkus</small>
                                    <span class="text-danger fw-bold fs-5">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                                </div>
                                <a href="{{ route('pesan') }}" class="btn btn-custom px-4 py-2 shadow-sm"><i class="fa-solid fa-cart-shopping me-1"></i> Beli</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODAL UPLOAD GAMBAR UNTUK ADMIN -->
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <div class="modal fade" id="uploadModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4 border-0 p-3">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title fw-bold"><i class="fa-solid fa-image text-warning me-2"></i>Ganti Gambar {{ $product->nama }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('product.uploadGambar', $product->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3 text-center">
                                            <label class="form-label d-block text-start fw-semibold">Pilih File Gambar Baru:</label>
                                            <input type="file" name="gambar_baru" class="form-control rounded-pill px-3" accept="image/*" required>
                                            <small class="text-muted d-block mt-2 text-start">Format: JPG, PNG, WEBP (Maksimal 2MB)</small>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0 d-flex justify-content-between">
                                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-custom px-4">Upload & Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
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