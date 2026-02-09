<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - Portal UMKM Desa Candimulyo</title>
    
    <!-- Meta Tags untuk SEO -->
    <meta name="description" content="Portal katalog UMKM Desa Candimulyo, Kecamatan Kedu, Kabupaten Temanggung. Temukan produk lokal dari pelaku usaha mikro kecil menengah di sekitar Anda.">
    <meta name="keywords" content="UMKM Candimulyo, UMKM Temanggung, Produk Lokal Kedu, Usaha Desa Candimulyo">
    <meta name="author" content="KKN UNNES Desa Candimulyo">
    
    <!-- Open Graph untuk Share di Media Sosial -->
    <meta property="og:title" content="Portal UMKM Desa Candimulyo">
    <meta property="og:description" content="Katalog UMKM Desa Candimulyo - Dukung Produk Lokal Temanggung">
    <meta property="og:type" content="website">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            padding-top: 80px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        
        /* Navbar Responsiveness */
        .navbar-collapse {
            background: rgba(44, 62, 80, 0.95);
            padding: 1rem;
            border-radius: 0.5rem;
            margin-top: 0.5rem;
        }
        
        @media (min-width: 992px) {
            .navbar-collapse {
                background: transparent;
                padding: 0;
                margin-top: 0;
            }
        }
        
        .nav-link:hover {
            color: #4CA1AF !important;
            transform: translateY(-2px);
            transition: all 0.3s;
        }
        
        /* Hero Banner */
        .hero-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        
        /* Search Box */
        .search-box {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }
        
        /* Card UMKM */
        .umkm-card {
            border: none;
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            height: 100%;
            background: white;
        }
        
        .umkm-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        
        .umkm-card img {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }
        
        .umkm-card .card-body {
            padding: 1.25rem;
        }
        
        .kategori-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        /* List View */
        .umkm-list-item {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            transition: all 0.3s;
        }
        
        .umkm-list-item:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
            transform: translateX(5px);
        }
        
        .umkm-list-item img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 0.75rem;
        }
        
        /* Pagination Custom */
        .pagination {
            gap: 0.5rem;
        }
        
        .pagination .page-link {
            border-radius: 0.5rem;
            border: 2px solid #e0e0e0;
            color: #667eea;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s;
        }
        
        .pagination .page-link:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: #667eea;
            transform: scale(1.05);
        }
        
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
        }
        
        /* Filter Badge */
        .filter-badge {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0.25rem;
            animation: slideInDown 0.3s ease;
        }
        
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .filter-badge .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
        }
        
        /* Footer */
        footer {
            background: linear-gradient(90deg, #2C3E50, #4CA1AF);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }
        
        footer a {
            color: #a8dadc;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        footer a:hover {
            color: white;
        }
        
        /* Modal Custom */
        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 0.5rem 0.5rem 0 0;
        }
        
        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }
        
        /* Loading State */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        /* Responsive Adjustments */
        @media (max-width: 576px) {
            .hero-banner h1 {
                font-size: 1.75rem;
            }
            
            .umkm-card img {
                height: 180px;
            }
            
            .umkm-list-item img {
                width: 100%;
                height: 180px;
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>

    <!-- NAVBAR HEADER -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm" style="background: linear-gradient(90deg, #2C3E50, #4CA1AF);">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?= base_url() ?>" title="Portal UMKM Desa Candimulyo">
            <img src="<?= base_url('assets/images/logo-temanggung.png') ?>" alt="Logo Kabupaten Temanggung" height="45" class="me-2 me-md-3">
            <div class="d-flex flex-column lh-sm">
                <span class="fw-bold text-white" style="font-size: clamp(0.9rem, 2.5vw, 1.1rem);">Desa Candimulyo Kedu</span>
                <small class="text-white-50" style="font-size: 0.7rem;">Kec. Kedu, Kab. Temanggung</small>
            </div>
        </a>
        
        <!-- Tombol Hamburger untuk Mobile -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Menu Navigasi -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-2 mt-3 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= base_url() ?>">
                        <i class="bi bi-house-door me-1"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#tentang" data-bs-toggle="modal" data-bs-target="#modalTentang">
                        <i class="bi bi-info-circle me-1"></i> Tentang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="https://candimulyo-kedu.temanggungkab.go.id/frontend" target="_blank" rel="noopener">
                        <i class="bi bi-globe me-1"></i> Web Desa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#caraPesan" data-bs-toggle="modal" data-bs-target="#modalCaraPesan">
                        <i class="bi bi-cart-check me-1"></i> Cara Pesan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('login') ?>" class="btn btn-outline-light btn-sm rounded-pill px-3">
                        <i class="bi bi-shield-lock me-1"></i> Admin
                    </a>
                </li>
            </ul>
        </div>
      </div>
    </nav>

    <div class="container mt-4">
        
        <!-- HERO BANNER -->
        <div class="hero-banner text-center">
            <h1 class="fw-bold mb-3">
                <i class="bi bi-shop-window me-2"></i>
                Portal UMKM Desa Candimulyo
            </h1>
            <p class="lead mb-0">Dukung Produk Lokal, Wujudkan Desa Mandiri 🌾</p>
            <p class="text-white-50 mb-0 mt-2">
                <i class="bi bi-geo-alt-fill me-1"></i>
                Kecamatan Kedu, Kabupaten Temanggung, Jawa Tengah
            </p>
        </div>

        <!-- SEARCH & FILTER BOX -->
        <div class="search-box">
            <form method="GET" action="<?= base_url() ?>" id="filterForm">
                <div class="row g-3 align-items-end">
                    <!-- Pencarian Keyword -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-search me-1"></i> Cari Usaha / Produk
                        </label>
                        <input type="text" 
                               name="cari" 
                               class="form-control" 
                               placeholder="Contoh: Catering, Baju, Keripik..." 
                               value="<?= esc($keyword ?? '') ?>">
                    </div>

                    <!-- Filter Wilayah -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-geo-fill me-1"></i> Wilayah
                        </label>
                        <select name="wilayah" class="form-select">
                            <option value="">Semua Wilayah</option>
                            <?php foreach ($list_wilayah as $wil): ?>
                                <option value="<?= $wil['id_wilayah'] ?>" 
                                    <?= ($selectedWilayah == $wil['id_wilayah']) ? 'selected' : '' ?>>
                                    <?= esc($wil['nama_wilayah']) ?> (RW <?= $wil['rw'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Filter Kategori -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-tag-fill me-1"></i> Kategori
                        </label>
                        <select name="kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            <?php foreach (KATEGORI_UMKM as $kat): ?>
                                <option value="<?= $kat ?>" <?= ($selectedKategori == $kat) ? 'selected' : '' ?>>
                                    <?= $kat ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Tombol Cari & Reset -->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100 mb-2">
                            <i class="bi bi-funnel-fill me-1"></i> Filter
                        </button>
                        <?php if ($keyword || $selectedWilayah || $selectedKategori): ?>
                            <a href="<?= base_url() ?>" class="btn btn-outline-secondary w-100 btn-sm">
                                <i class="bi bi-arrow-clockwise me-1"></i> Reset
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>

            <!-- Active Filters Badge -->
            <?php if ($keyword || $selectedWilayah || $selectedKategori): ?>
                <div class="mt-3 pt-3 border-top">
                    <small class="text-muted d-block mb-2">
                        <i class="bi bi-funnel me-1"></i> Filter Aktif:
                    </small>
                    <?php if ($keyword): ?>
                        <span class="filter-badge">
                            <i class="bi bi-search"></i>
                            Kata Kunci: "<?= esc($keyword) ?>"
                            <button type="button" class="btn-close btn-close-sm" onclick="removeFilter('cari')"></button>
                        </span>
                    <?php endif; ?>
                    <?php if ($selectedWilayah): ?>
                        <?php 
                            $namaWilayahTerpilih = '';
                            foreach ($list_wilayah as $wil) {
                                if ($wil['id_wilayah'] == $selectedWilayah) {
                                    $namaWilayahTerpilih = $wil['nama_wilayah'];
                                    break;
                                }
                            }
                        ?>
                        <span class="filter-badge">
                            <i class="bi bi-geo-fill"></i>
                            Wilayah: <?= esc($namaWilayahTerpilih) ?>
                            <button type="button" class="btn-close btn-close-sm" onclick="removeFilter('wilayah')"></button>
                        </span>
                    <?php endif; ?>
                    <?php if ($selectedKategori): ?>
                        <span class="filter-badge">
                            <i class="bi bi-tag-fill"></i>
                            Kategori: <?= esc($selectedKategori) ?>
                            <button type="button" class="btn-close btn-close-sm" onclick="removeFilter('kategori')"></button>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- TOOLBAR (Jumlah Data + Toggle View) -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <span class="badge bg-primary px-3 py-2">
                    <i class="bi bi-database-fill me-1"></i>
                    <?= count($umkm) ?> UMKM Ditemukan
                </span>
            </div>
            <div class="btn-group" role="group">
                <a href="?<?= http_build_query(array_merge($_GET, ['view' => 'grid'])) ?>" 
                   class="btn btn-sm <?= ($viewMode == 'grid') ? 'btn-primary' : 'btn-outline-primary' ?>">
                    <i class="bi bi-grid-3x3-gap-fill"></i> Grid
                </a>
                <a href="?<?= http_build_query(array_merge($_GET, ['view' => 'list'])) ?>" 
                   class="btn btn-sm <?= ($viewMode == 'list') ? 'btn-primary' : 'btn-outline-primary' ?>">
                    <i class="bi bi-list-ul"></i> List
                </a>
            </div>
        </div>

        <!-- GRID VIEW -->
        <?php if ($viewMode == 'grid'): ?>
            <div class="row g-4">
                <?php if (empty($umkm)): ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center py-5">
                            <i class="bi bi-inbox display-1 d-block mb-3"></i>
                            <h5>Tidak Ada Data UMKM</h5>
                            <p class="mb-0">Coba ubah filter pencarian Anda</p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($umkm as $row): ?>
                        <div class="col-md-4 col-sm-6">
                            <div class="umkm-card">
                                <img src="<?= base_url('uploads/umkm/' . esc($row['foto_umkm'])) ?>" 
                                     alt="<?= esc($row['nama_usaha']) ?>"
                                     loading="lazy">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title mb-0 fw-bold" style="font-size: 1.1rem;">
                                            <?= esc($row['nama_usaha']) ?>
                                        </h5>
                                        <span class="kategori-badge"><?= esc($row['kategori']) ?></span>
                                    </div>
                                    <p class="text-muted small mb-2">
                                        <i class="bi bi-person-fill me-1"></i>
                                        <?= esc($row['pemilik']) ?>
                                    </p>
                                    <p class="text-muted small mb-2">
                                        <i class="bi bi-geo-alt-fill me-1"></i>
                                        <?= esc($row['nama_wilayah']) ?> RW <?= $row['rw'] ?>, RT <?= $row['rt'] ?>
                                    </p>
                                    <p class="card-text mb-3" style="font-size: 0.9rem;">
                                        <strong>Produk:</strong> <?= esc($row['produk']) ?>
                                    </p>
                                    <a href="https://wa.me/<?= esc($row['kontak_hp']) ?>?text=Halo%20<?= urlencode($row['nama_usaha']) ?>,%20saya%20tertarik%20dengan%20produk%20Anda" 
                                       target="_blank" 
                                       rel="noopener"
                                       class="btn btn-success w-100">
                                        <i class="bi bi-whatsapp me-1"></i> Hubungi via WhatsApp
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        <!-- LIST VIEW -->
        <?php else: ?>
            <?php if (empty($umkm)): ?>
                <div class="alert alert-info text-center py-5">
                    <i class="bi bi-inbox display-1 d-block mb-3"></i>
                    <h5>Tidak Ada Data UMKM</h5>
                    <p class="mb-0">Coba ubah filter pencarian Anda</p>
                </div>
            <?php else: ?>
                <?php foreach ($umkm as $row): ?>
                    <div class="umkm-list-item">
                        <div class="row align-items-center">
                            <div class="col-md-2 col-sm-12 text-center">
                                <img src="<?= base_url('uploads/umkm/' . esc($row['foto_umkm'])) ?>" 
                                     alt="<?= esc($row['nama_usaha']) ?>"
                                     loading="lazy"
                                     class="rounded">
                            </div>
                            <div class="col-md-7 col-sm-12">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <h5 class="mb-0 fw-bold"><?= esc($row['nama_usaha']) ?></h5>
                                    <span class="kategori-badge"><?= esc($row['kategori']) ?></span>
                                </div>
                                <p class="text-muted mb-1">
                                    <i class="bi bi-person-fill me-1"></i>
                                    <strong>Pemilik:</strong> <?= esc($row['pemilik']) ?>
                                </p>
                                <p class="text-muted mb-1">
                                    <i class="bi bi-geo-alt-fill me-1"></i>
                                    <strong>Lokasi:</strong> <?= esc($row['nama_wilayah']) ?> RW <?= $row['rw'] ?>, RT <?= $row['rt'] ?>
                                </p>
                                <p class="mb-0">
                                    <i class="bi bi-box-seam me-1"></i>
                                    <strong>Produk:</strong> <?= esc($row['produk']) ?>
                                </p>
                            </div>
                            <div class="col-md-3 col-sm-12 text-center text-md-end mt-3 mt-md-0">
                                <a href="https://wa.me/<?= esc($row['kontak_hp']) ?>?text=Halo%20<?= urlencode($row['nama_usaha']) ?>,%20saya%20tertarik%20dengan%20produk%20Anda" 
                                   target="_blank" 
                                   rel="noopener"
                                   class="btn btn-success">
                                    <i class="bi bi-whatsapp me-1"></i> Hubungi
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>

        <!-- PAGINATION -->
        <?php if (!empty($umkm) && $pager): ?>
            <div class="d-flex justify-content-center mt-5">
                <?= $pager->links('default', 'default_full') ?>
            </div>
        <?php endif; ?>

    </div>

    <!-- FOOTER -->
    <footer class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h5 class="fw-bold mb-3">Portal UMKM Desa Candimulyo</h5>
                    <p class="mb-2">
                        <i class="bi bi-geo-alt-fill me-2"></i>
                        Desa Candimulyo, Kec. Kedu, Kab. Temanggung, Jawa Tengah
                    </p>
                    <p class="mb-0">
                        <i class="bi bi-info-circle me-2"></i>
                        Website ini dikelola oleh Tim KKN UNNES 2025
                    </p>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <h6 class="fw-bold mb-3">Link Terkait</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="https://candimulyo-kedu.temanggungkab.go.id/frontend" target="_blank" rel="noopener">
                                <i class="bi bi-arrow-right me-1"></i> Website Desa
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalTentang">
                                <i class="bi bi-arrow-right me-1"></i> Tentang Portal
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalCaraPesan">
                                <i class="bi bi-arrow-right me-1"></i> Cara Pemesanan
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold mb-3">Kontak</h6>
                    <p class="mb-2">
                        <i class="bi bi-envelope me-2"></i>
                        info@candimulyo-kedu.id
                    </p>
                    <p class="mb-0">
                        <i class="bi bi-telephone me-2"></i>
                        (0293) xxx-xxxx
                    </p>
                </div>
            </div>
            <hr class="my-4 border-light">
            <div class="text-center">
                <small>&copy; <?= date('Y') ?> Portal UMKM Desa Candimulyo | Dibuat dengan <i class="bi bi-heart-fill text-danger"></i> oleh KKN UNNES</small>
            </div>
        </div>
    </footer>

    <!-- MODAL TENTANG -->
    <div class="modal fade" id="modalTentang" tabindex="-1" aria-labelledby="modalTentangLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalTentangLabel">
                        <i class="bi bi-info-circle me-2"></i>
                        Tentang Portal UMKM Desa Candimulyo
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="fw-bold mb-3">Apa itu Portal UMKM?</h6>
                    <p>
                        Portal UMKM Desa Candimulyo adalah platform digital yang dikembangkan untuk memfasilitasi 
                        promosi dan pemasaran produk lokal dari pelaku Usaha Mikro Kecil Menengah (UMKM) di Desa Candimulyo, 
                        Kecamatan Kedu, Kabupaten Temanggung.
                    </p>
                    
                    <h6 class="fw-bold mb-3 mt-4">Tujuan Portal</h6>
                    <ul>
                        <li>Meningkatkan visibilitas produk UMKM lokal</li>
                        <li>Memudahkan masyarakat menemukan dan menghubungi pelaku usaha</li>
                        <li>Mendorong pertumbuhan ekonomi desa melalui digitalisasi</li>
                        <li>Melestarikan dan mengembangkan produk lokal khas Temanggung</li>
                    </ul>
                    
                    <h6 class="fw-bold mb-3 mt-4">Cakupan Wilayah</h6>
                    <p>
                        Portal ini mencakup seluruh UMKM yang berdomisili di Desa Candimulyo, 
                        yang terdiri dari beberapa RW dan RT dengan berbagai kategori usaha seperti:
                    </p>
                    <div class="row g-2 mb-3">
                        <?php foreach (KATEGORI_UMKM as $kat): ?>
                            <div class="col-6 col-md-4">
                                <span class="badge bg-secondary w-100 py-2">
                                    <i class="bi bi-check-circle me-1"></i> <?= $kat ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <h6 class="fw-bold mb-3 mt-4">Tim Pengembang</h6>
                    <p>
                        Website ini dikembangkan oleh Tim KKN Universitas Negeri Semarang (UNNES) Tahun 2025 
                        sebagai bagian dari program pengabdian masyarakat untuk mendukung pemberdayaan ekonomi desa.
                    </p>
                    
                    <div class="alert alert-info mt-4" role="alert">
                        <i class="bi bi-lightbulb-fill me-2"></i>
                        <strong>Informasi:</strong> Portal ini bersifat katalog informasi. Transaksi pembelian 
                        dilakukan langsung antara pembeli dan penjual melalui kontak yang tersedia.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL CARA PESAN -->
    <div class="modal fade" id="modalCaraPesan" tabindex="-1" aria-labelledby="modalCaraPesanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalCaraPesanLabel">
                        <i class="bi bi-cart-check me-2"></i>
                        Cara Memesan Produk UMKM
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Perhatian:</strong> Portal ini BUKAN toko online. Pemesanan dilakukan langsung 
                        dengan penjual melalui WhatsApp.
                    </div>
                    
                    <h6 class="fw-bold mb-3">Langkah-Langkah Pemesanan:</h6>
                    
                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                             style="width: 40px; height: 40px; flex-shrink: 0;">
                            <strong>1</strong>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-2">Cari Produk yang Diinginkan</h6>
                            <p class="mb-0">
                                Gunakan fitur pencarian dan filter untuk menemukan UMKM atau produk yang Anda cari. 
                                Anda bisa filter berdasarkan kategori, wilayah, atau kata kunci.
                            </p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                             style="width: 40px; height: 40px; flex-shrink: 0;">
                            <strong>2</strong>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-2">Klik Tombol WhatsApp</h6>
                            <p class="mb-0">
                                Setelah menemukan produk yang diinginkan, klik tombol 
                                <span class="badge bg-success">
                                    <i class="bi bi-whatsapp"></i> Hubungi via WhatsApp
                                </span>
                                pada kartu UMKM tersebut.
                            </p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                             style="width: 40px; height: 40px; flex-shrink: 0;">
                            <strong>3</strong>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-2">Hubungi Penjual</h6>
                            <p class="mb-0">
                                Anda akan diarahkan ke aplikasi WhatsApp dengan template pesan yang sudah disiapkan. 
                                Tanyakan detail produk, harga, stok, dan cara pengambilan/pengiriman kepada penjual.
                            </p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                             style="width: 40px; height: 40px; flex-shrink: 0;">
                            <strong>4</strong>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-2">Lakukan Transaksi</h6>
                            <p class="mb-0">
                                Sepakati harga, jumlah, dan metode pembayaran dengan penjual. Transaksi dilakukan 
                                langsung antara Anda dan penjual (di luar platform ini).
                            </p>
                        </div>
                    </div>
                    
                    <div class="alert alert-success mt-4" role="alert">
                        <i class="bi bi-shield-check me-2"></i>
                        <strong>Tips Aman Berbelanja:</strong>
                        <ul class="mb-0 mt-2">
                            <li>Pastikan nomor WhatsApp yang dihubungi sesuai dengan yang tertera di portal</li>
                            <li>Tanyakan detail produk secara lengkap sebelum memesan</li>
                            <li>Gunakan metode pembayaran yang aman (COD/transfer dengan bukti)</li>
                            <li>Simpan bukti komunikasi dan transaksi</li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Fungsi Remove Filter (untuk badge X)
        function removeFilter(filterName) {
            const url = new URL(window.location);
            url.searchParams.delete(filterName);
            window.location.href = url.toString();
        }
        
        // Auto-close navbar saat link diklik (mobile)
        document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 992) {
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse.classList.contains('show')) {
                        bootstrap.Collapse.getInstance(navbarCollapse)?.hide();
                    }
                }
            });
        });
        
        // Lazy loading untuk gambar
        if ('loading' in HTMLImageElement.prototype) {
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                img.src = img.src;
            });
        }
    </script>
</body>
</html>