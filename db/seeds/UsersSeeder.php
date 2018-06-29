<?php


use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = array(
            array(
                'name' => 'admin1', 'password' => sha1('password'), 'role' => 'admin'
            ),
            array(
                'name' => 'admin2', 'password' => sha1('password'), 'role' => 'admin'
            ),
            array(
                'name' => 'user1', 'password' => sha1('qwerty'), 'role' => 'user'
            ),
            array(
                'name' => 'user2', 'password' => sha1('qwerty')
            )
        );

        $table = $this->table('Users');
        $table->insert($data)->save();
    }
}
