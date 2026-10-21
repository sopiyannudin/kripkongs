<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Kripkongs</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #fcf8f2; }
        .navbar { background: linear-gradient(135deg, #2c1d0c, #4a2e12) !important; }
        .nav-pills .nav-link.active { background-color: #d97706 !important; }
        .card-stat { border-radius: 16px; border: none; }
    </style>
</head>
<body>

    <!-- NAVBAR KONSISTEN DENGAN HALAMAN UTAMA -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="{{ route('home') }}"><i class="fa-solid fa-seedling text-warning me-2"></i>Kripkongs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-3">
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link text-warning fw-semibold" href="{{ route('katalog') }}"><i class="fa-solid fa-store me-1"></i> Katalog Produk</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('pesan') }}"><i class="fa-solid fa-cart-shopping me-1"></i> Pesan</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}#tentang">Tentang Kami</a></li>
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-sm rounded-pill px-3 fw-bold text-dark shadow-sm">
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
                </ul>
            </div>
        </div>
    </nav>

    <!-- KONTEN DASHBOARD ADMIN -->
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Panel Kendali Toko</h3>
                <p class="text-muted mb-0">Pantau produk dan pesanan toko Kripkongs dalam satu halaman.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success rounded-4 shadow-sm mb-4 alert-dismissible fade show">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- NAV TABS 3 BAGIAN -->
        <ul class="nav nav-pills mb-4 gap-2 bg-white p-2 rounded-4 shadow-sm" id="adminTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active fw-bold px-4 rounded-pill" id="ringkasan-tab" data-bs-toggle="pill" data-bs-target="#ringkasan" type="button"><i class="fa-solid fa-chart-pie me-2"></i>1. Ringkasan Admin</button>
            </li>
            <li class="nav-item">
                <button class="nav-link fw-bold px-4 rounded-pill" id="produk-tab" data-bs-toggle="pill" data-bs-target="#produk" type="button"><i class="fa-solid fa-box me-2"></i>2. Kelola Produk</button>
            </li>
            <li class="nav-item">
                <button class="nav-link fw-bold px-4 rounded-pill" id="pesanan-tab" data-bs-toggle="pill" data-bs-target="#pesanan" type="button"><i class="fa-solid fa-cart-flatbed me-2"></i>3. Pesanan Masuk</button>
            </li>
        </ul>

        <div class="tab-content" id="adminTabsContent">
            
            <!-- BAGIAN 1: RINGKASAN ADMIN -->
            <div class="tab-pane fade show active" id="ringkasan">
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="card card-stat bg-dark text-white p-3 shadow-sm">
                            <small class="text-secondary fw-bold text-uppercase">Total Produk</small>
                            <h2 class="fw-bold my-1">{{ $totalProduk }}</h2>
                            <small class="text-warning">Produk terdaftar</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-stat bg-danger text-white p-3 shadow-sm">
                            <small class="text-white-50 fw-bold text-uppercase">Pesanan Baru</small>
                            <h2 class="fw-bold my-1">{{ $pesananBaru }}</h2>
                            <small class="text-white">Perlu diperiksa</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-stat bg-warning text-dark p-3 shadow-sm">
                            <small class="text-dark-50 fw-bold text-uppercase">Dalam Proses</small>
                            <h2 class="fw-bold my-1">{{ $dalamProses }}</h2>
                            <small class="text-dark">Sedang ditangani</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-stat bg-success text-white p-3 shadow-sm">
                            <small class="text-white-50 fw-bold text-uppercase">Pesanan Selesai</small>
                            <h2 class="fw-bold my-1">{{ $pesananSelesai }}</h2>
                            <small class="text-white">Berstatus selesai</small>
                        </div>
                    </div>
                </div>

                <!-- TABEL PESANAN TERBARU -->
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <h5 class="fw-bold mb-3"><i class="fa-solid fa-clock-rotate-left text-warning me-2"></i>Pesanan Terbaru</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID Pesanan</th>
                                    <th>Pelanggan</th>
                                    <th>Produk</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pesananTerbaru as $pt)
                                <tr>
                                    <td class="fw-bold">ORD-{{ sprintf('%03d', $pt->id) }}</td>
                                    <td>{{ $pt->nama_pemesan }}</td>
                                    <td>{{ $pt->produk_pilihan }} ({{ $pt->jumlah }} Pcs)</td>
                                    <td>
                                        @if($pt->status === 'Baru')
                                            <span class="badge bg-danger rounded-pill">Baru</span>
                                        @elseif($pt->status === 'Diproses')
                                            <span class="badge bg-warning text-dark rounded-pill">Diproses</span>
                                        @else
                                            <span class="badge bg-success rounded-pill">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center text-muted py-3">Belum ada pesanan terbaru.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- BAGIAN 2: KELOLA PRODUK -->
            <div class="tab-pane fade" id="produk">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                        <!-- FORM PENCARIAN -->
                        <form action="{{ route('admin.dashboard') }}" method="GET" class="d-flex gap-2" style="max-width: 350px;">
                            <input type="text" name="search" class="form-control rounded-pill" placeholder="Cari nama/kategori/varian..." value="{{ $search }}">
                            <button type="submit" class="btn btn-dark rounded-pill"><i class="fa-solid fa-magnifying-glass"></i></button>
                            @if($search)
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill">Reset</a>
                            @endif
                        </form>

                        <button class="btn btn-warning fw-bold rounded-pill text-dark px-4" data-bs-toggle="modal" data-bs-target="#modalTambahProduk">
                            <i class="fa-solid fa-plus me-1"></i>Tambah Produk Baru
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Gambar</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Varian</th>
                                    <th>Harga</th>
                                    <th class="text-center">Aksi & Upload Gambar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $p)
                                <tr>
                                    <td>
                                        <img src="{{ asset($p->gambar ?? 'images/balado.jpg') }}" class="rounded-3" style="width: 50px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td class="fw-bold">{{ $p->nama }}</td>
                                    <td><span class="badge bg-secondary rounded-pill">{{ $p->kategori }}</span></td>
                                    <td><span class="badge bg-warning text-dark rounded-pill">{{ $p->varian }}</span></td>
                                    <td class="text-danger fw-bold">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- FORM UPLOAD GAMBAR -->
                                            <form action="{{ route('product.uploadGambar', $p->id) }}" method="POST" enctype="multipart/form-data" class="d-flex gap-1">
                                                @csrf
                                                <input type="file" name="gambar_baru" class="form-control form-control-sm rounded-pill" required style="width: 150px;">
                                                <button type="submit" class="btn btn-sm btn-warning rounded-circle" title="Upload Gambar"><i class="fa-solid fa-upload"></i></button>
                                            </form>

                                            <!-- EDIT MODAL TRIGGER -->
                                            <button class="btn btn-sm btn-outline-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $p->id }}"><i class="fa-solid fa-pen"></i></button>

                                            <!-- HAPUS PRODUK -->
                                            <form action="{{ route('produk.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus {{ $p->nama }}?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger rounded-circle"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- MODAL EDIT PRODUK -->
                                <div class="modal fade" id="modalEdit{{ $p->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content rounded-4 border-0 p-3">
                                            <div class="modal-header border-0">
                                                <h5 class="fw-bold">Edit Produk: {{ $p->nama }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('produk.update', $p->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3"><label class="fw-semibold">Nama Produk</label><input type="text" name="nama" class="form-control rounded-pill" value="{{ $p->nama }}" required></div>
                                                    <div class="mb-3"><label class="fw-semibold">Harga (Rp)</label><input type="number" name="harga" class="form-control rounded-pill" value="{{ $p->harga }}" required></div>
                                                    <div class="mb-3"><label class="fw-semibold">Kategori</label><input type="text" name="kategori" class="form-control rounded-pill" value="{{ $p->kategori }}" required></div>
                                                    <div class="mb-3"><label class="fw-semibold">Varian Rasa</label><input type="text" name="varian" class="form-control rounded-pill" value="{{ $p->varian }}" required></div>
                                                    <div class="mb-3"><label class="fw-semibold">Deskripsi</label><textarea name="deskripsi" class="form-control rounded-4" rows="3" required>{{ $p->deskripsi }}</textarea></div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="submit" class="btn btn-warning fw-bold rounded-pill px-4">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr><td colspan="6" class="text-center text-muted py-4">Produk tidak ditemukan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- BAGIAN 3: PESANAN MASUK -->
            <div class="tab-pane fade" id="pesanan">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <h5 class="fw-bold mb-4"><i class="fa-solid fa-list-check text-warning me-2"></i>Daftar Pesanan Masuk & Detail Pelanggan</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Detail Pelanggan</th>
                                    <th>Pesanan</th>
                                    <th>Alamat Pengiriman</th>
                                    <th>Status Pesanan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $o)
                                <tr>
                                    <td class="fw-bold">ORD-{{ sprintf('%03d', $o->id) }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $o->nama_pemesan }}</div>
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $o->nomor_hp) }}" target="_blank" class="text-success text-decoration-none small fw-bold">
                                            <i class="fa-brands fa-whatsapp me-1"></i>{{ $o->nomor_hp }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning text-dark rounded-pill">{{ $o->produk_pilihan }}</span>
                                        <div class="small fw-bold mt-1">{{ $o->jumlah }} Bungkus</div>
                                    </td>
                                    <td class="small text-muted" style="max-width: 250px;">{{ $o->alamat }}</td>
                                    <td>
                                        <!-- FORM UBAH STATUS PESANAN -->
                                        <form action="{{ route('pesanan.updateStatus', $o->id) }}" method="POST">
                                            @csrf
                                            <select name="status" class="form-select form-select-sm rounded-pill fw-bold" onchange="this.form.submit()">
                                                <option value="Baru" {{ $o->status == 'Baru' ? 'selected' : '' }}>🔴 Baru</option>
                                                <option value="Diproses" {{ $o->status == 'Diproses' ? 'selected' : '' }}>🟡 Diproses</option>
                                                <option value="Selesai" {{ $o->status == 'Selesai' ? 'selected' : '' }}>🟢 Selesai</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('pesanan.destroy', $o->id) }}" method="POST" onsubmit="return confirm('Hapus riwayat pesanan ini?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger rounded-circle"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada pesanan masuk.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL TAMBAH PRODUK BARU -->
    <div class="modal fade" id="modalTambahProduk" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content rounded-4 border-0 p-3">
                <div class="modal-header border-0">
                    <h5 class="fw-bold">Tambah Produk Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('produk.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3"><label class="fw-semibold">Nama Produk</label><input type="text" name="nama" class="form-control rounded-pill" required placeholder="Contoh: Kripkongs Balado"></div>
                        <div class="mb-3"><label class="fw-semibold">Harga (Rp)</label><input type="number" name="harga" class="form-control rounded-pill" required placeholder="15000"></div>
                        <div class="mb-3"><label class="fw-semibold">Kategori</label><input type="text" name="kategori" class="form-control rounded-pill" required placeholder="Best Seller / Spicy"></div>
                        <div class="mb-3"><label class="fw-semibold">Varian Rasa</label><input type="text" name="varian" class="form-control rounded-pill" required placeholder="Pedas Manis"></div>
                        <div class="mb-3"><label class="fw-semibold">Deskripsi</label><textarea name="deskripsi" class="form-control rounded-4" rows="3" required placeholder="Deskripsi rasa..."></textarea></div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-warning fw-bold rounded-pill px-4">Tambah Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- FOOTER KONSISTEN KELOMPOK 3 -->
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