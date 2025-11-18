<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table            = 'transactions';
    protected $primaryKey       = 'id';
    
    // --- PERBAIKAN DI SINI ---
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = ''; // Gunakan string kosong, JANGAN null
    // -------------------------

    protected $allowedFields    = [
        // Tambahkan 'created_at' agar tanggal benar-benar tersimpan
        'item_id', 'jenis', 'jumlah', 'tanggal', 'dokumen', 'keterangan', 'created_at'
    ];

    // --- LOGIKA BISNIS (Tetap sama seperti sebelumnya) ---
    protected $afterInsert = ['updateStokItem'];

    protected function updateStokItem(array $data)
    {
        $transaksi = $data['data'];
        $itemModel = new ItemModel();
        $item = $itemModel->find($transaksi['item_id']);
        
        if ($item) {
            $stokSekarang = $item['stok'];
            $jumlah       = $transaksi['jumlah'];
            
            if ($transaksi['jenis'] == 'IN') {
                $stokBaru = $stokSekarang + $jumlah; // [cite: 146]
            } else {
                $stokBaru = $stokSekarang - $jumlah; // [cite: 146]
            }

            $itemModel->update($transaksi['item_id'], ['stok' => $stokBaru]);
        }
        return $data;
    }
}