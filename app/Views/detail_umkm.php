<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  </head>
  <body class="bg-light">

    <nav class="navbar navbar-dark shadow-sm" style="background: linear-gradient(90deg, #2C3E50, #4CA1AF);">
      <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url() ?>">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar
        </a>
      </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <div class="card shadow-lg border-0 overflow-hidden rounded-4">
                    <div class="row g-0">
                        <div class="col-md-5 bg-white d-flex align-items-center justify-content-center p-3">
                            <?php 
                                // Cek foto, kalau kosong pakai gambar default
                                $foto = $umkm['foto_umkm'] ? 'uploads/umkm/'.$umkm['foto_umkm'] : 'https://placehold.co/600x600?text=No+Image'; 
                            ?>
                            <img src="<?= base_url($foto) ?>" class="img-fluid rounded shadow-sm w-100" style="object-fit: cover; max-height: 500px;" alt="Foto Produk">
                        </div>

                        <div class="col-md-7">
                            <div class="card-body p-4 p-md-5">
                                
                                <div class="mb-3">
                                    <span class="badge bg-primary bg-gradient mb-2"><?= $umkm['nama_wilayah'] ?></span>
                                    <span class="badge bg-secondary mb-2">RW <?= $umkm['rw'] ?></span>
                                    <span class="badge bg-light text-dark border mb-2">RT <?= $umkm['rt'] ?></span>
                                </div>

                                <h1 class="fw-bold text-dark mb-1"><?= esc($umkm['nama_usaha']) ?></h1>
                                <p class="text-muted fs-5 mb-4">
                                    <i class="bi bi-person-circle me-2"></i> Pemilik: <strong><?= esc($umkm['pemilik']) ?></strong>
                                </p>

                                <hr>

                                <h5 class="fw-bold text-secondary">Deskripsi Produk/Jasa:</h5>
                                <p class="card-text lead fs-6" style="text-align: justify;">
                                    <?= nl2br(esc($umkm['produk'])) ?>
                                </p>

                                <div class="d-grid gap-2 mt-5">
                                    <?php if($umkm['kontak_hp']): ?>
                                        <a href="https://wa.me/<?= $umkm['kontak_hp'] ?>?text=Halo, saya lihat produk Anda di Web Desa Candimulyo..." target="_blank" class="btn btn-success btn-lg">
                                            <i class="bi bi-whatsapp me-2"></i> Hubungi Penjual (WhatsApp)
                                        </a>
                                    <?php else: ?>
                                        <button class="btn btn-secondary btn-lg" disabled>Tidak Ada Kontak WA</button>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container text-center py-4 text-muted small">
        &copy; <?= date('Y') ?> Portal UMKM Desa Candimulyo
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>