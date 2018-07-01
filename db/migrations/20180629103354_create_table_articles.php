<?php


use Phinx\Migration\AbstractMigration;

class CreateTableArticles extends AbstractMigration
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
        {
            $articles = $this->table('Articles');

            $articles->addColumn('user_id', 'integer')
                ->addForeignKey('user_id', 'Users', 'id')
                ->addColumn('title', 'text')
                ->addColumn('content', 'text')
                ->addColumn('image', 'string', array('null' => true))
                ->addColumn('views', 'integer', array('null' => true))
                ->addColumn('date', 'timestamp', array('default' => 'CURRENT_TIMESTAMP'))
                ->create();
        }
    }
}
