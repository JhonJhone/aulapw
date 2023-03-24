<?php
require('twig_carregar.php');
require('pdo.inc.php');

$token = $_GET['token'] ?? $_POST['token'] ?? false;

if(!$token){
    header('location:login.php');
    die;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $password = $_POST['senha'] ?? false;
    $password_conf = $_POST['senha_confirma'] ?? false;

    $password = trim($password);
    $password_conf = trim($password_conf);
    //tratamento para caso de senha falsa
    //...

    if($password == $password_conf){
    
    $sql = $pdo->prepare('UPDATE usuarios SET senha = :senha, recupera_token = NULL WHERE recupera_token = :token');
    $sql->execute([
        ':senha' => password_hash($password, PASSWORD_BCRYPT),
        ':token' => $token,
    ]);
    
    header('location:login.php?erro=3');

    die;
}
$msg = 'Não é possível. Como tu erra a porra da senha caralho?!';

}

$sql = $pdo->prepare('SELECT * FROM usuarios WHERE recupera_token = ?');
$sql->execute([$token]);

if($sql->rowCount() == 1) {
    echo $twig->render('recuperar_senha_escolher.html', ['token' => $token, 'msg' => $msg ?? false]);
}else {
    header('location:login.php');
    die;
}