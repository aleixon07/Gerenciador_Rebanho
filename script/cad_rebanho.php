<?php

session_start();
include "connection.php";

if (isset($_SESSION['idProdutor'])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["rebanho"])) {

            $rebanho = $_POST["rebanho"];
            $idprodutor = $_SESSION['idProdutor'];

            $sql = "INSERT INTO rebanho (Nome, idProdutor) VALUES ('$rebanho','$idprodutor')";

            if ($conn->query($sql)) {

                if (isset($_POST['a'])) {
                    header("Location: ../dashboard/sidebar_animal.php?e=45c48cce2e2d7fbdea1afc51c7c6ad26");
                    exit();
                } else {
                    header("Location: ../dashboard/sidebar_rebanho.php?e=c4ca4238a0b923820dcc509a6f75849b");
                    exit();
                }
            }
        } else {
            header("Location: ../dashboard/sidebar_rebanho.php");
            exit();
        }
    } else {
        header("Location: ../dashboard/sidebar_rebanho.php");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
