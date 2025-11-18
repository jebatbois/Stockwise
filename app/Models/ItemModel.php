<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table            = 'items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // Field yang boleh diisi/diubah
    protected $allowedFields    = [
        'kode_item', 
        'nama_item', 
        'satuan', 
        'lokasi', 
        'stok',        // Penting: agar stok bisa diupdate
        'stok_min'
    ];

    // Mengaktifkan timestamp otomatis (created_at, updated_at)
    protected $useTimestamps = true;
}