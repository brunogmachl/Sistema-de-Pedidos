<?php

use App\db\Conexao;

@session_start();
require __DIR__.'/vendor/autoload.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$pdo = Conexao::getConnection();

$query = $pdo->prepare("SELECT * from funcionarios where email = :email and senha = :senha");
$query->bindValue(":email", "$email");
$query->bindValue(":senha", "$senha");
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);
// print_r($res[0]['id']);
// exit();

$total_reg = @count($res);

if($total_reg > 0){
    $_SESSION['id'] = $res[0]['id'];
    $_SESSION['name'] = $res[0]['funcionario'];
    echo "<script>window.location='/lenny/index.php?metodo=consultarDashboards'</script>";
}else{
    echo "<script>window.location='/lenny/login.php'</script>";
}