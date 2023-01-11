<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ClassesTableCreate extends AbstractMigration
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
        $this->table('classes')
            ->addColumn('nom', 'string', ['limit' => 100])
            ->addColumn('scolarite', 'integer', ['limit' => 1000000])
            ->addColumn('id_ecole', 'integer')
            ->addForeignKey('id_ecole', 'ecoles', 'id',
            ['delete' => 'NO_ACTION', 'update' => 'CASCADE'])
            ->addIndex('nom', ['unique' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }

    /**
     * @return void
     */
    public function down(): void
    {
        $this->table('classes')->drop()->save();
    }
}
