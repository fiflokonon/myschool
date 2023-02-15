<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePunishTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up(): void
    {
        $this->table('punitions')
            ->addColumn('id_matiere', 'integer')
            ->addColumn('motif', 'string')
            ->addColumn('punition', 'string')
            ->addColumn('date', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addForeignKey('id_matiere', 'matieres', 'id',
            ['delete' => 'NO_ACTION', 'update' => 'CASCADE'])
            ->create();
    }

    public function down()
    {

    }
}
