<?php
require_once "../funcoes/init.php";
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$data = isset($_POST['dataNascimento']) ? $_POST['dataNascimento'] : null;
$tel = isset($_POST['telefone']) ? $_POST['telefone'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
if(empty($nome) || empty($data) || empty($tel) || empty($email)){
    echo "Volte e preencha todos os campos";
    exit;
}
$PDO = db_connect();
$cod = "INSERT INTO contatos(nomeContato, dataNascimento, telefone, email) VALUE(:nome, :dataNascimento, :tel, :email)";
$exe = $PDO->prepare($cod);
$exe->bindParam(':nome', $nome);
$exe->bindParam(':dataNascimento', $data);
$exe->bindParam(':tel', $tel);
$exe->bindParam(':email', $email);
if($exe->execute()){
    header('Location:../html/msgSucesso.html');
}else{
    echo "Infelizmento, algo deu errado...";
    print_r($exe->errorInfo());
}
?>