<?php

session_start();
include "connection.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['cpf'])){

$nome = $_POST["nome"];//
$email = $_POST["email"];//
$senha = $_POST["senha"];//
$cpf = $_POST["cpf"];//
$telefone = $_POST["telefone"];//
$rg = $_POST["rg"];//
$localidade = $_POST["localidade"];//
$prop_rural = $_POST["prop_rural"];//
$municipio = $_POST["municipio"];//
$cep = $_POST["cep"];//
$endereco = $_POST["endereco"];//

$sql_verif_email = "SELECT * FROM usuario WHERE email = '$email'";
$result_verif_email = mysqli_query($conn, $sql_verif_email);

if(mysqli_num_rows($result_verif_email) > 0){

    header("location: ../dashboard/sidebar_usuario.php?e=a87ff679a2f3e71d9181a67b7542122c");
    exit();
}

$sql_verif_cpf = "SELECT * FROM usuario WHERE cpf = '$cpf'";
$result_verif_cpf = mysqli_query($conn, $sql_verif_cpf);

if(mysqli_num_rows($result_verif_cpf) > 0){

    header("location: ../dashboard/sidebar_usuario.php?e=a87ff679a2f3e71d9181a67b7542122c");
    exit();
}

$sql_verif_rg = "SELECT * FROM usuario WHERE rg = '$rg'";
$result_verif_rg = mysqli_query($conn, $sql_verif_rg);

if(mysqli_num_rows($result_verif_rg) > 0){

    header("location: ../dashboard/sidebar_usuario.php?e=a87ff679a2f3e71d9181a67b7542122c");
    exit();
}
  


$senha2 = md5($senha);
$sql = "INSERT INTO usuario (Nome, Senha, Endereco, Email, Cpf, Telefone, Rg, Localidade, Prop_rural, Municipio, Cep, Nivel) VALUES ('$nome', '$senha2', '$endereco', '$email', '$cpf', '$telefone', '$rg', '$localidade', '$prop_rural', '$municipio', '$cep', '1')";

if($conn->query($sql)){ 

    header("location: ../dashboard/sidebar_usuario.php?e=c4ca4238a0b923820dcc509a6f75849b");
    exit();

}else{
    echo "erro ao cadastar usuasrio = ". $conn->error;
 }

    }
}

?>