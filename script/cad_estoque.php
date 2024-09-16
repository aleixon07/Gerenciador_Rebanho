<?php

session_start();
include "connection.php";


$id = $_SESSION["idProdutor"];
$idAnimal = $_POST["idAnimal"];
$idInventario = $_POST["idInventario"];
$Status = $_POST['Status'];
$bo = $_POST["bo"];
$peso = $_POST['peso'];


$sql = "INSERT INTO estoque (idAnimal, idInventario, Status, BO, Peso, idProdutor) VALUES ('$idAnimal', '$idInventario','$Status','$bo','$peso','$id')";

if ($conn->query($sql)) {

    if (isset($_POST['a'])) {
        header("Location: ../dashboard/sidebar_estoque.php?e=d3d9446802a44259755d38e6d163e820");
        exit();
    } else {
        header("Location: ../dashboard/sidebar_estoque.php?e=c4ca4238a0b923820dcc509a6f75849b");
        exit();
    }

}