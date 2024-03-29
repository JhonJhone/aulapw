<?php
//query() -> executa a consulta direto
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
public function getAll($where = false, $where_glue = 'AND'){
    if($where){
        $where_sql = $this->where_fields($where, $where_glue);

        $sql = $this->conex->prepare("SELECT * FROM {$this->table} WHERE {$where_sql}");
        $sql->execute($where);
    }else{
        $sql = $this->conex->query("SELECT * FROM {$this->table}");
    }

    return $sql->fetchAll(PDO::FETCH_ASSOC);

}
private $id;
public function getById($id){
    $this->id = $id;

    $sql = $this->conex->prepare("SELECT * FROM {$this->table} WHERE id = :id");
    $sql->bindParam(":id", $this->id);
    $sql->execute();

    return $sql->fetch(PDO::FETCH_ASSOC);
}

public function create($data){
    //Inicia a construção dp SQL
    $sql = "INSERT INTO {$this->table}";

    $sql_fields = $this->_sql_fields($data);
    //Monta a consulta
    $sql .= " SET {$sql_fields}";

    //Prepara e roda o banco
    $insert = $this->conex->prepare($sql);

    //Faz os binds nos valores
    // foreach($data as $field => $value){
    //     $insert->bindValue(":{$field}", $value);
    // }
    //Roda a consulta
    $insert->execute($data);

    return $insert->errorInfo();
    }

public function update($data, $id){
//Remove índice 'id' do $data
    unset($data['id']);

    $sql = "UPDATE  {$this->table}";
    $sql.= ' SET ' . $this->_sql_fields($data);
    $sql.= ' WHERE id = :id';

    $data['id'] = $id;

    $upd = $this->conex->prepare($sql);
    $upd->execute($data);

}

private function map_fields($data){
    //Prepara os campos e placeholders
    foreach(array_keys($data) as $field){
        $sql_fields[] = "{$field} = :{$field}";
    }
    return $sql_fields;
}

private function _sql_fields($data){
    
    $sql_fields = $this->map_fields($data);
    
    return implode(', ', $sql_fields);
}

private function where_fields($data, $glue = 'AND'){
    $glue = $glue == 'OR' ? ' OR ' : ' AND ';
    $fields = $this->map_fields($data);
    return implode($glue, $fields);
}
}
