<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin UMKM Candimulyo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
      <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url('admin') ?>">Admin Desa Candimulyo</a>
      </div>
    </nav>

    <div class="container mb-5">
      <div class="card shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
          <h5 class="mb-0 fw-bold text-primary">Data UMKM</h5>
          <a href="<?= base_url('admin/create') ?>" class="btn btn-sm btn-success">
            + Tambah UMKM
          </a>
        </div>
        <div class="card-body">
          
          <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
              <thead class="table-light">
                <tr>
                  <th width="5%" class="text-center">No</th>
                  <th width="25%">Nama Usaha</th>
                  <th width="20%">Pemilik</th>
                  <th width="20%">Wilayah</th>
                  <th width="10%">RT</th>
                  <th width="20%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                
                <?php if(empty($umkm)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <em>Belum ada data UMKM. Silakan klik tombol Tambah.</em>
                        </td>
                    </tr>
                <?php else: ?>
                    
                    <?php foreach($umkm as $key => $row): ?>
                        <tr>
                            <td class="text-center"><?= $key + 1 ?></td>
                            
                            <td>
                                <strong class="text-dark"><?= esc($row['nama_usaha']) ?></strong>
                                <br>
                                <small class="text-muted fst-italic">
                                    <?= esc($row['produk']) ?>
                                </small>
                            </td>
                            
                            <td>
                                <?= esc($row['pemilik']) ?>
                                <br>
                                <small class="text-success">
                                    <i class="bi bi-whatsapp"></i> 
                                    <?= $row['kontak_hp'] ? esc($row['kontak_hp']) : '-' ?>
                                </small>
                            </td>
                            
                            <td>
                                <?= esc($row['nama_wilayah']) ?>
                                <br>
                                <span class="badge bg-info text-dark">RW <?= esc($row['rw']) ?></span>
                            </td>
                            
                            <td class="text-center">
                                RT <?= esc($row['rt']) ?>
                            </td>
                            
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
              </tbody>
            </table>
          </div>

        </div>
        <div class="card-footer text-muted text-end small">
            Sistem Pendataan UMKM Desa Candimulyo
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>