<?php

require('pdo.inc.php');
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

$sql = $pdo->prepare('INSERT INTO usuarios(nome,email,username,senha,admin,ativo) VALUES (:nome,:email,:user,:pass,:adm,:atv)');

$sql->bindParam(':nome', $nome);
$sql->bindParam(':email', $email);
$sql->bindParam(':user', $user);
$sql->bindParam(':pass', $pass);
$sql->bindParam(':adm', $adm);
$sql->bindParam(':atv', $atv);

$sql->execute();
