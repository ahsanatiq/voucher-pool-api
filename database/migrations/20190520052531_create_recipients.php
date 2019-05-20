<?php

namespace database;

use Phinx\Util\Literal;
use Phinx\Migration\AbstractMigration;

class CreateRecipients extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('recipients');
        $table
            ->addColumn('name', 'string', ['limit' => 250])
            ->addColumn('email', 'string', ['limit' => 250])
            ->addColumn('created_at', 'datetime', ['null' => false, 'default' => Literal::from('now()')])
            ->addColumn('updated_at', 'datetime', ['null' => false, 'default' => Literal::from('now()')])
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->create();
    }
}
