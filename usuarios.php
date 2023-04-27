<?php

require('verifica_login.php');
require('twig_carregar.php');
// require('pdo.inc.php');
require('models/Model.php');
require('models/Usuario.php');

$usr = new Usuario();
$usuarios = $usr->getAll(['ativo' => 1]);

// $sql = $pdo->query('SELECT id,nome, email, username FROM usuarios WHERE ativo = 1');
// $usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);


echo $twig->render('usuarios.html', ['usuarios' => $usuarios,]);