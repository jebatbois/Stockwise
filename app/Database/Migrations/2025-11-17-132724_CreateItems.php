<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItems extends Migration
{
  public function up()
{
    $this->forge->addField([
        'id'          => ['type' => 'INTEGER', 'constraint' => 11, 'auto_increment' => true],
        'kode_item'   => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true], // Barcode
        'nama_item'   => ['type' => 'VARCHAR', 'constraint' => 100],
        'satuan'      => ['type' => 'VARCHAR', 'constraint' => 20], // Pcs, Box, dll
        'lokasi'      => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
        'stok'        => ['type' => 'INTEGER', 'default' => 0], // Stok saat ini
        'stok_min'    => ['type' => 'INTEGER', 'default' => 10], // Untuk trigger alert [cite: 129]
        'created_at'  => ['type' => 'DATETIME', 'null' => true],
        'updated_at'  => ['type' => 'DATETIME', 'null' => true],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('items');
}

public function down()
{
    $this->forge->dropTable('items');
}

}
