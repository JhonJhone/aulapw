<?php

require('pdo.inc.php');
$user = $_POST['user'];
$pass = $_POST['pass'];

//Cria a consulta e aguarda os dados
$sql = $pdo->prepare('SELECT * FROM usuarios WHERE username = :usr AND senha = :pass');

//Adiciona os dados na consulta
$sql->bindParam(':usr', $user);
$sql->bindParam(':pass', $pass);

//Roda a consulta no banco
$sql->execute();

//Se encontrou o usuario
if ($sql->rowCount()) {
    #Login sucesso

    $user = $sql->fetch(PDO::FETCH_OBJ);

    #armazenar user
    session_start();
    $_SESSION['user'] = $user->nome;

    #redirecionar usuario
    header('location:welcome.php');
    die;
}else {
    #Falha login
    header('location:login.php?erro=1');
    die;
}