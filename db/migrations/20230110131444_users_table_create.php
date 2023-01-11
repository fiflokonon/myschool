<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UsersTableCreate extends AbstractMigration
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
        $this->table('utilisateurs')
            ->addColumn('prenoms', 'string', ['limit' => 100])
            ->addColumn('nom', 'string', ['limit' => 50])
            ->addColumn('email', 'string')
            ->addColumn('tel', 'string', ['limit' => 12])
            ->addColumn('id_slug', 'string')
            ->addColumn('role', 'string', ['limit' => 30])
            ->addColumn('id_ecole', 'integer')
            ->addColumn('mot_de_passe', 'string')
            ->addForeignKey('id_ecole', 'ecoles', 'id',
            ['delete' => 'NO_ACTION', 'update' => 'CASCADE'])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addIndex('email', ['unique' => true])
            ->addIndex('tel', ['unique' => true])
            ->create();
    }

    /**
     * @return void
     */
    public function down(): void
    {
        $this->table('utilisateurs')->drop()->save();
    }
}
