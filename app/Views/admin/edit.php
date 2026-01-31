<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit UMKM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">

    <div class="container mt-5 mb-5">
      <div class="card shadow-sm">
        <div class="card-header">
          <h5 class="mb-0">Edit Data UMKM</h5>
        </div>
        <div class="card-body">
          
          <form action="<?= base_url('admin/update/' . $umkm['id_umkm']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?> <div class="mb-3">
            
            <input type="hidden" name="foto_lama" value="<?= $umkm['foto_umkm'] ?>">

            <div class="mb-3">
              <label class="form-label">Nama Usaha</label>
              <input type="text" name="nama_usaha" class="form-control" required 
                     value="<?= esc($umkm['nama_usaha']) ?>">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Pemilik</label>
                    <input type="text" name="pemilik" class="form-control" required
                           value="<?= esc($umkm['pemilik']) ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">No HP / WA</label>
                    <input type="text" name="kontak_hp" class="form-control"
                           value="<?= esc($umkm['kontak_hp']) ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Wilayah (Dusun/RW)</label>
                    <select name="id_wilayah" class="form-select" required>
                        <option value="">-- Pilih Wilayah --</option>
                        <?php foreach($wilayah as $w): ?>
                            <option value="<?= $w['id_wilayah'] ?>" <?= ($w['id_wilayah'] == $umkm['id_wilayah']) ? 'selected' : '' ?>>
                                <?= $w['nama_wilayah'] ?> (RW <?= $w['rw'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">RT</label>
                    <input type="text" name="rt" class="form-control" required
                           value="<?= esc($umkm['rt']) ?>">
                </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Produk / Jasa</label>
              <textarea name="produk" class="form-control" rows="3"><?= esc($umkm['produk']) ?></textarea>
            </div>

            <div class="mb-3">
              <label class="form-label">Ganti Foto (Opsional)</label>
              <input type="file" name="foto_umkm" class="form-control">
              <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="<?= base_url('admin') ?>" class="btn btn-secondary">Batal</a>

          </form>

        </div>
      </div>
    </div>

  </body>
</html>