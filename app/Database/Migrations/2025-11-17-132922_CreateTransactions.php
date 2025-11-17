<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransactions extends Migration
{
    public function up()
{
    $this->forge->addField([
        'id'            => ['type' => 'INTEGER', 'constraint' => 11, 'auto_increment' => true],
        'item_id'       => ['type' => 'INTEGER', 'constraint' => 11],
        'jenis'         => ['type' => 'VARCHAR', 'constraint' => 10], // 'IN' atau 'OUT'
        'jumlah'        => ['type' => 'INTEGER', 'constraint' => 11],
        'tanggal'       => ['type' => 'DATE'],
        'dokumen'       => ['type' => 'VARCHAR', 'constraint' => 50], // No. Surat Jalan/Bon
        'keterangan'    => ['type' => 'TEXT', 'null' => true], // Supplier atau Tujuan
        'created_at'    => ['type' => 'DATETIME', 'null' => true],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->addForeignKey('item_id', 'items', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('transactions');
}

public function down()
{
    $this->forge->dropTable('transactions');
}
}
