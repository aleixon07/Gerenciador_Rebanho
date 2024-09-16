<?php

session_start();
include "connection.php";

     $id_edit = $_POST['id_edit'];
     $idanimal = $_POST["idanimal"];
     $idinventario = $_POST["idinventario"];
     $status = $_POST['status'];
     if (!isset($_POST['BO']) && empty($_POST['BO'])) {
        $bo = NULL;

     }else{
        $bo = $_POST["BO"];

     }
     $peso = $_POST['peso'];

    echo $sql = "UPDATE estoque SET idAnimal = '$idanimal', idInventario = '$idinventario' , Status = '$status' , BO = '$bo' , Peso = '$peso' WHERE IdEstoque = '$id_edit' ";
    $result = mysqli_query($conn, $sql); 

    if ($result) {
        header("Location: ../dashboard/sidebar_estoque.php?e=eccbc87e4b5ce2fe28308fd9f2a7baf3"); //se tudo der certo volta para página inicial
        exit();
    }



?>