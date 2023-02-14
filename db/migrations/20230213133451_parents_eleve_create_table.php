<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ParentsEleveCreateTable extends AbstractMigration
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
        $this->table('parents_eleves')
            ->addColumn('id_eleve', 'integer')
            ->addColumn('id_parent', 'integer')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addForeignKey('id_eleve', 'eleves', 'id',
            ['delete' => 'NO_ACTION', 'update' => 'CASCADE'])
            ->addForeignKey('id_parent', 'utilisateurs', 'id',
            ['delete' => 'NO_ACTION', 'update' => 'CASCADE'])
            ->create();
    }

    /**
     * @return void
     */
    public function down():void
    {
        $this->table('parents_eleves')->drop()->save();
    }
}
