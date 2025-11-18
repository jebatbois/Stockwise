<!DOCTYPE html>
<html lang="id">
<head>
    <title>StockWise - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>📦 StockWise</h1>
        <div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                + Barang Baru
            </button>
            <a href="<?= base_url('transaksi') ?>" class="btn btn-success">
                📝 Input Masuk/Keluar
            </a>
        </div>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Stok Saat Ini</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($items as $item): ?>
                        <?php 
                            // Logika Visual Alert Stok Minimum
                            $isLow = $item['stok'] <= $item['stok_min']; 
                        ?>
                        <tr class="<?= $isLow ? 'table-danger' : '' ?>">
                            <td><?= $item['kode_item'] ?></td>
                            <td><?= $item['nama_item'] ?></td>
                            <td><?= $item['satuan'] ?></td>
                            <td class="fw-bold"><?= $item['stok'] ?></td>
                            <td>
                                <?php if($isLow): ?>
                                    <span class="badge bg-danger">Stok Menipis! (Min: <?= $item['stok_min'] ?>)</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Aman</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= base_url('home/tambahBarang') ?>" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Barang Master</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3"><label>Kode Barang</label><input type="text" name="kode" class="form-control" required></div>
                <div class="mb-3"><label>Nama Barang</label><input type="text" name="nama" class="form-control" required></div>
                <div class="mb-3"><label>Satuan</label><input type="text" name="satuan" class="form-control" placeholder="Pcs/Unit/Box" required></div>
                <div class="mb-3"><label>Stok Minimum (Alert)</label><input type="number" name="stok_min" class="form-control" value="10"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>