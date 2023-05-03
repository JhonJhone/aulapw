<?php
require('twig_carregar.php');
require('pdo.inc.php');

$nome = $_POST['nome'] ?? false;
$preco = $_POST['preco'] ?? false;

if(!$nome || !$preco){
    header('location:p_novo.html');
}

    $sql = $pdo->prepare('INSERT INTO produtos(nome, preco) VALUES (:nome, :preco)');
    $sql->bindParam(':nome', $nome);
    $sql->bindParam(':preco', $preco);
    $sql->execute();

    header('location:produtos.php');


$sql = $pdo->query('SELECT * FROM produtos');
$produtos = $sql->fetchAll(PDO::FETCH_ASSOC);

echo $twig->render('p_novo.html', [
    'produtos' => $produtos,
]);