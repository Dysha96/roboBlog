<?php

namespace App;

use function App\Template\render;
use Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';
require_once '../src/App/UserRepository.php';
require_once '../src/App/Application.php';
require_once '../src/App/Template/Template.php';
require_once '../src/App/ArticlesRepository.php';
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
$dotenv->required(array('DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD'));

$opt = array(
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
);

$config = ['host' => getenv('DB_HOST'),
    'db_name' => getenv('DB_DATABASE'),
    'username' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'charset' => 'utf8'];
$dsn = "mysql:host={$config['host']};dbname={$config['db_name']};charset={$config['charset']}";
$pdo = new \PDO($dsn, $config['username'], $config['password'], $opt);

$repositoryArticles = new ArticlesRepository($pdo);
$repositoryUsers = new UserRepository($pdo);

$newArticle = [
    'user_id' => '',
    'title' => '',
    'content' => '',
    'image' => ''
];

$app = new Application();

$app->get('/', function () use ($repositoryArticles) {
    session_start();
    $articles = $repositoryArticles->all();
    $articlesTop = $repositoryArticles->articleTop();
    return render('index', ['articles' => $articles, 'articlesTop' => $articlesTop]);
});

$app->get('/articles/:id', function ($params, $arguments) use ($repositoryArticles) {
    session_start();
    $repositoryArticles->addViewById($arguments['id']);
    $article = $repositoryArticles->articleById($arguments['id']);
    return render('articles', ['article' => $article]);
});

$app->post('/articles/:id', function ($params, $arguments) use ($repositoryArticles) {
    session_start();
    $repositoryArticles->addViewById($arguments['id']);
    $article = $repositoryArticles->articleById($arguments['id']);
    return render('articles', ['article' => $article]);
});

$app->post('/articles/edit/:id', function ($params, $arguments) use ($repositoryArticles) {
    session_start();
    $errors = [];
    if (!$params['title']) {
        $errors['title'] = 'title can\'t be blank';
    } elseif (!$params['content'] || trim($params['content']) == '') {
        $errors['content'] = 'content can\'t be blank';
    }

    if (empty($errors)) {
        $uploaddir = 'resources/';
        $uploadfile = $uploaddir . basename($_FILES['image']['name']);
        $repositoryArticles->
        updateArticle($arguments['id'], strip_tags($params['title']), htmlspecialchars($params['content']), $_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
        return header('Location: /');
    } else {
        return render('articles', ['errors' => $errors, 'article' => array_merge($arguments, $params)]);
    }
});

$app->get('/new', function ($params, $arguments) use ($newArticle) {
    session_start();
    if (empty($_SESSION['user'])) {
        return header('Location: /');
    }
    return render('new', ['errors' => [], 'article' => $newArticle]);
});

$app->post('/new', function ($params, $arguments) use ($repositoryArticles) {
    session_start();
    $errors = [];
    if (!$params['title']) {
        $errors['title'] = 'title can\'t be blank';
    } elseif (!$params['content'] || trim($params['content']) == '') {
        $errors['content'] = 'content can\'t be blank';
    }

    if (empty($errors)) {
        $uploaddir = 'resources/';
        $uploadfile = $uploaddir . basename($_FILES['image']['name']);
        $repositoryArticles->
        addArticle(strip_tags($params['title']), htmlspecialchars($params['content']), $_SESSION['user']['id'], $_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
        return header('Location: /');
    } else {
        return render('new', ['errors' => $errors, 'article' => $params]);
    }
});

$app->get('/session/new', function ($params, $arguments) {
    session_start();
    return render('registration', ['errors' => [], 'login' => []]);
});

$app->post('/session', function ($params, $arguments) use ($repositoryUsers) {
    session_start();
    $errors = [];
    $user = $repositoryUsers->userByLogin($params['name']);
    if (!$user || $user['password'] != sha1($params['password'])) {
        $errors = 'Invalid login or password';
    }

    if (empty($errors)) {
        $_SESSION['user'] = $user;
        return header('Location: /');
    } else {
        return render('registration', ['errors' => $errors, 'article' => $params]);
    }
});

$app->get('/session/destroy', function ($params, $arguments) {
    session_start();
    session_destroy();
    return header('Location: /');
});


$app->run();