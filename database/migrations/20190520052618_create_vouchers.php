<?php

namespace database;

use Phinx\Util\Literal;
use Phinx\Migration\AbstractMigration;

class CreateVouchers extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('vouchers');
        $table
            ->addColumn('recipient_id', 'integer')
            ->addColumn('offer_id', 'integer')
            ->addColumn('code', 'string', ['limit' => 100])
            ->addColumn('used_at', 'datetime', ['null' => true])
            ->addColumn('created_at', 'datetime', ['null' => false, 'default' => Literal::from('now()')])
            ->addColumn('updated_at', 'datetime', ['null' => false, 'default' => Literal::from('now()')])
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->addForeignKey('offer_id', 'offers', 'id')
            ->addForeignKey('recipient_id', 'recipients', 'id')
            ->create();
    }
}
