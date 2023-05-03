<?php
#produtos.php
require ('pdo.inc.php');
require ('vendor/autoload.php');

$loader = new \Twig\Loader\FilesystemLoader('./templates');

$twig = new \Twig\Environment($loader);

$template = $twig->load('produtos.html');

$produtos = [
    [
        'nome' => 'Chinelo',
        'preco' => 30,
    ],
    [
        'nome' => 'Camiseta',
        'preco' => 50,
    ],
    [
        'nome' => 'Boné',
        'preco' => 39.99,
    ],
    [
        'nome' => 'Automotivel Cadillac',
        'preco' => 460,
    ],
];

echo $template->render([
    'title' => 'products',
    'produtos' => $produtos,
]);