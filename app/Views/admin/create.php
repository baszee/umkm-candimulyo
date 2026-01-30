<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah UMKM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">

    <div class="container mt-5 mb-5">
      <div class="card shadow-sm">
        <div class="card-header">
          <h5 class="mb-0">Form Tambah UMKM</h5>
        </div>
        <div class="card-body">
          
          <form action="<?= base_url('admin/save') ?>" method="post" enctype="multipart/form-data">
            
            <div class="mb-3">
              <label class="form-label">Nama Usaha</label>
              <input type="text" name="nama_usaha" class="form-control" required placeholder="Contoh: Keripik Tempe Bu Susi">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Pemilik</label>
                    <input type="text" name="pemilik" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">No HP / WA</label>
                    <input type="text" name="kontak_hp" class="form-control" placeholder="Contoh: 62812345678">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Wilayah (Dusun/RW)</label>
                    <select name="id_wilayah" class="form-select" required>
                        <option value="">-- Pilih Wilayah --</option>
                        <?php foreach($wilayah as $w): ?>
                            <option value="<?= $w['id_wilayah'] ?>">
                                <?= $w['nama_wilayah'] ?> (RW <?= $w['rw'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">RT</label>
                    <input type="text" name="rt" class="form-control" placeholder="Contoh: 04" required>
                </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Produk / Jasa</label>
              <textarea name="produk" class="form-control" rows="3" placeholder="Deskripsikan produk..."></textarea>
            </div>

            <div class="mb-3">
              <label class="form-label">Foto UMKM</label>
              <input type="file" name="foto_umkm" class="form-control">
              <small class="text-muted">Format: JPG/PNG. Jika kosong akan pakai gambar default.</small>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <a href="<?= base_url('admin') ?>" class="btn btn-secondary">Batal</a>

          </form>

        </div>
      </div>
    </div>

  </body>
</html>