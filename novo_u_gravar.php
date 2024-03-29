<?php
require('models/Model.php');
require('models/Usuario.php');

$nome = $_POST['name'] ?? false;
$email = $_POST['email'] ?? false;
$user = $_POST['user'] ?? false;
$pass = $_POST['pass'] ?? false;
$adm = $_POST['adm'] ?? false;
$atv = $_POST['atv'] ?? false;

if(!$user || !$pass || !$nome || !$email){
    header('location:novo_u.php');
    die;
}

$pass = password_hash($pass, PASSWORD_BCRYPT);

$usr = new Usuario();
$usr->create([
    'username' => $user,
    'senha' => $pass,
    'email' => $email,
    'admin' => $adm,
    'ativo' => 1,
]);


header('location:usuarios.php');