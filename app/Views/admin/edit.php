<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit UMKM</title>
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
        <div class="card-header bg-warning text-dark">
          <h5 class="mb-0">
              <i class="bi bi-pencil-square me-2"></i>Form Edit UMKM
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

          <form action="<?= base_url('admin/update/' . $umkm['id_umkm']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <input type="hidden" name="foto_lama" value="<?= $umkm['foto_umkm'] ?>">

            <div class="mb-4">
              <label class="form-label required">Nama Usaha</label>
              <input type="text" name="nama_usaha" class="form-control" 
                     required placeholder="Contoh: Keripik Tempe Bu Susi"
                     value="<?= esc($umkm['nama_usaha']) ?>">
            </div>

            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <label class="form-label required">Nama Pemilik</label>
                    <input type="text" name="pemilik" class="form-control" 
                           required value="<?= esc($umkm['pemilik']) ?>">
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <label class="form-label">No HP / WhatsApp</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-whatsapp text-success"></i></span>
                        <input type="tel" name="kontak_hp" class="form-control" 
                               placeholder="Contoh: 081234567890" 
                               pattern="[0-9+]+"
                               value="<?= esc($umkm['kontak_hp']) ?>">
                    </div>
                    <small class="text-muted">Format: 08xx atau +62xxx atau 628xx</small>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <label class="form-label required">Wilayah (Dusun/RW)</label>
                    <select name="id_wilayah" class="form-select" required>
                        <option value="">-- Pilih Wilayah --</option>
                        <?php foreach($wilayah as $w): ?>
                            <option value="<?= $w['id_wilayah'] ?>" <?= ($w['id_wilayah'] == $umkm['id_wilayah']) ? 'selected' : '' ?>>
                                <?= $w['nama_wilayah'] ?> (RW <?= $w['rw'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <label class="form-label required">RT</label>
                    <input type="text" name="rt" class="form-control" 
                           placeholder="Contoh: 04" required maxlength="5"
                           value="<?= esc($umkm['rt']) ?>">
                </div>
            </div>

            <div class="mb-4">
              <label class="form-label">Deskripsi Produk / Jasa</label>
              <textarea name="produk" class="form-control" rows="4" 
                        placeholder="Jelaskan produk atau jasa yang ditawarkan..."><?= esc($umkm['produk']) ?></textarea>
            </div>

            <div class="mb-4">
              <label class="form-label">Ganti Foto (Opsional)</label>
              
              <?php if($umkm['foto_umkm'] && $umkm['foto_umkm'] !== 'default.jpg'): ?>
                  <div class="alert alert-info mb-3">
                      <small>
                          <i class="bi bi-image me-2"></i>
                          Foto saat ini: <strong><?= $umkm['foto_umkm'] ?></strong>
                      </small>
                  </div>
              <?php endif; ?>
              
              <input type="file" name="foto_umkm" class="form-control" 
                     accept="image/*" capture="camera">
              <small class="text-muted">
                  <i class="bi bi-info-circle me-1"></i>
                  Biarkan kosong jika tidak ingin mengganti foto. Format: JPG/PNG. Maksimal 2MB.
              </small>
            </div>

            <hr class="my-4">
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <a href="<?= base_url('admin') ?>" class="btn btn-secondary btn-lg">
                  <i class="bi bi-x-circle me-2"></i>Batal
              </a>
              <button type="submit" class="btn btn-warning btn-lg text-dark">
                  <i class="bi bi-save me-2"></i>Simpan Perubahan
              </button>
            </div>

          </form>

        </div>
        <div class="card-footer text-muted small">
            <i class="bi bi-info-circle me-1"></i>
            Pastikan semua perubahan sudah benar sebelum menyimpan.
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>