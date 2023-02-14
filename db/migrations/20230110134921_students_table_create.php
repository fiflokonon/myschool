<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class StudentsTableCreate extends AbstractMigration
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
        $this->table('eleves')
            ->addColumn('matricule', 'string')
            ->addColumn('prenoms', 'string', ['limit' => 100])
            ->addColumn('nom', 'string', ['limit' => 50])
            ->addColumn('id_classe', 'integer')
            ->addColumn('scolarite_paye', 'integer', ['default' => 0])
            ->addColumn('nom_prenoms_pere', 'string')
            ->addColumn('nom_prenoms_mere', 'string')
            ->addForeignKey('id_classe', 'classes', 'id',
            ['delete' => 'NO_ACTION', 'update' => 'CASCADE'])
            ->create();
    }

    /**
     * @return void
     */
    public function down(): void
    {
        $this->table('eleves')->drop()->save();
    }
}
