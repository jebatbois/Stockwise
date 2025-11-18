<!DOCTYPE html>
<html>
<head>
    <title>Input Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">📝 Form Transaksi Stok</h4>
        </div>
        <div class="card-body">
            
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('transaksi/simpan') ?>" method="post">
                
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Barang</label>
                    <select name="item_id" class="form-select" required>
                        <option value="">-- Pilih Item --</option>
                        <?php foreach($items as $item): ?>
                            <option value="<?= $item['id'] ?>">
                                <?= $item['kode_item'] ?> - <?= $item['nama_item'] ?> (Sisa: <?= $item['stok'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Transaksi</label>
                        <select name="jenis" class="form-select fw-bold" required>
                            <option value="IN" class="text-success">➕ Masuk (Stock In)</option>
                            <option value="OUT" class="text-danger">➖ Keluar (Stock Out)</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" min="1" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">No. Dokumen</label>
                    <input type="text" name="dokumen" class="form-control" placeholder="Contoh: SJ-001 atau BON-123">
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" placeholder="Nama Supplier atau Tujuan Penggunaan"></textarea>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Simpan Transaksi</button>
                    <a href="<?= base_url('/') ?>" class="btn btn-secondary">Kembali ke Dashboard</a>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>