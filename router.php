<?php
$pagina = $_GET['pagina'] ?? false;

$include = filter_var("{$pagina}.php", FILTER_SANITIZE_STRING);
if(!file_exists($include)){
    echo "Caiu no golpe do Mario Games";
    echo "<br>";
    echo "<img src='https://pbs.twimg.com/media/ERP2tTfXYAkHvZX.png'>";
    die;
}

require("{$pagina}.php");