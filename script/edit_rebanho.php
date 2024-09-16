<?php

session_start();
include "connection.php";

if(isset($_SESSION['idProdutor'])){

    $nome = $_POST["nome"];
    $id_edit = $_POST["id_edit"];

$sql= "UPDATE rebanho SET Nome = '$nome' WHERE idRebanho = '$id_edit' ";
$result = mysqli_query($conn, $sql); 

if($result){
    header("Location: ../dashboard/sidebar_rebanho.php?e=eccbc87e4b5ce2fe28308fd9f2a7baf3"); //se tudo der certo volta para página inicial
    exit();
}

}else{ 
    header("Location: ../index.php");
    exit();
}

?>