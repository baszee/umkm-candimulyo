<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        /* Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        
        body { font-family: 'Poppins', sans-serif; }
        
        .hero-section {
            background: linear-gradient(135deg, #2C3E50, #4CA1AF);
            color: white;
            padding: 120px 0 60px;
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
        
        /* Stats Counter */
        .stats-row {
            display: flex; justify-content: center; gap: 3rem; margin-top: 2rem; flex-wrap: wrap;
        }
        .stat-item { text-align: center; padding: 1rem; }
        .stat-item h2 { font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.2); }
        .stat-item p { font-size: 0.9rem; opacity: 0.9; margin: 0; }
        
        /* Card UMKM */
        .card-umkm {
            cursor: pointer; transition: all 0.3s ease; border: 1px solid #e0e0e0; position: relative; overflow: hidden;
        }
        .card-umkm:hover { transform: translateY(-8px); box-shadow: 0 12px 24px rgba(0,0,0,0.15) !important; }
        .card-umkm img { transition: transform 0.3s ease; }
        .card-umkm:hover img { transform: scale(1.05); }
        
        /* Category Badge Container (Updated for Multi-Tags) */
        .category-badge-container {
            position: absolute; top: 10px; right: 10px; z-index: 2;
            display: flex; flex-direction: column; align-items: flex-end; gap: 5px;
        }
        .category-badge-container .badge {
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            font-size: 0.7rem; font-weight: 600;
        }
        
        /* Toast & Footer */
        .toast-container { position: fixed; top: 80px; right: 20px; z-index: 9999; }
        
        .footer {
            background: linear-gradient(135deg, #2C3E50, #34495e);
            color: white; padding: 3rem 0 1rem; margin-top: 4rem;
        }
        .footer a { color: #4CA1AF; text-decoration: none; transition: color 0.3s; }
        .footer a:hover { color: #6dbbc7; }
        .footer h6 { font-weight: 600; margin-bottom: 1rem; color: #4CA1AF; }
        
        .empty-state { text-align: center; padding: 4rem 2rem; }
        .empty-state i { font-size: 5rem; color: #ddd; margin-bottom: 1rem; }
        
        html { scroll-behavior: smooth; }
        
        @media (max-width: 576px) {
            .hero-section { padding: 100px 0 40px; }
            .hero-section h1 { font-size: 1.75rem !important; }
            .stats-row { gap: 1.5rem; }
        }
    </style>
  </head>
  <body class="bg-light d-flex flex-column min-vh-100">

    <div class="toast-container">
      <div class="toast align-items-center text-white bg-success border-0" role="alert" id="successToast">
        <div class="d-flex">
          <div class="toast-body">
            <i class="bi bi-check-circle me-2"></i> <span id="toastMessage"></span>
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
      </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm" style="background: linear-gradient(90deg, #2C3E50, #4CA1AF);">
      <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url() ?>">
            <i class="bi bi-shop-window me-2"></i>UMKM Candimulyo
        </a>
        <a href="<?= base_url('login') ?>" class="btn btn-outline-light btn-sm rounded-pill px-3 d-none d-md-inline-block">
            <i class="bi bi-shield-lock me-1"></i> Admin
        </a>
        <a href="<?= base_url('login') ?>" class="btn btn-outline-light btn-sm rounded-circle d-md-none" title="Admin Area">
            <i class="bi bi-shield-lock"></i>
        </a>
      </div>
    </nav>

    <header class="hero-section text-center">
        <div class="container">
            <h1 class="fw-bold mb-3" style="font-size: clamp(1.75rem, 4vw, 3rem);">
                Potensi Lokal Desa Candimulyo
            </h1>
            <p class="lead mb-4 opacity-90" style="font-size: clamp(1rem, 2vw, 1.25rem);">
                Katalog Digital Produk & Jasa Unggulan Warga
            </p>
            
            <div class="stats-row">
                <div class="stat-item">
                    <h2 class="text-warning"><?= count($umkm) ?>+</h2>
                    <p>UMKM Terdaftar</p>
                </div>
                <div class="stat-item">
                    <h2 class="text-info"><?= count($list_wilayah) ?></h2>
                    <p>Dusun Tercover</p>
                </div>
            </div>
            
            <div class="card shadow-lg border-0 p-3 mx-auto mt-4" style="max-width: 900px;">
                <form action="" method="get">
                    <input type="hidden" name="view" value="<?= $viewMode ?>">
                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <input type="text" name="cari" class="form-control" 
                                placeholder="Cari produk..." value="<?= esc($keyword) ?>">
                        </div>
                        <div class="col-12 col-md-3">
                            <select name="wilayah" class="form-select">
                                <option value="">- Semua Wilayah -</option>
                                <?php foreach($list_wilayah as $w): ?>
                                    <option value="<?= $w['id_wilayah'] ?>" <?= ($selectedWilayah == $w['id_wilayah']) ? 'selected' : '' ?>>
                                        <?= $w['nama_wilayah'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-3">
                            <select name="kategori" class="form-select">
                                <option value="">- Semua Kategori -</option>
                                <?php 
                                $cats = ['Kuliner', 'Fashion', 'Agrobisnis', 'Jasa', 'Kerajinan', 'Toko', 'Lainnya'];
                                foreach($cats as $c): 
                                ?>
                                    <option value="<?= $c ?>" <?= ($selectedKategori == $c) ? 'selected' : '' ?>><?= $c ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-2 d-grid">
                            <button class="btn btn-primary bg-gradient fw-bold" type="submit">
                                <i class="bi bi-search me-2"></i>Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </header>

    <div class="container py-4 flex-grow-1">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom flex-wrap gap-3">
            <div>
                <h5 class="text-muted mb-1">
                    <i class="bi bi-grid-3x3-gap me-2"></i>
                    Menampilkan <strong class="text-primary"><?= count($umkm) ?></strong> UMKM
                </h5>
                <?php if($keyword || $selectedWilayah || $selectedKategori): ?>
                    <small class="text-muted">
                        <?php if($keyword): ?>
                            <span class="badge bg-light text-dark border me-1"><i class="bi bi-search"></i> "<?= esc($keyword) ?>"</span>
                        <?php endif; ?>
                        <?php if($selectedWilayah): ?>
                            <?php $wilayahName = ''; foreach($list_wilayah as $w) { if($w['id_wilayah'] == $selectedWilayah) $wilayahName = $w['nama_wilayah']; } ?>
                            <span class="badge bg-light text-dark border me-1"><i class="bi bi-geo-alt"></i> <?= $wilayahName ?></span>
                        <?php endif; ?>
                        <?php if($selectedKategori): ?>
                            <span class="badge bg-light text-dark border me-1"><i class="bi bi-tag"></i> <?= esc($selectedKategori) ?></span>
                        <?php endif; ?>
                        <a href="<?= base_url() ?>" class="btn btn-sm btn-outline-secondary ms-2"><i class="bi bi-x-circle"></i> Reset</a>
                    </small>
                <?php endif; ?>
            </div>
            <div class="btn-group" role="group">
                <?php $baseUrl = base_url() . '?cari=' . $keyword . '&wilayah=' . $selectedWilayah . '&kategori=' . $selectedKategori; ?>
                <a href="<?= $baseUrl . '&view=grid' ?>" class="btn btn-outline-secondary <?= ($viewMode == 'grid') ? 'active' : '' ?>">
                    <i class="bi bi-grid-fill"></i> <span class="d-none d-sm-inline ms-1">Grid</span>
                </a>
                <a href="<?= $baseUrl . '&view=list' ?>" class="btn btn-outline-secondary <?= ($viewMode == 'list') ? 'active' : '' ?>">
                    <i class="bi bi-list-ul"></i> <span class="d-none d-sm-inline ms-1">List</span>
                </a>
            </div>
        </div>

        <?php if(empty($umkm)): ?>
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <h4 class="text-muted mb-3">Tidak ada UMKM ditemukan</h4>
                <p class="text-muted mb-4">Coba ubah kata kunci pencarian atau reset filter</p>
                <a href="<?= base_url() ?>" class="btn btn-primary"><i class="bi bi-arrow-counterclockwise me-2"></i>Tampilkan Semua</a>
            </div>
        <?php else: ?>
            <div class="row <?= ($viewMode == 'grid') ? 'row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-4' : 'row-cols-1 g-3' ?>">
                <?php foreach($umkm as $row): ?>
                    <?php 
                        $foto = $row['foto_umkm'] ? 'uploads/umkm/'.$row['foto_umkm'] : 'https://placehold.co/600x400?text=No+Image';
                        
                        // Warna Badge
                        $colors = [
                            'Kuliner' => 'danger', 'Fashion' => 'info', 'Agrobisnis' => 'success', 
                            'Jasa' => 'primary', 'Kerajinan' => 'warning', 'Toko' => 'secondary'
                        ];
                        
                        // Pecah string "Kategori, Kategori" menjadi array
                        $katString = $row['kategori'] ?? 'Lainnya';
                        $kategoriList = explode(', ', $katString);
                    ?>
                    <div class="col">
                        <div class="card h-100 card-umkm shadow-sm border-0" onclick="bukaPopup(<?= $row['id_umkm'] ?>)">
                            <?php if($viewMode == 'grid'): ?>
                                <div style="position: relative; overflow: hidden;">
                                    <img src="<?= base_url($foto) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                                    
                                    <div class="category-badge-container">
                                        <?php foreach($kategoriList as $kat): 
                                            $badgeColor = $colors[$kat] ?? 'secondary';
                                        ?>
                                            <span class="badge bg-<?= $badgeColor ?>"><?= esc($kat) ?></span>
                                        <?php endforeach; ?>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-dark mb-2"><?= esc($row['nama_usaha']) ?></h5>
                                    <p class="card-text text-muted small mb-2"><i class="bi bi-person me-1"></i><?= esc($row['pemilik']) ?></p>
                                    <p class="card-text">
                                        <span class="badge bg-light text-dark border"><i class="bi bi-geo-alt"></i> <?= esc($row['nama_wilayah']) ?></span>
                                    </p>
                                </div>
                            <?php else: ?>
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <div style="position: relative; overflow: hidden; height: 100%;">
                                            <img src="<?= base_url($foto) ?>" class="img-fluid rounded-start h-100" style="object-fit: cover; min-height: 180px;">
                                            
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
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold mb-2"><?= esc($row['nama_usaha']) ?></h5>
                                            <p class="card-text text-muted small mb-2"><i class="bi bi-person me-1"></i><?= esc($row['pemilik']) ?></p>
                                            <p class="card-text text-truncate mb-3"><?= esc($row['produk']) ?></p>
                                            <div class="d-flex justify-content-between align-items-center">
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

    <footer class="footer mt-auto">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h6><i class="bi bi-building me-2"></i>Kantor Desa</h6>
                    <p class="small mb-2">
                        <i class="bi bi-geo-alt me-2"></i>Pakisan, RT.02/RW.05 Candimulyo<br>Kec Kedu, Kabupaten Temanggung
                    </p>
                    <p class="small mb-0">
                        <i class="bi bi-envelope me-2"></i>candimulyo-kedu@temanggungkab.go.id
                    </p>
                </div>
                <div class="col-md-4">
                    <h6><i class="bi bi-link-45deg me-2"></i>Link Terkait</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#"><i class="bi bi-globe me-2"></i>Website Desa Candimulyo</a></li>
                        <li class="mb-2"><a href="<?= base_url('login') ?>"><i class="bi bi-shield-lock me-2"></i>Portal Admin</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6><i class="bi bi-info-circle me-2"></i>Tentang</h6>
                    <p class="small">Sistem pendataan UMKM digital untuk memajukan ekonomi lokal Desa Candimulyo.</p>
                    <p class="small mb-0"><i class="bi bi-people me-2"></i>Dibuat oleh <strong>KKN GIAT 15 UNNES 2026</strong></p>
                </div>
            </div>
            <hr class="my-3" style="border-color: rgba(255,255,255,0.1);">
            <div class="text-center small opacity-75">
                <p class="mb-0">&copy; <?= date('Y') ?> Portal UMKM Desa Candimulyo. Dikembangkan dengan <i class="bi bi-heart-fill text-danger"></i> untuk kemajuan desa.</p>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable"> 
        <div class="modal-content overflow-hidden border-0 shadow-lg rounded-4">
          <div class="row g-0">
            <div class="col-lg-5 bg-dark d-flex align-items-center justify-content-center p-3" style="min-height: 300px; max-height: 80vh;">
                <img src="" id="popupFoto" class="img-fluid rounded" style="max-height: 70vh; width: 100%; object-fit: contain;">
            </div>
            <div class="col-lg-7 d-flex flex-column bg-white">
                <div class="modal-header border-bottom-0 pb-2">
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 overflow-auto" style="max-height: 70vh;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb small">
                            <li class="breadcrumb-item">Desa Candimulyo</li>
                            <li class="breadcrumb-item" id="popupWilayah">-</li>
                            <li class="breadcrumb-item active" id="popupRT">-</li>
                        </ol>
                    </nav>
                    <h2 class="fw-bold text-dark mb-2" id="popupJudul">Loading...</h2>
                    <h6 class="text-muted fw-normal mb-3"><i class="bi bi-person-circle me-2"></i><span id="popupPemilik">-</span></h6>
                    
                    <div class="mb-3" id="popupBadges"></div>
                    
                    <hr class="my-3">
                    <h6 class="fw-bold text-uppercase text-secondary mb-3 small"><i class="bi bi-box-seam me-2"></i>Deskripsi Produk/Jasa</h6>
                    <p class="text-dark lh-lg" style="text-align: justify; white-space: pre-line;" id="popupDeskripsi">Sedang memuat data...</p>
                </div>
                <div class="modal-footer border-top-0 p-4 pt-0 mt-auto">
                    <div class="d-grid gap-2 w-100">
                        <a href="#" id="popupWA" target="_blank" class="btn btn-success btn-lg rounded-pill shadow-sm fw-bold">
                            <i class="bi bi-whatsapp me-2"></i> <span class="d-none d-sm-inline">Hubungi via</span> WhatsApp
                        </a>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle me-2"></i>Tutup</button>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const BASE_URL = "<?= base_url() ?>";

        function bukaPopup(id) {
            const myModal = new bootstrap.Modal(document.getElementById('modalDetail'));
            document.getElementById('popupJudul').innerText = "Memuat...";
            document.getElementById('popupFoto').src = "https://placehold.co/800x600?text=Loading..."; 
            myModal.show();

            fetch(BASE_URL + '/get-umkm/' + id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('popupJudul').innerText = data.nama_usaha;
                    document.getElementById('popupPemilik').innerText = data.pemilik;
                    document.getElementById('popupWilayah').innerText = data.nama_wilayah;
                    document.getElementById('popupRT').innerText = "RT " + data.rt;
                    document.getElementById('popupDeskripsi').innerText = data.produk || 'Belum ada deskripsi';

                    // Update Badge Kategori (Multi-Support)
                    let katString = data.kategori || 'Lainnya';
                    let kategoriList = katString.split(', '); // Pecah jadi array
                    
                    let colors = {'Kuliner':'danger', 'Fashion':'info', 'Agrobisnis':'success', 'Jasa':'primary', 'Kerajinan':'warning', 'Toko':'secondary'};
                    
                    let badgesHtml = '';
                    kategoriList.forEach(kat => {
                        let color = colors[kat] || 'secondary';
                        badgesHtml += `<span class="badge bg-${color} me-2">${kat}</span>`;
                    });
                    
                    // Tambah badge RW di akhir
                    badgesHtml += `<span class="badge bg-light text-dark border">RW ${data.rw}</span>`;
                    
                    document.getElementById('popupBadges').innerHTML = badgesHtml;

                    let fotoUrl = data.foto_umkm ? BASE_URL + '/uploads/umkm/' + data.foto_umkm : 'https://placehold.co/600x600?text=No+Image';
                    document.getElementById('popupFoto').src = fotoUrl;

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
    </script>
  </body>
</html>