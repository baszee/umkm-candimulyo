<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah UMKM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        
        .form-label {
            font-weight: 500;
            color: #2C3E50;
        }
        
        .required::after {
            content: ' *';
            color: #dc3545;
        }
    </style>
  </head>
  <body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-dark mb-4 shadow-sm" style="background: linear-gradient(90deg, #2C3E50, #4CA1AF);">
      <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url('admin') ?>">
            <i class="bi bi-arrow-left me-2"></i>
            <span class="d-none d-sm-inline">Kembali ke Dashboard</span>
            <span class="d-sm-none">Kembali</span>
        </a>
      </div>
    </nav>

    <div class="container mt-4 mb-5">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">
              <i class="bi bi-plus-circle me-2"></i>Form Tambah UMKM
          </h5>
        </div>
        <div class="card-body p-4">
          
          <?php if(session()->getFlashdata('errors')): ?>
              <div class="alert alert-danger alert-dismissible fade show">
                  <h6 class="alert-heading"><i class="bi bi-exclamation-triangle me-2"></i>Terjadi Kesalahan!</h6>
                  <ul class="mb-0">
                      <?php foreach(session()->getFlashdata('errors') as $error): ?>
                          <li><?= esc($error) ?></li>
                      <?php endforeach; ?>
                  </ul>
                  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
          <?php endif; ?>

          <form action="<?= base_url('admin/save') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="mb-4">
              <label class="form-label required">Nama Usaha</label>
              <input type="text" name="nama_usaha" class="form-control form-control-lg" 
                     required placeholder="Contoh: Keripik Tempe Bu Susi"
                     value="<?= old('nama_usaha') ?>">
              <small class="text-muted">Masukkan nama usaha yang mudah diingat</small>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <label class="form-label required">Nama Pemilik</label>
                    <input type="text" name="pemilik" class="form-control form-control-lg" 
                           required value="<?= old('pemilik') ?>">
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <label class="form-label">No HP / WhatsApp</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text"><i class="bi bi-whatsapp text-success"></i></span>
                        <input type="tel" name="kontak_hp" class="form-control" 
                               placeholder="Contoh: 081234567890" 
                               pattern="[0-9+]+"
                               value="<?= old('kontak_hp') ?>">
                    </div>
                    <small class="text-muted">Format: 08xx atau +62xxx atau 628xx</small>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <label class="form-label required">Wilayah (Dusun/RW)</label>
                    <select name="id_wilayah" class="form-select form-select-lg" required>
                        <option value="">-- Pilih Wilayah --</option>
                        <?php foreach($wilayah as $w): ?>
                            <option value="<?= $w['id_wilayah'] ?>" <?= old('id_wilayah') == $w['id_wilayah'] ? 'selected' : '' ?>>
                                <?= $w['nama_wilayah'] ?> (RW <?= $w['rw'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <label class="form-label required">RT</label>
                    <input type="text" name="rt" class="form-control form-control-lg" 
                           placeholder="Contoh: 04" required maxlength="5"
                           value="<?= old('rt') ?>">
                    <small class="text-muted">Cukup angka saja (misal: 04)</small>
                </div>
            </div>

            <div class="mb-4">
              <label class="form-label">Deskripsi Produk / Jasa</label>
              <textarea name="produk" class="form-control" rows="4" 
                        placeholder="Jelaskan produk atau jasa yang ditawarkan..."><?= old('produk') ?></textarea>
              <small class="text-muted">Deskripsikan dengan jelas agar mudah dipahami pembeli</small>
            </div>

            <div class="mb-4">
              <label class="form-label">Foto Produk/Usaha</label>
              <input type="file" name="foto_umkm" class="form-control form-control-lg" 
                     accept="image/*" capture="camera">
              <small class="text-muted">
                  <i class="bi bi-info-circle me-1"></i>
                  Format: JPG/PNG. Maksimal 2MB. Jika kosong akan pakai gambar default.
              </small>
            </div>

            <hr class="my-4">
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <a href="<?= base_url('admin') ?>" class="btn btn-secondary btn-lg">
                  <i class="bi bi-x-circle me-2"></i>Batal
              </a>
              <button type="submit" class="btn btn-primary btn-lg">
                  <i class="bi bi-save me-2"></i>Simpan Data
              </button>
            </div>

          </form>

        </div>
        <div class="card-footer text-muted small">
            <i class="bi bi-info-circle me-1"></i>
            Pastikan semua data terisi dengan benar sebelum menyimpan.
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>