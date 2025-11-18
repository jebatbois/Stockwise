<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\TransactionModel;

class Transaksi extends BaseController
{
    public function index()
    {
        $itemModel = new ItemModel();
        // Kirim daftar barang ke view untuk dropdown
        $data['items'] = $itemModel->findAll();
        
        return view('form_transaksi', $data);
    }

    public function simpan()
    {
        $modelTrans = new TransactionModel();
        $modelItem  = new ItemModel();

        // Ambil inputan
        $itemId = $this->request->getPost('item_id');
        $jenis  = $this->request->getPost('jenis');
        $jumlah = $this->request->getPost('jumlah');
        
        // Validasi Stok (Khusus Barang Keluar)
        if ($jenis == 'OUT') {
            $barang = $modelItem->find($itemId);
            if ($barang['stok'] < $jumlah) {
                return redirect()->back()->with('error', "Stok tidak cukup! Sisa: " . $barang['stok']);
            }
        }

        // Simpan Transaksi (Stok otomatis update via Model Events yang sudah kita buat)
        $modelTrans->save([
            'item_id'    => $itemId,
            'jenis'      => $jenis,
            'jumlah'     => $jumlah,
            'tanggal'    => $this->request->getPost('tanggal'),
            'dokumen'    => $this->request->getPost('dokumen'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/')->with('success', 'Transaksi berhasil disimpan!');
    }
}