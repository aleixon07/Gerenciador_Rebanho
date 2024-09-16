<?php

session_start();
include "connection.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

$email = $_POST["email"];   
$senha = $_POST["senha"];
$error="";

    
$senha2 = md5($senha);
$consulta = "SELECT * FROM usuario WHERE Email= '$email' AND Senha = '$senha2'";
$resultado = mysqli_query($conn, $consulta);

if(mysqli_num_rows($resultado) === 1 ){

    $row = $resultado->fetch_assoc();
    $id = $row["idProdutor"];
    $_SESSION["idProdutor"] = $id;

    header("location: ../dashboard/sidebar.php");
    exit();

}else{
    header("location: ../login/index.php?e=a87ff679a2f3e71d9181a67b7542122c");
    exit();
}
}

?>