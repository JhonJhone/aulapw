<?php

require('twig_carregar.php');
require('pdo.inc.php');

//Mensagem de erro
$msg = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'] ?? false;

    $sql = $pdo->prepare('SELECT * FROM usuarios WHERE username = ?');
    $sql->execute([$username]);

    //Se encontrou usuário...
    if($sql->rowCount()){
        //Aqui fica rotina de recuperar a senha
        //Pega o id do usuário
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);
        //Gera um token
        $token = uniqid(null, true) . bin2hex(random_bytes(16));
        
        //Grava o token para o usuário no banco
        $sql = $pdo->prepare('UPDATE usuarios SET recupera_token = :token WHERE id = :id_usr');

        $sql->execute([
            ':token' => $token,
            ':id_usr' => $usuario['id'],
        ]);
        $msg ="vai olhar teu email negão";

        echo $twig->render('email_recupera_senha.html', ['token' => $token]);
        die;
    }else{
        $msg = 'Usuário não encontrado.';
    }
}

echo $twig->render('recuperar_senha.html', ['msg' => $msg,]);