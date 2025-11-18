<?php

namespace App\Controllers;

use App\Models\ItemModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new ItemModel();
        
        // Ambil semua data barang, urutkan dari yang terbaru
        $data['items'] = $model->orderBy('id', 'DESC')->findAll();
        
        return view('dashboard', $data);
    }

    // Fitur tambahan: Tambah Barang Baru (Master Data)
    public function tambahBarang()
    {
        $model = new ItemModel();
        
        // Simpan data barang baru
        $model->save([
            'kode_item' => $this->request->getPost('kode'),
            'nama_item' => $this->request->getPost('nama'),
            'satuan'    => $this->request->getPost('satuan'),
            'stok'      => 0,  // Stok awal 0
            'stok_min'  => $this->request->getPost('stok_min'),
        ]);

        return redirect()->to('/');
    }
}