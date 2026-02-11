<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* HERO SECTION */
        .hero-section {
            background: linear-gradient(135deg, #2C3E50, #4CA1AF);
            color: white;
            padding: 140px 0 60px;
            border-bottom-left-radius: 50% 20px;
            border-bottom-right-radius: 50% 20px;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }
        
        .hero-section .container { position: relative; z-index: 1; }
        
        /* STATS */
        .stats-row {
            display: flex; justify-content: center; gap: 3rem; margin-top: 2rem; flex-wrap: wrap;
        }
        .stat-item { text-align: center; padding: 1rem; }
        .stat-item h2 { font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.2); }
        .stat-item p { font-size: 0.9rem; opacity: 0.9; margin: 0; }
        
        /* FOOTER & SOCIAL MEDIA */
        .footer {
            background: linear-gradient(135deg, #2C3E50, #34495e);
            color: white; padding: 3rem 0 1rem; margin-top: 4rem;
        }
        .footer a { color: #4CA1AF; text-decoration: none; transition: color 0.3s; }
        .footer a:hover { color: #6dbbc7; }
        .footer h6 { font-weight: 600; margin-bottom: 1rem; color: #4CA1AF; }

        .social-icons {
            display: flex;
            gap: 15px;
            /* justify-content: center; */ /* Opsional: aktifkan jika ingin tengah */
            align-items: center;
            margin-top: 15px;
        }
        .social-icons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }
        .social-icons a:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }
        .social-icons a.facebook:hover {
            background: #1877F2;
        }
        .social-icons a.instagram:hover {
            background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
        }
        
        /* GENERAL UI */
        html { scroll-behavior: smooth; }
        .navbar-brand:hover { opacity: 0.9; }
        .navbar-toggler { border: none; outline: none; }
        .navbar-toggler:focus { box-shadow: none; }
        .nav-link { font-weight: 500; padding: 0.5rem 1rem; }
        .nav-link:hover { color: #ffc107 !important; }
        
        /* LOADING */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.3);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        .loading-overlay.active { display: flex; }
        .spinner-border-custom {
            width: 3rem; height: 3rem;
            border: 0.3em solid rgba(255,255,255,0.3);
            border-top-color: #4CA1AF;
        }
        
        /* CARDS ANIMATION & STYLE */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card-umkm { animation: fadeInUp 0.4s ease-out; }
        
        .search-box-hero {
            border-radius: 15px;
            background: rgba(255,255,255,0.97);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            backdrop-filter: blur(10px);
        }

        /* GRID VIEW IMAGE */
        .umkm-img-container {
            width: 100%; height: 220px; overflow: hidden; position: relative; background: #f8f9fa; border-radius: 8px 8px 0 0;
        }
        .umkm-img-container img {
            width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;
        }
        .card-umkm:hover .umkm-img-container img { transform: scale(1.08); }
        
        .category-badge-container {
            position: absolute; top: 10px; right: 10px; z-index: 10; display: flex; flex-direction: column; align-items: flex-end; gap: 5px;
        }
        
        /* LIST VIEW IMAGE FIX */
        .umkm-img-container-list {
            width: 100%;
            height: 200px; /* Lock height */
            overflow: hidden;
            border-radius: 8px 0 0 8px;
            background: #f8f9fa;
        }
        .umkm-img-container-list img {
            width: 100%; height: 100%; object-fit: cover; object-position: center;
        }

        @media (max-width: 576px) {
            .hero-section { padding: 120px 0 40px; }
            .hero-section h1 { font-size: 1.75rem !important; }
            .stats-row { gap: 1.5rem; }
            .umkm-img-container { height: 180px; }
            .umkm-img-container-list {
                height: 150px;
                border-radius: 8px 8px 0 0;
            }
        }
    </style>
  </head>
  <body class="bg-light d-flex flex-column min-vh-100">

    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner-border spinner-border-custom" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm" style="background: linear-gradient(90deg, #2C3E50, #4CA1AF);">
      <div class="container">
        
        <a class="navbar-brand d-flex align-items-center gap-3" href="<?= base_url() ?>">
            <img src="<?= base_url('assets/images/logo-temanggung.png') ?>" alt="Logo" height="52" class="me-1">
            
            <div class="d-flex flex-column justify-content-center text-uppercase fw-bold text-white lh-1">
                <span style="font-size: 0.7rem; letter-spacing: 2.5px; margin-bottom: 2px; opacity: 0.9;">
                    Desa
                </span>
                
                <span style="font-size: 1.1rem; letter-spacing: 0.5px; margin-bottom: 1px;">
                    Candimulyo
                </span>
                
                <span style="font-size: 1.1rem; letter-spacing: 0.5px;">
                    Kedu
                </span>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-2 mt-3 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white active" href="<?= base_url() ?>">
                        <i class="bi bi-house-door me-1"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#" data-bs-toggle="modal" data-bs-target="#modalTentang">
                        <i class="bi bi-info-circle me-1"></i> Tentang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="https://candimulyo-kedu.temanggungkab.go.id/frontend" target="_blank" rel="noopener">
                        <i class="bi bi-globe me-1"></i> Web Desa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#" data-bs-toggle="modal" data-bs-target="#modalCaraPesan">
                        <i class="bi bi-cart-check me-1"></i> Cara Pesan
                    </a>
                </li>
            </ul>
        </div>
      </div>
    </nav>

    <header class="hero-section text-center">
        <div class="container">
            <h1 class="fw-bold mb-3" style="font-size: clamp(1.75rem, 4vw, 3rem);">
                Portal UMKM Desa Candimulyo
            </h1>
            <p class="lead mb-4 opacity-90" style="font-size: clamp(1rem, 2vw, 1.25rem);">
                Katalog Digital Produk & Jasa Unggulan Warga
            </p>
            
            <div class="stats-row">
                <div class="stat-item">
                    <h2 class="text-warning" id="totalUmkmStat"><?= count($umkm) ?>+</h2>
                    <p>UMKM Terdaftar</p>
                </div>
                <div class="stat-item">
                    <h2 class="text-info"><?= isset($list_wilayah) ? count($list_wilayah) : 0 ?></h2>
                    <p>Dusun Tercover</p>
                </div>
            </div>
            
            <div class="card search-box-hero p-4 mx-auto mt-4" style="max-width: 900px;">
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <input type="text" id="searchInput" class="form-control" 
                            placeholder="Cari produk..." value="<?= esc($keyword ?? '') ?>">
                    </div>
                    <div class="col-12 col-md-3">
                        <select id="wilayahFilter" class="form-select">
                            <option value="">- Semua Wilayah -</option>
                            <?php if(isset($list_wilayah)): foreach($list_wilayah as $w): ?>
                                <option value="<?= $w['id_wilayah'] ?>" <?= (isset($selectedWilayah) && $selectedWilayah == $w['id_wilayah']) ? 'selected' : '' ?>>
                                    <?= $w['nama_wilayah'] ?>
                                </option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <select id="kategoriFilter" class="form-select">
                            <option value="">- Semua Kategori -</option>
                            <?php 
                            foreach(KATEGORI_UMKM as $c): 
                            ?>
                                <option value="<?= $c ?>" <?= (isset($selectedKategori) && $selectedKategori == $c) ? 'selected' : '' ?>><?= $c ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-2 d-grid">
                        <button class="btn btn-primary bg-gradient fw-bold" onclick="applyFilter()">
                            <i class="bi bi-search me-2"></i>Cari
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container py-4 flex-grow-1">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom flex-wrap gap-3">
            <div>
                <h5 class="text-muted mb-1">
                    <i class="bi bi-grid-3x3-gap me-2"></i>
                    Menampilkan <strong class="text-primary" id="countDisplay"><?= count($umkm) ?></strong> UMKM
                </h5>
                <div id="activeFilters"></div>
            </div>
            <div class="btn-group" role="group">
                <button class="btn btn-outline-secondary <?= ($viewMode == 'grid') ? 'active' : '' ?>" 
                        onclick="toggleView('grid')" id="btnGrid">
                    <i class="bi bi-grid-fill"></i> <span class="d-none d-sm-inline ms-1">Grid</span>
                </button>
                <button class="btn btn-outline-secondary <?= ($viewMode == 'list') ? 'active' : '' ?>" 
                        onclick="toggleView('list')" id="btnList">
                    <i class="bi bi-list-ul"></i> <span class="d-none d-sm-inline ms-1">List</span>
                </button>
            </div>
        </div>

        <div id="umkmContainer">
            <?php if(empty($umkm)): ?>
                <div class="empty-state text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="Empty Data" width="100" style="opacity:0.5; filter:grayscale(1);">
                    <h5 class="mt-3 text-muted">Tidak ada UMKM ditemukan</h5>
                    <p class="text-secondary">Coba ubah kata kunci pencarian atau reset filter</p>
                    <button class="btn btn-primary mt-3" onclick="resetFilter()">
                        <i class="bi bi-arrow-counterclockwise me-2"></i>Tampilkan Semua
                    </button>
                </div>
            <?php else: ?>
                <div class="row <?= ($viewMode == 'grid') ? 'row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-4' : 'row-cols-1 g-3' ?>" id="umkmGrid">
                    <?php foreach($umkm as $row): ?>
                        <?php 
                            $foto = ($row['foto_umkm'] && $row['foto_umkm'] != 'default.jpg') ? 'uploads/umkm/'.$row['foto_umkm'] : 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300"%3E%3Crect fill="%23e9ecef" width="400" height="300"/%3E%3Ctext x="50%25" y="50%25" text-anchor="middle" fill="%23adb5bd" font-size="20" font-family="Arial"%3ENo Image%3C/text%3E%3C/svg%3E';
                            
                            $colors = [
                                'Kuliner' => 'danger', 'Fashion' => 'info', 'Agrobisnis' => 'success', 
                                'Jasa' => 'primary', 'Kerajinan' => 'warning', 'Toko' => 'secondary'
                            ];
                            
                            $katString = $row['kategori'] ?? 'Lainnya';
                            $kategoriList = explode(', ', $katString);
                        ?>
                        <div class="col">
                            <div class="card h-100 card-umkm shadow-sm border-0" onclick="bukaPopup(<?= $row['id_umkm'] ?>)" style="cursor:pointer;">
                                <?php if($viewMode == 'grid'): ?>
                                    <div class="umkm-img-container">
                                        <img src="<?= base_url($foto) ?>" alt="<?= esc($row['nama_usaha']) ?>">
                                        <div class="category-badge-container">
                                            <?php foreach($kategoriList as $kat): 
                                                $badgeColor = $colors[$kat] ?? 'secondary';
                                            ?>
                                                <span class="badge bg-<?= $badgeColor ?>"><?= esc($kat) ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold text-dark mb-2" style="line-height: 1.4;"><?= esc($row['nama_usaha']) ?></h5>
                                        <p class="card-text text-muted small mb-2"><i class="bi bi-person me-1"></i><?= esc($row['pemilik']) ?></p>
                                        <p class="card-text">
                                            <span class="badge bg-light text-dark border"><i class="bi bi-geo-alt"></i> <?= esc($row['nama_wilayah']) ?></span>
                                        </p>
                                    </div>
                                <?php else: ?>
                                    <div class="row g-0 h-100">
                                        <div class="col-md-4">
                                            <div class="umkm-img-container-list h-100">
                                                <img src="<?= base_url($foto) ?>" alt="<?= esc($row['nama_usaha']) ?>">
                                                <div class="category-badge-container">
                                                    <?php foreach($kategoriList as $kat): 
                                                        $badgeColor = $colors[$kat] ?? 'secondary';
                                                    ?>
                                                        <span class="badge bg-<?= $badgeColor ?>"><?= esc($kat) ?></span>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body d-flex flex-column h-100">
                                                <h5 class="card-title fw-bold mb-2"><?= esc($row['nama_usaha']) ?></h5>
                                                <p class="card-text text-muted small mb-2"><i class="bi bi-person me-1"></i><?= esc($row['pemilik']) ?></p>
                                                <p class="card-text text-truncate mb-3"><?= esc($row['produk']) ?></p>
                                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                                    <span class="badge bg-light text-dark border"><i class="bi bi-geo-alt"></i> <?= esc($row['nama_wilayah']) ?></span>
                                                    <button class="btn btn-sm btn-primary rounded-pill">Lihat Detail <i class="bi bi-arrow-right ms-1"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <footer class="footer mt-auto">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h6><i class="bi bi-building me-2"></i>Kantor Desa Candimulyo</h6>
                    <p class="small mb-2">
                        <i class="bi bi-geo-alt me-2"></i>Pakisan, RT.02/RW.05<br>
                        <span class="ms-4">Desa Candimulyo Kedu</span><br>
                        <span class="ms-4">Kec. Kedu, Kab. Temanggung</span>
                    </p>
                    <p class="small mb-2">
                        <i class="bi bi-envelope me-2"></i>candimulyo-kedu@temanggungkab.go.id
                    </p>
                </div>

                <div class="col-md-4">
                    <h6><i class="bi bi-link-45deg me-2"></i>Link Terkait</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2">
                            <a href="https://candimulyo-kedu.temanggungkab.go.id/frontend" target="_blank" rel="noopener">
                                <i class="bi bi-globe me-2"></i>Website Desa Candimulyo
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://temanggungkab.go.id" target="_blank" rel="noopener">
                                <i class="bi bi-building me-2"></i>Website Kab. Temanggung
                            </a>
                        </li>
                    </ul>
                    
                    <div class="social-icons">
                        <a href="https://www.facebook.com/people/Pemdes-Candimulyo/pfbid0GtFHb6dBt5184CqmpF97vVdzTDaCsicyLZr3Z2SkarBXZHQ7J8BCjMqLroAb8biyl/" 
                           target="_blank" rel="noopener" class="facebook" title="Facebook Pemdes Candimulyo">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/pemerintahdesacandimulyo/" 
                           target="_blank" rel="noopener" class="instagram" title="Instagram Pemdes Candimulyo">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <h6><i class="bi bi-info-circle me-2"></i>Tentang Portal UMKM</h6>
                    <p class="small">
                        Sistem pendataan UMKM digital untuk memajukan ekonomi lokal Desa Candimulyo Kedu.
                    </p>
                    <p class="small mb-0">
                        <i class="bi bi-people me-2"></i>Dibuat oleh <strong>KKN GIAT 15 UNNES 2026</strong>
                    </p>
                </div>
            </div>

            <hr class="my-3" style="border-color: rgba(255,255,255,0.1);">
            
            <div class="text-center small opacity-75">
                <p class="mb-0">
                    © <?= date('Y') ?> Portal UMKM Desa Candimulyo. 
                    Dikembangkan dengan <i class="bi bi-heart-fill text-danger"></i> untuk kemajuan desa.
                </p>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-fullscreen-md-down">
        <div class="modal-content border-0 shadow-lg rounded-4">
          <div class="modal-header border-0 pb-0 position-sticky top-0 bg-white" style="z-index: 1030;">
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0 overflow-auto" style="max-height: 85vh;">
            <div class="row g-0">
              <div class="col-lg-5 bg-dark d-flex align-items-center justify-content-center p-3" style="min-height: 250px;">
                  <img src="" id="popupFoto" class="img-fluid rounded shadow-sm w-100" style="max-height: 60vh; object-fit: contain;">
              </div>
              <div class="col-lg-7 bg-white p-4">
                  <nav aria-label="breadcrumb">
                      <ol class="breadcrumb small mb-3">
                          <li class="breadcrumb-item">Desa Candimulyo</li>
                          <li class="breadcrumb-item" id="popupWilayah">-</li>
                          <li class="breadcrumb-item">RW <span id="popupRW">-</span></li>
                          <li class="breadcrumb-item active">RT <span id="popupRT">-</span></li>
                      </ol>
                  </nav>

                  <h2 class="fw-bold text-dark mb-2" id="popupJudul">Loading...</h2>
                  <h6 class="text-muted fw-normal mb-3">
                      <i class="bi bi-person-circle me-2"></i><span id="popupPemilik">-</span>
                  </h6>
                  <div class="mb-3" id="popupBadges"></div>
                  <hr class="my-3">
                  <h6 class="fw-bold text-uppercase text-secondary mb-3 small">
                      <i class="bi bi-box-seam me-2"></i>Deskripsi Produk/Jasa
                  </h6>
                  <p class="text-dark lh-lg mb-4" style="text-align: justify; white-space: pre-line;" id="popupDeskripsi">
                      Sedang memuat data...
                  </p>
                  
                  <div class="d-grid gap-2 mt-4 mb-3">
                      <a href="#" id="popupMaps" target="_blank" rel="noopener" class="btn btn-primary btn-lg rounded-pill shadow-sm fw-bold">
                          <i class="bi bi-geo-alt-fill me-2"></i> 
                          Lihat Lokasi di Google Maps
                      </a>
                      
                      <a href="#" id="popupWA" target="_blank" rel="noopener" class="btn btn-success btn-lg rounded-pill shadow-sm fw-bold">
                          <i class="bi bi-whatsapp me-2"></i> 
                          <span class="d-none d-sm-inline">Hubungi via</span> WhatsApp
                      </a>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalTentang" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold"><i class="bi bi-info-circle-fill text-primary me-2"></i>Tentang Portal UMKM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <h5 class="fw-bold mb-3">Apa itu Portal UMKM?</h5>
                    <p class="text-muted">
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
                    <p class="text-muted">
                        Portal ini mencakup seluruh UMKM yang berdomisili di Desa Candimulyo, 
                        yang terdiri dari beberapa RW dan RT dengan berbagai kategori usaha.
                    </p>
                    
                    <h6 class="fw-bold mb-3 mt-4">Tim Pengembang</h6>
                    <p class="text-muted mb-0">
                        Website ini dikembangkan oleh Tim KKN GIAT 15 Universitas Negeri Semarang (UNNES) Tahun 2026 
                        sebagai bagian dari program pengabdian masyarakat untuk mendukung pemberdayaan ekonomi desa.
                    </p>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCaraPesan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold"><i class="bi bi-cart-check-fill text-success me-2"></i>Cara Pemesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="alert alert-warning" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Perhatian:</strong> Portal ini BUKAN toko online. Pemesanan dilakukan langsung 
                        dengan penjual melalui WhatsApp.
                    </div>
                    
                    <h6 class="fw-bold mb-3">Langkah-Langkah Pemesanan:</h6>
                    
                    <div class="card bg-light border-0 mb-3">
                        <div class="card-body">
                            <ol class="mb-0 ps-3">
                                <li class="mb-3">
                                    <strong>Cari Produk yang Diinginkan</strong><br>
                                    <small class="text-muted">Jelajahi produk di halaman Beranda. Gunakan fitur pencarian atau filter kategori untuk menemukan apa yang Anda butuhkan.</small>
                                </li>
                                <li class="mb-3">
                                    <strong>Klik Kartu UMKM</strong><br>
                                    <small class="text-muted">Klik gambar atau tombol "Lihat Detail" pada produk yang Anda minati untuk melihat informasi lengkap.</small>
                                </li>
                                <li class="mb-3">
                                    <strong>Hubungi Penjual</strong><br>
                                    <small class="text-muted">Di jendela detail, klik tombol hijau "Hubungi via WhatsApp". Anda akan diarahkan langsung ke aplikasi WhatsApp penjual.</small>
                                </li>
                                <li class="mb-0">
                                    <strong>Lakukan Transaksi</strong><br>
                                    <small class="text-muted">Tanyakan stok, harga, dan detail lainnya. Transaksi dilakukan langsung antara Anda dan penjual (di luar platform ini).</small>
                                </li>
                            </ol>
                        </div>
                    </div>
                    
                    <div class="alert alert-success" role="alert">
                        <i class="bi bi-shield-check me-2"></i>
                        <strong>Tips Aman Berbelanja:</strong>
                        <ul class="mb-0 mt-2 small">
                            <li>Pastikan nomor WhatsApp yang dihubungi sesuai dengan yang tertera di portal</li>
                            <li>Tanyakan detail produk secara lengkap sebelum memesan</li>
                            <li>Gunakan metode pembayaran yang aman (COD/transfer dengan bukti)</li>
                            <li>Simpan bukti komunikasi dan transaksi</li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const BASE_URL = "<?= base_url() ?>";
        let currentView = "<?= $viewMode ?? 'grid' ?>"; // default grid
        let allUmkmData = <?= json_encode($umkm) ?>; // SIMPAN SEMUA DATA UMKM DI JAVASCRIPT

        // ============================================
        // FILTER OTOMATIS SAAT DROPDOWN BERUBAH
        // ============================================
        document.getElementById('wilayahFilter').addEventListener('change', applyFilter);
        document.getElementById('kategoriFilter').addEventListener('change', applyFilter);
        
        // SEARCH SAAT ENTER ATAU KETIK
        document.getElementById('searchInput').addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                applyFilter();
            }
        });

        function applyFilter() {
            const keyword = document.getElementById('searchInput').value.toLowerCase();
            const wilayahId = document.getElementById('wilayahFilter').value;
            const kategori = document.getElementById('kategoriFilter').value;

            let filtered = allUmkmData;

            // FILTER BERDASARKAN KEYWORD
            if (keyword) {
                filtered = filtered.filter(umkm => 
                    umkm.nama_usaha.toLowerCase().includes(keyword) || 
                    (umkm.produk && umkm.produk.toLowerCase().includes(keyword))
                );
            }

            // FILTER BERDASARKAN WILAYAH
            if (wilayahId) {
                filtered = filtered.filter(umkm => umkm.id_wilayah == wilayahId);
            }

            // FILTER BERDASARKAN KATEGORI
            if (kategori) {
                filtered = filtered.filter(umkm => umkm.kategori && umkm.kategori.includes(kategori));
            }

            // UPDATE UI
            updateUmkmDisplay(filtered);
            updateActiveFilters(keyword, wilayahId, kategori);
            document.getElementById('countDisplay').textContent = filtered.length;
            document.getElementById('totalUmkmStat').textContent = filtered.length + '+';
        }

        function resetFilter() {
            document.getElementById('searchInput').value = '';
            document.getElementById('wilayahFilter').value = '';
            document.getElementById('kategoriFilter').value = '';
            applyFilter();
        }

        function updateActiveFilters(keyword, wilayahId, kategori) {
            let html = '<small class="text-muted">';
            
            if (keyword) {
                html += `<span class="badge bg-light text-dark border me-1"><i class="bi bi-search"></i> "${keyword}"</span>`;
            }
            
            if (wilayahId) {
                const wilayahSelect = document.getElementById('wilayahFilter');
                const wilayahName = wilayahSelect.options[wilayahSelect.selectedIndex].text;
                html += `<span class="badge bg-light text-dark border me-1"><i class="bi bi-geo-alt"></i> ${wilayahName}</span>`;
            }
            
            if (kategori) {
                html += `<span class="badge bg-light text-dark border me-1"><i class="bi bi-tag"></i> ${kategori}</span>`;
            }
            
            if (keyword || wilayahId || kategori) {
                html += '<button class="btn btn-sm btn-outline-secondary ms-2" onclick="resetFilter()"><i class="bi bi-x-circle"></i> Reset</button>';
            }
            
            html += '</small>';
            document.getElementById('activeFilters').innerHTML = html;
        }

        // ============================================
        // TOGGLE GRID / LIST TANPA REFRESH
        // ============================================
        function toggleView(view) {
            currentView = view;
            
            // UPDATE TOMBOL
            document.getElementById('btnGrid').classList.toggle('active', view === 'grid');
            document.getElementById('btnList').classList.toggle('active', view === 'list');
            
            // RE-RENDER
            applyFilter();
        }

        // ============================================
        // RENDER UMKM CARDS
        // ============================================
        function updateUmkmDisplay(umkmList) {
            const container = document.getElementById('umkmContainer');
            
            if (umkmList.length === 0) {
                container.innerHTML = `
                    <div class="empty-state text-center py-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="Empty Data" width="100" style="opacity:0.5; filter:grayscale(1);">
                        <h5 class="mt-3 text-muted">Tidak ada UMKM ditemukan</h5>
                        <p class="text-secondary">Coba ubah kata kunci pencarian atau reset filter</p>
                        <button class="btn btn-primary mt-3" onclick="resetFilter()">
                            <i class="bi bi-arrow-counterclockwise me-2"></i>Tampilkan Semua
                        </button>
                    </div>
                `;
                return;
            }

            const rowClass = currentView === 'grid' 
                ? 'row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-4' 
                : 'row row-cols-1 g-3';

            let html = `<div class="${rowClass}" id="umkmGrid">`;

            umkmList.forEach(umkm => {
                const foto = (umkm.foto_umkm && umkm.foto_umkm != 'default.jpg')
                    ? BASE_URL + '/uploads/umkm/' + umkm.foto_umkm 
                    : 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300"%3E%3Crect fill="%23e9ecef" width="400" height="300"/%3E%3Ctext x="50%25" y="50%25" text-anchor="middle" fill="%23adb5bd" font-size="20" font-family="Arial"%3ENo Image%3C/text%3E%3C/svg%3E';

                const colors = {
                    'Kuliner': 'danger', 'Fashion': 'info', 'Agrobisnis': 'success',
                    'Jasa': 'primary', 'Kerajinan': 'warning', 'Toko': 'secondary'
                };

                const kategoriList = umkm.kategori ? umkm.kategori.split(', ') : ['Lainnya'];
                let badges = '';
                kategoriList.forEach(kat => {
                    const color = colors[kat] || 'secondary';
                    badges += `<span class="badge bg-${color}">${kat}</span>`;
                });

                if (currentView === 'grid') {
                    html += `
                        <div class="col">
                            <div class="card h-100 card-umkm shadow-sm border-0" onclick="bukaPopup(${umkm.id_umkm})" style="cursor:pointer;">
                                <div class="umkm-img-container">
                                    <img src="${foto}" alt="${umkm.nama_usaha}">
                                    <div class="category-badge-container">${badges}</div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-dark mb-2">${umkm.nama_usaha}</h5>
                                    <p class="card-text text-muted small mb-2"><i class="bi bi-person me-1"></i>${umkm.pemilik}</p>
                                    <p class="card-text">
                                        <span class="badge bg-light text-dark border"><i class="bi bi-geo-alt"></i> ${umkm.nama_wilayah}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    `;
                } else {
                    html += `
                        <div class="col">
                            <div class="card h-100 card-umkm shadow-sm border-0" onclick="bukaPopup(${umkm.id_umkm})" style="cursor:pointer;">
                                <div class="row g-0 h-100">
                                    <div class="col-md-4">
                                        <div class="umkm-img-container-list h-100">
                                            <img src="${foto}" alt="${umkm.nama_usaha}">
                                            <div class="category-badge-container">${badges}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body d-flex flex-column h-100">
                                            <h5 class="card-title fw-bold mb-2">${umkm.nama_usaha}</h5>
                                            <p class="card-text text-muted small mb-2"><i class="bi bi-person me-1"></i>${umkm.pemilik}</p>
                                            <p class="card-text text-truncate mb-3">${umkm.produk || ''}</p>
                                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                                <span class="badge bg-light text-dark border"><i class="bi bi-geo-alt"></i> ${umkm.nama_wilayah}</span>
                                                <button class="btn btn-sm btn-primary rounded-pill">Lihat Detail <i class="bi bi-arrow-right ms-1"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }
            });

            html += '</div>';
            container.innerHTML = html;
        }

        // ============================================
        // POPUP MODAL DETAIL
        // ============================================
        function bukaPopup(id) {
            const myModal = new bootstrap.Modal(document.getElementById('modalDetail'));
            document.getElementById('popupJudul').innerText = "Memuat...";
            document.getElementById('popupFoto').src = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300'%3E%3Crect fill='%23e9ecef' width='400' height='300'/%3E%3Ctext x='50%25' y='50%25' text-anchor='middle' fill='%23adb5bd' font-size='18'%3ELoading...%3C/text%3E%3C/svg%3E"; 
            myModal.show();

            fetch(BASE_URL + '/get-umkm/' + id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('popupJudul').innerText = data.nama_usaha;
                    document.getElementById('popupPemilik').innerText = data.pemilik;
                    document.getElementById('popupWilayah').innerText = data.nama_wilayah;
                    document.getElementById('popupRW').innerText = data.rw;
                    document.getElementById('popupRT').innerText = data.rt;
                    document.getElementById('popupDeskripsi').innerText = data.produk || 'Belum ada deskripsi';

                    let katString = data.kategori || 'Lainnya';
                    let kategoriList = katString.split(', ');
                    
                    let colors = {'Kuliner':'danger', 'Fashion':'info', 'Agrobisnis':'success', 'Jasa':'primary', 'Kerajinan':'warning', 'Toko':'secondary'};
                    
                    let badgesHtml = '';
                    kategoriList.forEach(kat => {
                        let color = colors[kat] || 'secondary';
                        badgesHtml += `<span class="badge bg-${color} me-2">${kat}</span>`;
                    });
                    
                    badgesHtml += `<span class="badge bg-light text-dark border">RW ${data.rw}</span>`;
                    
                    document.getElementById('popupBadges').innerHTML = badgesHtml;

                    let fotoUrl = (data.foto_umkm && data.foto_umkm != 'default.jpg') 
                        ? BASE_URL + '/uploads/umkm/' + data.foto_umkm 
                        : 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600"%3E%3Crect fill="%23e9ecef" width="600" height="600"/%3E%3Ctext x="50%25" y="50%25" text-anchor="middle" fill="%23adb5bd" font-size="24"%3ENo Image%3C/text%3E%3C/svg%3E';
                    document.getElementById('popupFoto').src = fotoUrl;

                    // === FITUR BARU: GOOGLE MAPS AUTO-LINK ===
                    let queryMaps = encodeURIComponent(data.nama_usaha + ' ' + data.nama_wilayah + ' Candimulyo Kedu Temanggung');
                    let linkMaps = 'https://www.google.com/maps/search/?api=1&query=' + queryMaps;
                    document.getElementById('popupMaps').href = linkMaps;
                    
                    if(data.kontak_hp) {
                        let hp = data.kontak_hp.replace(/\D/g,''); 
                        if(hp.startsWith('0')) hp = '62' + hp.substring(1);
                        let pesan = `Halo, saya tertarik dengan ${data.nama_usaha} di Portal UMKM Desa Candimulyo.`;
                        document.getElementById('popupWA').href = "https://wa.me/" + hp + "?text=" + encodeURIComponent(pesan);
                        document.getElementById('popupWA').classList.remove('disabled', 'btn-secondary');
                        document.getElementById('popupWA').classList.add('btn-success');
                    } else {
                        document.getElementById('popupWA').href = "#";
                        document.getElementById('popupWA').classList.add('disabled', 'btn-secondary');
                        document.getElementById('popupWA').innerHTML = '<i class="bi bi-x-circle me-2"></i>Tidak Ada Kontak';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('popupJudul').innerText = "Error";
                });
        }
        
        document.getElementById('modalDetail').addEventListener('click', function(e) {
            if (e.target === this) {
                bootstrap.Modal.getInstance(this).hide();
            }
        });
    </script>
  </body>
</html>