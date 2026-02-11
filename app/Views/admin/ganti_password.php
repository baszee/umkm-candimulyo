<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password - Portal UMKM Candimulyo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">
                            <i class="bi bi-shield-lock me-2"></i>
                            Ganti Password Admin
                        </h4>
                    </div>
                    <div class="card-body">
                        
                        <?php if (session()->has('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                <?= session('success') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->has('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <?= session('error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?= base_url('admin/update_password') ?>" method="POST">
                            <?= csrf_field() ?>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Password Lama <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password_lama" class="form-control" 
                                       placeholder="Masukkan password lama" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Password Baru <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password_baru" class="form-control" 
                                       placeholder="Minimal 6 karakter" required>
                                <small class="text-muted">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Gunakan kombinasi huruf dan angka untuk keamanan
                                </small>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    Konfirmasi Password Baru <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="konfirmasi_password" class="form-control" 
                                       placeholder="Ketik ulang password baru" required>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-warning text-dark">
                                    <i class="bi bi-save me-1"></i> Update Password
                                </button>
                                <a href="<?= base_url('admin') ?>" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>