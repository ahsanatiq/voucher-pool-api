<?php

namespace database;

use Phinx\Util\Literal;
use Phinx\Migration\AbstractMigration;

class CreateVoucherCodes extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('voucher_codes');
        $table
            ->addColumn('special_offer_id', 'integer')
            ->addColumn('recipient_id', 'integer')
            ->addColumn('code', 'string', ['limit' => 100])
            ->addColumn('used_at', 'datetime', ['null' => true])
            ->addColumn('created_at', 'datetime', ['null' => false, 'default' => Literal::from('now()')])
            ->addColumn('updated_at', 'datetime', ['null' => false, 'default' => Literal::from('now()')])
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->addForeignKey('special_offer_id', 'special_offers', 'id')
            ->addForeignKey('recipient_id', 'recipients', 'id')
            ->create();
    }
}
