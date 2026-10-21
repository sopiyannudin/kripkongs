<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kripkongs - Keripik Singkong Premium & Renyah</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #fcf8f2; }
        .navbar { background: linear-gradient(135deg, #2c1d0c, #4a2e12) !important; }
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset("images/beranda.jpg") }}');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            border-bottom: 5px solid #d97706;
        }
        .btn-custom {
            background-color: #d97706;
            color: white;
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 600;
        }
        .btn-custom:hover { background-color: #b45309; color: white; }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="{{ route('home') }}"><i class="fa-solid fa-seedling text-warning me-2"></i>Kripkongs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-3">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link text-warning fw-semibold" href="{{ route('katalog') }}"><i class="fa-solid fa-store me-1"></i> Katalog Produk</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('pesan') }}"><i class="fa-solid fa-cart-shopping me-1"></i> Pesan</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#tentang">Tentang Kami</a></li>
                    
                    <!-- HAK AKSES PADA NAVBAR -->
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-sm rounded-pill px-3 fw-bold text-dark">
                                <i class="fa-solid fa-gauge me-1"></i> Dashboard Admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                    <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="#" class="btn btn-outline-warning btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#loginModal">
                                <i class="fa-solid fa-user me-1"></i> Login Admin
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <header class="hero-section text-center">
        <div class="container">
            <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill fw-bold">UMKM Berbasis Digital</span>
            <h1 class="display-4 fw-bold mb-3">Sensasi Renyah Keripik Singkong Pilihan</h1>
            <p class="lead mb-4 col-lg-8 mx-auto">Diproduksi secara higienis dengan bumbu rempah khas Nusantara yang meresap sempurna di setiap gigitan.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('katalog') }}" class="btn btn-custom btn-lg shadow"><i class="fa-solid fa-eye me-2"></i>Lihat Katalog</a>
                <a href="{{ route('pesan') }}" class="btn btn-outline-light btn-lg rounded-pill px-4 shadow"><i class="fa-solid fa-cart-shopping me-2"></i>Pesan Sekarang</a>
            </div>
        </div>
    </header>

    <!-- ABOUT US SECTION -->
    <main class="container my-5">
        <section id="tentang" class="my-5 py-4">
            <div class="row align-items-center bg-white p-5 rounded-4 shadow-sm">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-3 text-dark">Tentang Kripkongs</h2>
                    <p class="text-muted">Kripkongs adalah inisiatif UMKM digital lokal yang berfokus pada pengolahan hasil bumi singkong berkualitas tinggi menjadi cemilan modern bercitarasa tinggi. Kami berkomitmen untuk mengangkat produk lokal agar bisa bersaing di pasaran digital.</p>
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-2"><i class="fa-solid fa-check text-warning me-2"></i> 100% Singkong Segar Pilihan</li>
                        <li class="mb-2"><i class="fa-solid fa-check text-warning me-2"></i> Tanpa Bahan Pengawet Buatan</li>
                        <li class="mb-2"><i class="fa-solid fa-check text-warning me-2"></i> Higienis & Standar Kualitas Tinggi</li>
                    </ul>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('images/kami.jpg') }}" alt="Tentang Kami Kripkongs" class="img-fluid rounded-4 shadow">
                </div>
            </div>
        </section>
    </main>

    <!-- MODAL LOGIN ADMIN -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 p-4">
                <div class="modal-header border-0">
                    <h4 class="modal-title fw-bold">Login Pengelola</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- FORM LOGIN AKTIF DENGAN ROUTE & CSRF -->
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email Administrator</label>
                            <input type="email" name="email" class="form-control rounded-pill px-3" placeholder="admin@kripkongs.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kata Sandi</label>
                            <input type="password" name="password" class="form-control rounded-pill px-3" placeholder="••••••••" required>
                        </div>
                        <button type="submit" class="btn btn-custom w-100 mt-2">Masuk Dashboard</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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