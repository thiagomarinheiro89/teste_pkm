<?php
date_default_timezone_set('America/Sao_Paulo');

function conecta_banco(){
  if(file_exists('../database.php')){
      require('../database.php');
  } else {
      require('database.php');
  }

  try {
    $conn = new PDO('mysql:host='.$host.';dbname='.$banco, $user, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8mb4");
    return $conn;
  } catch(PDOException $e) {
      die('ERROR: Não foi possível conectar ao banco de dados - ' . $e->getMessage());
  }
}

function get_dados($query, $dados = array()){
  $conn = conecta_banco();

  if(!is_array($dados)){
    $dados = array($dados);
  }

  $db = $conn->prepare($query);
  $db->execute($dados);

  $data = $db->fetchAll(PDO::FETCH_ASSOC);

  return $data;

}

function roda_query($query, $dados){
  $conn = conecta_banco();

  if(!is_array($dados)){
    $dados = array($dados);
  }

  try {
    $db = $conn->prepare($query);
    $execucao = $db->execute($dados);
    $id = $conn->lastInsertId();

    return array('status' => $execucao, 'id'=>$id);
  } catch (PDOException $e) {
    return array('status' => false, 'id'=>0, $e->getMessage());
  }
  
}
?>
