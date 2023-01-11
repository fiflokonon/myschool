<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class SchoolsTableCreate extends AbstractMigration
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
        $this->table('ecoles')
            ->addColumn('nom', 'string', ['limit' => 100])
            ->addColumn('email', 'string', ['limit' => 50])
            ->addColumn('contact', 'string', ['limit' => 12])
            ->addColumn('adresse', 'string', ['limit' => 50])
            ->addIndex('nom', ['unique' => true])
            ->addIndex('email', ['unique' => true])
            ->addIndex('adresse', ['unique' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }

    /**
     * @return void
     */
    public function down(): void
    {
        $this->table('ecoles')->drop()->save();
    }
}
