<?php

$user = $_POST['user'];
$pass = $_POST['pass'];

if ($user == 'jhon' && $pass == '123') {
    #Login sucesso

    #armazenar user
    session_start();
    $_SESSION['user'] = 'jhon';

    #redirecionar usuario
    header('location:welcome.php');
    die;
}else {
    #Falha login
    header('location:login.php?erro=1');
    die;
}