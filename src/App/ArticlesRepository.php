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
        return $this->pdo->query('SELECT * FROM articles')->fetchAll();
    }

    public function articleById($id)
    {
        return $this->pdo->query("SELECT * FROM articles WHERE id = $id")->fetch();
    }

    public function articleTop()
    {
        return $this->pdo->query
        ("SELECT id, title FROM articles WHERE date >= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY)  ORDER BY views DESC  limit 10")
            ->fetchAll();
    }

    public function addArticle($title, $content, $image = null, $userId = 1)
    {
        if ($image != null) {
            $insert = $this->pdo->prepare
            ("INSERT INTO `articles` SET `image` = :image, `user_id` = :userId, `title` = :title,`content` = :content");
            $result = $insert->execute(['image' => $image, 'userId' => $userId, 'title' => $title, 'content' => $content]);
        } else {
            $insert = $this->pdo->prepare
            ("INSERT INTO `articles` SET  `user_id` = :userId, `title` = :title,`content` = :content");
            $result = $insert->execute(['userId' => $userId, 'title' => $title, 'content' => $content]);
        }
        return $result;
    }

    public function updateArticle($id, $userId, $title, $content, $image = null)
    {
        if ($image != null) {
            $insert = $this->pdo->prepare
            ("UPDATE  `articles` SET `image` = :image, `user_id` = :userId, `title` = :title,`content` = :content 
WHERE `id` = :id");
            $result = $insert->execute(['image' => $image, 'userId' => $userId, 'title' => $title,
                'content' => $content, 'id' => $id]);
        } else {
            $insert = $this->pdo->prepare
            ("UPDATE  `articles` SET  `user_id` = :userId, `title` = :title,`content` = :content WHERE `id` = :id");
            $result = $insert->execute(['userId' => $userId, 'title' => $title, 'content' => $content, 'id' => $id]);
        }
        return $result;
    }
}


