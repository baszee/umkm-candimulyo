<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        .hero-section {
            background: linear-gradient(90deg, #2C3E50, #4CA1AF);
            color: white;
            padding: 100px 0 80px;
            border-bottom-left-radius: 50% 20px;
            border-bottom-right-radius: 50% 20px;
        }
        .card-umkm {
            cursor: pointer; /* Biar kursor jadi tangan */
            transition: all 0.3s;
        }
        .card-umkm:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
        }
        /* Style Modal Biar Keren */
        .modal-header { background-color: #f8f9fa; border-bottom: 1px solid #eee; }
        .modal-img-container {
            background: #000;
            height: 100%;
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-img-detail {
            max-height: 400px;
            max-width: 100%;
            object-fit: contain;
        }
    </style>
  </head>
  <body class="bg-light d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm" style="background: linear-gradient(90deg, #2C3E50, #4CA1AF);">
      <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url() ?>">
            <i class="bi bi-shop-window me-2"></i>UMKM Candimulyo
        </a>
        <div class="d-flex">
            <a href="<?= base_url('login') ?>" class="btn btn-outline-light btn-sm rounded-pill px-3">
                <i class="bi bi-person-fill me-1"></i> Admin Area
            </a>
        </div>
      </div>
    </nav>

    <header class="hero-section text-center">
        <div class="container">
            <h1 class="fw-bold mb-3 display-5">Potensi Lokal Desa Candimulyo</h1>
            <p class="lead mb-5 opacity-75">Katalog Digital Produk & Jasa Unggulan Warga</p>
            
            <div class="card shadow-lg border-0 p-3 mx-auto" style="max-width: 800px; margin-top: -30px;">
                <form action="" method="get">
                    <input type="hidden" name="view" value="<?= $viewMode ?>">
                    <div class="row g-2">
                        <div class="col-md-5">
                            <input type="text" name="cari" class="form-control" placeholder="Cari produk..." value="<?= esc($keyword) ?>">
                        </div>
                        <div class="col-md-4">
                            <select name="wilayah" class="form-select">
                                <option value="">- Semua Wilayah -</option>
                                <?php foreach($list_wilayah as $w): ?>
                                    <option value="<?= $w['id_wilayah'] ?>" <?= ($selectedWilayah == $w['id_wilayah']) ? 'selected' : '' ?>>
                                        <?= $w['nama_wilayah'] ?> (RW <?= $w['rw'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3 d-grid">
                            <button class="btn btn-primary bg-gradient fw-bold" type="submit">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </header>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
            <h5 class="text-muted mb-0">Menampilkan <strong><?= count($umkm) ?></strong> Data</h5>
            <div class="btn-group">
                <?php $baseUrl = base_url() . '?cari=' . $keyword . '&wilayah=' . $selectedWilayah; ?>
                <a href="<?= $baseUrl . '&view=grid' ?>" class="btn btn-outline-secondary <?= ($viewMode == 'grid') ? 'active' : '' ?>"><i class="bi bi-grid-fill"></i> Grid</a>
                <a href="<?= $baseUrl . '&view=list' ?>" class="btn btn-outline-secondary <?= ($viewMode == 'list') ? 'active' : '' ?>"><i class="bi bi-list-ul"></i> List</a>
            </div>
        </div>

        <?php if(empty($umkm)): ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-search display-1"></i><br>Data tidak ditemukan.
            </div>
        <?php else: ?>
            <div class="row <?= ($viewMode == 'grid') ? 'row-cols-1 row-cols-md-3 g-4' : 'row-cols-1 g-4' ?>">
                <?php foreach($umkm as $row): ?>
                    <?php 
                        $foto = $row['foto_umkm'] ? 'uploads/umkm/'.$row['foto_umkm'] : 'https://placehold.co/600x400?text=No+Image'; 
                        // KITA PAKAI ONCLICK UNTUK MEMANGGIL FUNGSI JS
                    ?>
                    <div class="col">
                        <div class="card h-100 card-umkm shadow-sm border-0" onclick="bukaPopup(<?= $row['id_umkm'] ?>)">
                            <?php if($viewMode == 'grid'): ?>
                                <img src="<?= base_url($foto) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-dark mb-1"><?= esc($row['nama_usaha']) ?></h5>
                                    <small class="text-muted"><i class="bi bi-geo-alt"></i> <?= esc($row['nama_wilayah']) ?></small>
                                </div>
                            <?php else: ?>
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <img src="<?= base_url($foto) ?>" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold"><?= esc($row['nama_usaha']) ?></h5>
                                            <p class="card-text text-truncate"><?= esc($row['produk']) ?></p>
                                            <button class="btn btn-sm btn-primary rounded-pill">Lihat Detail</button>
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

    <div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered"> <div class="modal-content overflow-hidden border-0 shadow-lg rounded-4" style="min-height: 500px;">
          
          <div class="row g-0 h-100">
            <div class="col-lg-7 bg-dark d-flex align-items-center justify-content-center" style="min-height: 400px; background-color: #000;">
                <img src="" id="popupFoto" class="img-fluid" style="max-height: 80vh; width: 100%; object-fit: contain;">
            </div>
            
            <div class="col-lg-5 d-flex flex-column bg-white">
                <div class="modal-header border-bottom-0 pb-0">
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body p-4 p-lg-5 overflow-auto" style="max-height: 80vh;">
                    <div class="mb-3">
                        <span class="badge bg-primary bg-gradient px-3 py-2" id="popupWilayah">-</span>
                        <span class="badge bg-secondary px-3 py-2" id="popupRW">-</span>
                        <span class="badge bg-light text-dark border px-3 py-2" id="popupRT">-</span>
                    </div>

                    <h2 class="fw-bold text-dark mb-2" id="popupJudul">Loading...</h2>
                    <h5 class="text-muted fw-normal mb-4">
                        <i class="bi bi-person-circle me-2"></i><span id="popupPemilik">-</span>
                    </h5>

                    <hr class="opacity-10 my-4">

                    <h6 class="fw-bold text-uppercase text-secondary mb-3 small ls-1">Deskripsi Produk</h6>
                    <p class="text-dark fs-6 lh-lg" style="text-align: justify; white-space: pre-line;" id="popupDeskripsi">
                        Sedang memuat data...
                    </p>
                </div>

                <div class="modal-footer justify-content-center border-top-0 pb-5 pt-0 px-5 mt-auto">
                    <a href="#" id="popupWA" target="_blank" class="btn btn-success btn-lg w-100 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-whatsapp me-2"></i> Hubungi via WhatsApp
                    </a>
                </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // 1. Siapkan Variabel URL biar JS tau alamat website
       <script>
        const BASE_URL = "<?= base_url() ?>";

        function bukaPopup(id) {
            // Tampilkan Modal Loading
            var myModal = new bootstrap.Modal(document.getElementById('modalDetail'));
            document.getElementById('popupJudul').innerText = "Memuat...";
            document.getElementById('popupFoto').src = "https://placehold.co/800x600?text=Loading..."; // Placeholder loading
            myModal.show();

            // Ambil Data dari Server
            fetch(BASE_URL + '/get-umkm/' + id)
                .then(response => {
                    if (!response.ok) { throw new Error("Gagal mengambil data"); }
                    return response.json();
                })
                .then(data => {
                    // Isi Data ke Popup
                    document.getElementById('popupJudul').innerText = data.nama_usaha;
                    document.getElementById('popupPemilik').innerText = data.pemilik;
                    document.getElementById('popupWilayah').innerText = data.nama_wilayah;
                    document.getElementById('popupRW').innerText = "RW " + data.rw;
                    document.getElementById('popupRT').innerText = "RT " + data.rt; // Ambil kolom RT dari UMKM
                    document.getElementById('popupDeskripsi').innerText = data.produk;

                    // Urus Foto
                    let fotoUrl = data.foto_umkm ? BASE_URL + '/uploads/umkm/' + data.foto_umkm : 'https://placehold.co/800x600?text=No+Image';
                    document.getElementById('popupFoto').src = fotoUrl;

                    // Urus Tombol WA
                    if(data.kontak_hp) {
                        // Bersihkan nomor HP (hapus spasi/strip jika ada)
                        let hp = data.kontak_hp.replace(/\D/g,''); 
                        // Kalau diawali 0, ganti jadi 62
                        if(hp.startsWith('0')){ hp = '62' + hp.substring(1); }
                        
                        let pesan = "Halo, saya lihat " + data.nama_usaha + " di Web Desa Candimulyo...";
                        document.getElementById('popupWA').href = "https://wa.me/" + hp + "?text=" + encodeURIComponent(pesan);
                        document.getElementById('popupWA').classList.remove('disabled', 'btn-secondary');
                        document.getElementById('popupWA').classList.add('btn-success');
                        document.getElementById('popupWA').innerHTML = '<i class="bi bi-whatsapp me-2"></i> Hubungi via WhatsApp';
                    } else {
                        document.getElementById('popupWA').href = "#";
                        document.getElementById('popupWA').classList.add('disabled', 'btn-secondary');
                        document.getElementById('popupWA').classList.remove('btn-success');
                        document.getElementById('popupWA').innerHTML = 'Tidak Ada Kontak';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('popupJudul').innerText = "Error";
                    document.getElementById('popupDeskripsi').innerText = "Gagal memuat data. Silakan coba lagi.";
                });
        }
    </script>

  </body>
</html>