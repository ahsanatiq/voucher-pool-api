<?php

namespace database;

use Phinx\Util\Literal;
use Phinx\Migration\AbstractMigration;

class CreateOffers extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('offers');
        $table
            ->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('discount', 'float', ['null' => false, 'default' => '0.00'])
            ->addColumn('expire_at', 'date', ['null' => false])
            ->addColumn('created_at', 'datetime', ['null' => false, 'default' => Literal::from('now()')])
            ->addColumn('updated_at', 'datetime', ['null' => false, 'default' => Literal::from('now()')])
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->create();
    }
}
