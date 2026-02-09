<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data UMKM - Portal UMKM Candimulyo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="bi bi-plus-circle me-2"></i>
                            Tambah Data UMKM Baru
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
                        
                        <form action="<?= base_url('admin/save') ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            
                            <div class="row">
                                <!-- Nama Usaha -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        Nama Usaha <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="nama_usaha" class="form-control" 
                                           placeholder="Contoh: Warung Makan Pak Budi" 
                                           value="<?= old('nama_usaha') ?>" required>
                                </div>

                                <!-- Nama Pemilik -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        Nama Pemilik <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="pemilik" class="form-control" 
                                           placeholder="Contoh: Budi Santoso" 
                                           value="<?= old('pemilik') ?>" required>
                                </div>

                                <!-- Kategori (Multiple Checkbox) -->
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-semibold">
                                        Kategori Usaha <span class="text-danger">*</span>
                                    </label>
                                    <div class="border rounded p-3 bg-light">
                                        <div class="row">
                                            <?php foreach (KATEGORI_UMKM as $kategori): ?>
                                                <div class="col-md-4 col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" 
                                                               name="kategori[]" 
                                                               value="<?= $kategori ?>" 
                                                               id="kat_<?= strtolower($kategori) ?>"
                                                               <?= (old('kategori') && in_array($kategori, old('kategori'))) ? 'checked' : '' ?>>
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
                                                <?= (old('id_wilayah') == $w['id_wilayah']) ? 'selected' : '' ?>>
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
                                           placeholder="001" 
                                           value="<?= old('rt') ?>" 
                                           min="1" max="999" required>
                                </div>

                                <!-- Kontak HP -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        Nomor WhatsApp <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="kontak_hp" class="form-control" 
                                           placeholder="08xx / 628xx (otomatis diformat)" 
                                           value="<?= old('kontak_hp') ?>" required>
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
                                    <textarea name="produk" class="form-control" rows="3" 
                                              placeholder="Contoh: Menyediakan nasi goreng, mie ayam, dan aneka minuman"
                                              required><?= old('produk') ?></textarea>
                                </div>

                                <!-- Upload Foto -->
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-semibold">
                                        Foto Usaha / Produk
                                    </label>
                                    <input type="file" name="foto_umkm" class="form-control" 
                                           accept="image/jpeg,image/jpg,image/png,image/gif">
                                    <small class="text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Format: JPG, PNG, GIF | Max: 2MB | Direkomendasikan rasio 4:3
                                    </small>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="d-flex gap-2 mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i> Simpan Data
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