<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class PaiementsTableCreate extends AbstractMigration
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
        $this->table('paiements')
            ->addColumn('montant_paiement', 'integer')
            ->addColumn('date_paiement', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('id_motif', 'integer')
            ->addColumn('id_eleve', 'integer')
            ->addColumn('id_utilisateur', 'integer')
            ->addForeignKey('id_motif', 'motifs', 'id',
            ['delete' => 'NO_ACTION', 'update' => 'CASCADE'])
            ->addForeignKey('id_eleve', 'eleves', 'id',
                ['delete' => 'NO_ACTION', 'update' => 'CASCADE'])
            ->addForeignKey('id_utilisateur', 'utilisateurs', 'id',
                ['delete' => 'NO_ACTION', 'update' => 'CASCADE'])
            ->create();
    }

    /**
     * @return void
     */
    public function down(): void
    {
        $this->table('paiements')->drop()->drop();
    }
}
