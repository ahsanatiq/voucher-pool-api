<?php

namespace database;

use Phinx\Util\Literal;
use Phinx\Migration\AbstractMigration;

class CreateVouchers extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('used_vouchers');
        $table
            ->addColumn('recipient_id', 'integer')
            ->addColumn('offer_id', 'integer')
            ->addColumn('used_code', 'char', ['limit' => 8])
            ->addColumn('created_at', 'datetime', ['null' => false, 'default' => Literal::from('now()')])
            ->addColumn('updated_at', 'datetime', ['null' => false, 'default' => Literal::from('now()')])
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->addForeignKey('offer_id', 'offers', 'id')
            ->addForeignKey('recipient_id', 'recipients', 'id')
            ->addIndex(['used_code'], ['name'=>'idx_used_code'])
            ->create();
    }
}
