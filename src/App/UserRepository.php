<?php

namespace App;

class UserRepository
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function deleteById($id)
    {
        $stmt = $this->pdo->prepare('delete from users where id = ?');
        return $stmt->execute([$id]);
    }

    public function all()
    {
        return $this->pdo->query('SELECT * FROM users')->fetchAll();
    }

    public function userByLogin($login)
    {
        $insert = $this->pdo->prepare
        ("SELECT * FROM users WHERE `name` = :login");

        $result = $insert->execute(['login' => $login]);

        return $result;
    }

    public function userRoleByLogin($login)
    {
        return $this->pdo->query("SELECT role FROM users WHERE `name` = $login")->fetch();
    }

    public function addUser($name, $password, $role = null)
    {
        $insert = $this->pdo->prepare
        ("INSERT INTO `Users` SET `name` = :name, `password` = :password, `role` = :role");

        $result = $insert->execute(['name' => $name, 'password' => sha1($password), 'role' => $role]);

        return $result;
    }
}


