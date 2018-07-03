<?php

namespace App;

class ArticlesRepository
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        return $this->pdo->query('SELECT * FROM Articles')->fetchAll();
    }

    public function articleById($id)
    {
        return $this->pdo->query("SELECT * FROM Articles WHERE id = $id")->fetch();
    }

    public function articleTop()
    {
        return $this->pdo->query
        ("SELECT id, title FROM Articles WHERE date >= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY)  ORDER BY views DESC  limit 10")
            ->fetchAll();
    }

    public function addViewById($id)
    {
        $insert = $this->pdo->prepare("UPDATE  `Articles` SET `views` = `views` + 1 WHERE `id` = :id");
        $result = $insert->execute(['id' => $id]);
        return $result;
    }

    public function addArticle($title, $content, $userId = 1, $image = NULL)
    {
        $insert = $this->pdo->prepare
        ("INSERT INTO `Articles` SET `image` = :image, `user_id` = :userId, `title` = :title,`content` = :content");
        $result = $insert->execute(['image' => $image, 'userId' => $userId, 'title' => $title, 'content' => $content]);
        return $result;
    }

    public function updateArticle($id, $title, $content, $image = NULL)
    {
        if ($image != null) {
            $insert = $this->pdo->prepare
            ("UPDATE  `Articles` SET `image` = :image, `title` = :title,`content` = :content WHERE `id` = :id");
            $result = $insert->execute(['image' => $image, 'title' => $title, 'content' => $content, 'id' => $id]);
        } else {
            $insert = $this->pdo->prepare
            ("UPDATE  `Articles` SET  `title` = :title,`content` = :content WHERE `id` = :id");
            $result = $insert->execute(['title' => $title, 'content' => $content, 'id' => $id]);
        }
        return $result;
    }
}


