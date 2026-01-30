<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin UMKM Candimulyo</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  </head>
  <body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark mb-4 shadow-sm" style="background: linear-gradient(90deg, #2C3E50, #4CA1AF);">
      <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url('admin') ?>">
            <i class="bi bi-speedometer2 me-2"></i>Admin Desa Candimulyo
        </a>

        <div class="d-flex align-items-center">
            <span class="navbar-text text-white me-3 d-none d-md-block">
                <i class="bi bi-person-circle me-1"></i> 
                Hai, <?= session()->get('nama_lengkap') ?>
            </span>
            <a href="<?= base_url('logout') ?>" class="btn btn-sm btn-danger border-0 shadow-sm">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
      </div>
    </nav>

    <div class="container mb-5">

      <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card text-white bg-primary bg-gradient shadow-sm h-100 border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="card-title mb-1 text-white-50">Total UMKM</h6>
                        <h2 class="fw-bold mb-0"><?= isset($total_umkm) ? $total_umkm : 0 ?></h2>
                        <small>Unit Usaha Terdaftar</small>
                    </div>
                    <div>
                        <i class="bi bi-shop-window" style="font-size: 3rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card text-white bg-success bg-gradient shadow-sm h-100 border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="card-title mb-1 text-white-50">Jangkauan Wilayah</h6>
                        <h2 class="fw-bold mb-0"><?= isset($total_wilayah) ? $total_wilayah : 0 ?></h2>
                        <small>Dusun / RW Tercover</small>
                    </div>
                    <div>
                        <i class="bi bi-geo-alt-fill" style="font-size: 3rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
      </div>

        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
          <h5 class="mb-0 fw-bold text-primary">
              <i class="bi bi-table me-2"></i>Data UMKM
          </h5>
          <div>
              <a href="<?= base_url('admin/export') ?>" class="btn btn-sm btn-outline-success me-2 shadow-sm">
                <i class="bi bi-file-earmark-excel-fill"></i> Export Excel
              </a>
              
              <a href="<?= base_url('admin/create') ?>" class="btn btn-sm btn-primary shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah UMKM
              </a>
          </div>
        </div>
        
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
              <thead class="table-light text-center">
                <tr>
                  <th width="5%">No</th>
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
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-1 d-block mb-3 opacity-25"></i>
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
                                <i class="bi bi-person me-1 text-secondary"></i>
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
                            
                            <td class="text-center">
                                <a href="<?= base_url('admin/edit/' . $row['id_umkm']) ?>" class="btn btn-sm btn-warning mb-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                
                                <a href="<?= base_url('admin/delete/' . $row['id_umkm']) ?>" 
                                   class="btn btn-sm btn-danger mb-1" 
                                   onclick="return confirm('Yakin ingin menghapus data <?= esc($row['nama_usaha']) ?>?')">
                                   <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
        
        <div class="card-footer text-muted text-end small bg-light">
            Sistem Pendataan UMKM Desa Candimulyo &copy; <?= date('Y') ?>
        </div>
      </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>