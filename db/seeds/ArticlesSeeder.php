<?php


use Phinx\Seed\AbstractSeed;

class ArticlesSeeder extends AbstractSeed
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
                'user_id' => '1',
                'title' => 'ТОП 1',
                'content' => 'В качестве примера работы копирайтера с хорошей
                 структурой можно рассматривать данную статью. Прочитав предыдущий абзац, вы наверняка запомнили три
                  слова, отмеченные жирным шрифтом в списке. Это основные моменты, на которых автор и хотел 
                  акцентировать внимание в текущем блоке. Согласитесь, структурированный текст воспринимается лучше, 
                  чем, допустим: «В удачной статье всегда есть хорошая структура, вследствие чего она читается по 
                  диагонали. Чтобы сделать свой текст таковым, используйте подзаголовки перед каждым смысловым блоком,
                   маркированные или нумерованные списки, выделяйте жирным или курсивом моменты, которые кажутся вам 
                   важными, но не переусердствуйте с подобным форматированием».',
                'image' => null,
                'views' => 10
            ),
            array(
                'user_id' => '1',
                'title' => 'ТОП 2',
                'content' => 'В качестве примера работы копирайтера',
                'image' => null,
                'views' => 9
            ),
            array(
                'user_id' => '1',
                'title' => 'ТОП 3',
                'content' => 'В качестве примера работы копирайтера',
                'image' => null,
                'views' => 8
            ),
            array(
                'user_id' => '1',
                'title' => 'ТОП 4',
                'content' => 'В качестве примера работы копирайтера',
                'image' => null,
                'views' => 7
            ),
            array(
                'user_id' => '1',
                'title' => 'ТОП 5',
                'content' => 'В качестве примера работы копирайтера',
                'image' => null,
                'views' => 6
            ),
            array(
                'user_id' => '1',
                'title' => 'не ТОП',
                'content' => 'В качестве примера работы копирайтера',
                'image' => null,
                'views' => 5
            ),
        );

        $table = $this->table('Articles');
        $table->insert($data)->save();
    }
}
