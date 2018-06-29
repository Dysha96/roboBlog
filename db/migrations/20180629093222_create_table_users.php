<?php


use Phinx\Migration\AbstractMigration;

class CreateTableUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other distructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $articles = $this->table('Users');

        $articles->addColumn('name', 'string', array('limit' => 150))
            ->addColumn('password', 'text')
            ->addColumn('role', 'text', array('null' => true))
            ->addColumn('remember_token', 'string', array('null' => true))
            ->addColumn('date', 'timestamp', array('default' => 'CURRENT_TIMESTAMP'))
            ->addIndex(array('name'), array('unique' => true))->create();
    }
}
