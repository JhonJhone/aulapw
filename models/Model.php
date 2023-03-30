<?php

class Model
{
//Não é a forma mais indicada de armazenar usuário e senha
private $driver = 'mysql';
private $host = 'localhost';
private $dbname = 'sistematwig';
private $porta = 3306;
private $user = 'root';
private $password = null;
protected $table;
protected $conex;
public function __construct(){
    //Descobre o nome da tabela
    $tbl = strtolower(get_class($this));
    $tbl .= 's';
    $this->table = $tbl;

    //Conecta no BD
    $this->conex = new PDO("{$this->driver}:host={$this->host};port={$this->porta}; dbname={$this->dbname}",$this->user ,$this->password);
}
public function getAll(){

}
}