<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin UMKM Candimulyo</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        /* Mobile Card View */
        .umkm-card-mobile {
            border-left: 4px solid #4CA1AF;
            transition: all 0.3s;
        }
        
        .umkm-card-mobile:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateX(4px);
        }
        
        /* Toast */
        .toast-container {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 9999;
        }
    </style>
  </head>
  <body class="bg-light">

    <!-- Toast Notification -->
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

    <nav class="navbar navbar-expand-lg navbar-dark mb-4 shadow-sm" style="background: linear-gradient(90deg, #2C3E50, #4CA1AF);">
      <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url('admin') ?>">
            <i class="bi bi-speedometer2 me-2"></i>
            <span class="d-none d-md-inline">Admin Desa Candimulyo</span>
            <span class="d-md-none">Admin Panel</span>
        </a>

        <div class="d-flex align-items-center gap-2">
            <span class="navbar-text text-white me-2">
                <i class="bi bi-person-circle me-1"></i> 
                <span class="d-none d-md-inline"><?= session()->get('nama_lengkap') ?></span>
                <span class="d-md-none">Admin</span>
            </span>
            <a href="<?= base_url('logout') ?>" class="btn btn-sm btn-danger border-0 shadow-sm">
                <i class="bi bi-box-arrow-right"></i>
                <span class="d-none d-sm-inline ms-1">Logout</span>
            </a>
        </div>
      </div>
    </nav>

    <div class="container mb-5">

      <!-- Dashboard Stats -->
      <div class="row mb-4 g-3">
        <div class="col-12 col-md-6">
            <div class="card text-white bg-primary bg-gradient shadow-sm h-100 border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="card-title mb-1 text-white-50 small">Total UMKM</h6>
                        <h2 class="fw-bold mb-0"><?= isset($total_umkm) ? $total_umkm : 0 ?></h2>
                        <small class="opacity-75">Unit Usaha Terdaftar</small>
                    </div>
                    <div>
                        <i class="bi bi-shop-window" style="font-size: 3rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card text-white bg-success bg-gradient shadow-sm h-100 border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="card-title mb-1 text-white-50 small">Jangkauan Wilayah</h6>
                        <h2 class="fw-bold mb-0"><?= isset($total_wilayah) ? $total_wilayah : 0 ?></h2>
                        <small class="opacity-75">Dusun / RW Tercover</small>
                    </div>
                    <div>
                        <i class="bi bi-geo-alt-fill" style="font-size: 3rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
      </div>

      <!-- Table/Card Header -->
      <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
          <h5 class="mb-0 fw-bold text-primary">
              <i class="bi bi-table me-2"></i>Data UMKM
          </h5>
          <div class="d-flex gap-2 flex-wrap">
              <a href="<?= base_url('admin/export') ?>" class="btn btn-sm btn-outline-success shadow-sm">
                <i class="bi bi-file-earmark-excel-fill"></i>
                <span class="d-none d-sm-inline ms-1">Export Excel</span>
              </a>
              
              <a href="<?= base_url('admin/create') ?>" class="btn btn-sm btn-primary shadow-sm">
                <i class="bi bi-plus-circle me-1"></i>
                <span class="d-none d-sm-inline">Tambah UMKM</span>
                <span class="d-sm-none">Tambah</span>
              </a>
          </div>
        </div>
        
        <div class="card-body p-0">
          
          <!-- MOBILE VIEW: Card Layout (HP & Small Tablet) -->
          <div class="d-md-none p-3">
              <?php if(empty($umkm)): ?>
                  <div class="text-center py-5 text-muted">
                      <i class="bi bi-inbox fs-1 d-block mb-3 opacity-25"></i>
                      <em>Belum ada data UMKM.</em>
                  </div>
              <?php else: ?>
                  <?php foreach($umkm as $key => $row): ?>
                      <div class="card umkm-card-mobile mb-3 shadow-sm">
                          <div class="card-body">
                              <div class="d-flex justify-content-between align-items-start mb-2">
                                  <div class="flex-grow-1">
                                      <h6 class="fw-bold text-dark mb-1"><?= esc($row['nama_usaha']) ?></h6>
                                      <p class="text-muted small mb-2">
                                          <i class="bi bi-person me-1"></i><?= esc($row['pemilik']) ?>
                                      </p>
                                  </div>
                                  <span class="badge bg-light text-dark border">#<?= $key + 1 ?></span>
                              </div>
                              
                              <div class="mb-3">
                                  <span class="badge bg-info text-dark me-1">
                                      <i class="bi bi-geo-alt"></i> <?= esc($row['nama_wilayah']) ?>
                                  </span>
                                  <span class="badge bg-light text-dark border">
                                      RW <?= esc($row['rw']) ?> / RT <?= esc($row['rt']) ?>
                                  </span>
                              </div>
                              
                              <?php if($row['produk']): ?>
                                  <p class="card-text small text-muted mb-3">
                                      <i class="bi bi-box-seam me-1"></i>
                                      <?= strlen($row['produk']) > 80 ? substr(esc($row['produk']), 0, 80) . '...' : esc($row['produk']) ?>
                                  </p>
                              <?php endif; ?>
                              
                              <?php if($row['kontak_hp']): ?>
                                  <p class="card-text small text-success mb-3">
                                      <i class="bi bi-whatsapp me-1"></i>
                                      <?= esc($row['kontak_hp']) ?>
                                  </p>
                              <?php endif; ?>
                              
                              <div class="d-flex gap-2">
                                  <a href="<?= base_url('admin/edit/' . $row['id_umkm']) ?>" 
                                     class="btn btn-sm btn-warning flex-fill">
                                      <i class="bi bi-pencil-square"></i> Edit
                                  </a>
                                  
                                  <a href="<?= base_url('admin/delete/' . $row['id_umkm']) ?>" 
                                     class="btn btn-sm btn-danger flex-fill" 
                                     onclick="return confirm('Yakin ingin menghapus <?= esc($row['nama_usaha']) ?>?')">
                                     <i class="bi bi-trash"></i> Hapus
                                  </a>
                              </div>
                          </div>
                      </div>
                  <?php endforeach; ?>
              <?php endif; ?>
          </div>

          <!-- DESKTOP VIEW: Table Layout (Tablet & Desktop) -->
          <div class="table-responsive d-none d-md-block">
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light text-center">
                <tr>
                  <th width="5%">No</th>
                  <th width="25%">Nama Usaha</th>
                  <th width="20%">Pemilik</th>
                  <th width="15%">Wilayah</th>
                  <th width="10%">RT</th>
                  <th width="25%">Aksi</th>
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
                                    <?= strlen($row['produk']) > 50 ? substr(esc($row['produk']), 0, 50) . '...' : esc($row['produk']) ?>
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
                                <span class="badge bg-light text-dark border">
                                    RT <?= esc($row['rt']) ?>
                                </span>
                            </td>
                            
                            <td class="text-center">
                                <a href="<?= base_url('admin/edit/' . $row['id_umkm']) ?>" 
                                   class="btn btn-sm btn-warning mb-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                    <span class="d-none d-lg-inline ms-1">Edit</span>
                                </a>
                                
                                <a href="<?= base_url('admin/delete/' . $row['id_umkm']) ?>" 
                                   class="btn btn-sm btn-danger mb-1" 
                                   onclick="return confirm('Yakin ingin menghapus data <?= esc($row['nama_usaha']) ?>?')"
                                   title="Hapus">
                                   <i class="bi bi-trash"></i>
                                   <span class="d-none d-lg-inline ms-1">Hapus</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
        
        <div class="card-footer text-muted text-end small bg-light border-0">
            <i class="bi bi-shield-check me-1"></i>
            Sistem Pendataan UMKM Desa Candimulyo &copy; <?= date('Y') ?>
        </div>
      </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Show toast if success param exists
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('success')) {
            const toastEl = document.getElementById('successToast');
            const message = urlParams.get('success') === 'delete' ? 'Data berhasil dihapus!' : 'Data berhasil disimpan!';
            document.getElementById('toastMessage').innerText = message;
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
            
            // Clean URL
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    </script>
  </body>
</html>