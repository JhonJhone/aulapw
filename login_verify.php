<?php

require('pdo.inc.php');
$user = $_POST['user'];
$pass = $_POST['pass'];

//Cria a consulta e aguarda os dados
$sql = $pdo->prepare('SELECT * FROM usuarios WHERE username = :usr AND ativo = 1');

//Adiciona os dados na consulta
$sql->bindParam(':usr', $user);

//Roda a consulta no banco
$sql->execute();

//Se encontrou o usuario
if ($sql->rowCount()) {
    #Login sucesso

    $user = $sql->fetch(PDO::FETCH_OBJ);

    #Verifica se a senha está correta
    if(!password_verify($pass, $user->senha)){
         #Falha login
    header('location:login.php?erro=1');
    die;
    }

    #armazenar user
    session_start();
    $_SESSION['user'] = $user->nome;

    #redirecionar usuario
    header('location:welcome.php');
    die;
}else{
    header('location:login.php?erro=1');
    die;
}