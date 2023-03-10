<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
</body>
</html>

<?php

require('verifica_login.php');
require('twig_carregar.php');

echo $twig->render('welcome.html', [
    'user' => $_SESSION['user'],
]);

