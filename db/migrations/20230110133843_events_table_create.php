<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class EventsTableCreate extends AbstractMigration
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
        $this->table('evenements')
            ->addColumn('motif', 'string', ['limit' => 200])
            ->addColumn('contenu', 'string')
            ->addColumn('date_debut_evenement', 'timestamp')
            ->addColumn('date_fin_evenement', 'timestamp')
            ->addColumn('lieu', 'string')
            ->addColumn('id_ecole', 'integer')
            ->addForeignKey('id_ecole', 'ecoles', 'id',
            ['delete' => 'NO_ACTION', 'update' => 'CASCADE'])
            ->addIndex('motif', ['unique' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }

    /**
     * @return void
     */
    public function down(): void
    {
        $this->table('evenements')->drop()->save();
    }
}
