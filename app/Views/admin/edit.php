<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data UMKM - Portal UMKM Candimulyo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">
                            <i class="bi bi-pencil-square me-2"></i>
                            Edit Data UMKM
                        </h4>
                    </div>
                    <div class="card-body">
                        
                        <!-- Tampilkan Error Validasi -->
                        <?php if (session()->has('errors')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Terjadi Kesalahan:</strong>
                                <ul class="mb-0">
                                    <?php foreach (session('errors') as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?= base_url('admin/update/' . $umkm['id_umkm']) ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            
                            <!-- Hidden Field untuk Foto Lama -->
                            <input type="hidden" name="foto_lama" value="<?= $umkm['foto_umkm'] ?>">
                            
                            <div class="row">
                                <!-- Nama Usaha -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        Nama Usaha <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="nama_usaha" class="form-control" 
                                           value="<?= esc($umkm['nama_usaha']) ?>" required>
                                </div>

                                <!-- Nama Pemilik -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        Nama Pemilik <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="pemilik" class="form-control" 
                                           value="<?= esc($umkm['pemilik']) ?>" required>
                                </div>

                                <!-- Kategori (Multiple Checkbox) -->
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-semibold">
                                        Kategori Usaha <span class="text-danger">*</span>
                                    </label>
                                    <div class="border rounded p-3 bg-light">
                                        <div class="row">
                                            <?php 
                                            // Pisahkan kategori yang sudah tersimpan (format: "Kuliner, Fashion")
                                            $kategoriTersimpan = array_map('trim', explode(',', $umkm['kategori']));
                                            ?>
                                            <?php foreach (KATEGORI_UMKM as $kategori): ?>
                                                <div class="col-md-4 col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" 
                                                               name="kategori[]" 
                                                               value="<?= $kategori ?>" 
                                                               id="kat_<?= strtolower($kategori) ?>"
                                                               <?= in_array($kategori, $kategoriTersimpan) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="kat_<?= strtolower($kategori) ?>">
                                                            <?= $kategori ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <small class="text-muted">Pilih satu atau lebih kategori yang sesuai</small>
                                </div>

                                <!-- Wilayah -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">
                                        Wilayah <span class="text-danger">*</span>
                                    </label>
                                    <select name="id_wilayah" class="form-select" required>
                                        <option value="">-- Pilih Wilayah --</option>
                                        <?php foreach ($wilayah as $w): ?>
                                            <option value="<?= $w['id_wilayah'] ?>" 
                                                <?= ($umkm['id_wilayah'] == $w['id_wilayah']) ? 'selected' : '' ?>>
                                                <?= esc($w['nama_wilayah']) ?> (RW <?= $w['rw'] ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- RT -->
                                <div class="col-md-2 mb-3">
                                    <label class="form-label fw-semibold">
                                        RT <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="rt" class="form-control" 
                                           value="<?= $umkm['rt'] ?>" 
                                           min="1" max="999" required>
                                </div>

                                <!-- Kontak HP -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        Nomor WhatsApp <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="kontak_hp" class="form-control" 
                                           value="<?= esc($umkm['kontak_hp']) ?>" required>
                                    <small class="text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Format: 08xxx, 8xxx, atau 62xxx
                                    </small>
                                </div>

                                <!-- Produk -->
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-semibold">
                                        Deskripsi Produk <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="produk" class="form-control" rows="3" required><?= esc($umkm['produk']) ?></textarea>
                                </div>

                                <!-- Upload Foto -->
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-semibold">
                                        Foto Usaha / Produk
                                    </label>
                                    
                                    <!-- Preview Foto Lama -->
                                    <?php if ($umkm['foto_umkm'] && $umkm['foto_umkm'] !== 'default.jpg'): ?>
                                        <div class="mb-2">
                                            <img src="<?= base_url('uploads/umkm/' . $umkm['foto_umkm']) ?>" 
                                                 alt="Preview" 
                                                 class="img-thumbnail" 
                                                 style="max-height: 150px;">
                                            <p class="text-muted small mb-0 mt-1">Foto saat ini</p>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <input type="file" name="foto_umkm" class="form-control" 
                                           accept="image/jpeg,image/jpg,image/png,image/gif">
                                    <small class="text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Kosongkan jika tidak ingin mengubah foto | Format: JPG, PNG, GIF | Max: 2MB
                                    </small>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="d-flex gap-2 mt-4">
                                <button type="submit" class="btn btn-warning text-dark">
                                    <i class="bi bi-save me-1"></i> Update Data
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