<?php

session_start();
include "connection.php";

if (isset($_SESSION['idProdutor'])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["categoria"])) {

            $categoria = $_POST["categoria"];
            $idprodutor = $_SESSION['idProdutor'];

                $sql = "INSERT INTO categoria (Nome, idProdutor) VALUES ('$categoria','$idprodutor')";

                if ($conn->query($sql)) {

                    if(isset($_POST['a'])){
                        header("Location: ../dashboard/sidebar_animal.php?e=d3d9446802a44259755d38e6d163e820");
                        exit();
                    }else{
                        header("Location: ../dashboard/sidebar_categoria.php?e=c4ca4238a0b923820dcc509a6f75849b");
                        exit();
                    }
                    
                }
        } else {
            header("Location: ../dashboard/sidebar_categoria.php");
            exit();
        }
    } else {
        header("Location: ../dashboard/sidebar_categoria.php");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
