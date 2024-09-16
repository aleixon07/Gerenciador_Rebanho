<?php

session_start();
include "connection.php";

if (isset($_SESSION['idProdutor'])) {

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["brinco"]) && isset($_POST["especie"]) && isset($_POST["categoria"]) && isset($_POST["rebanho"]) && isset($_POST["pelagem"]) && isset($_POST["date"]) && isset($_POST["sexo"]) && isset($_POST["idprodutor"]) ) {

            $brinco = $_POST["brinco"];
            $especie = $_POST["especie"];
            $categoria = $_POST["categoria"];
            $rebanho = $_POST["rebanho"];
            $pelagem = $_POST["pelagem"];
            $data = $_POST["date"];
            $sexo = $_POST["sexo"];
            $idprodutor = $_SESSION['idProdutor'];

            $sql_rebanho = "SELECT * FROM rebanho WHERE Nome = '$rebanho' AND idProdutor = '$idprodutor'";
            $result_rebanho = $conn->query($sql_rebanho);

            if ($result_rebanho->num_rows > 0) {

                // Recorrer los resultados y mostrar los datos
                while ($row_rebanho = $result_rebanho->fetch_assoc()) {

                    $id_rebanho = $row_rebanho["idRebanho"];
                }
            } else {
                header("Location: ../dashboard/sidebar.php");
                exit();
            }

            $sql_brinco = "SELECT * FROM animal WHERE Brinco = '$brinco'";
            $result_brinco = $conn->query($sql_brinco);

            if ($result_brinco->num_rows > 0) {

                header("Location: ../dashboard/sidebar_animal.php?e=8f14e45fceea167a5a36dedd4bea2543");
                exit();
            } 

            $sql_categoria = "SELECT * FROM categoria WHERE Nome = '$categoria' AND idProdutor = '$idprodutor'";
            $result_categoria = $conn->query($sql_categoria);

            if ($result_categoria->num_rows > 0) {

                // Recorrer los resultados y mostrar los datos
                while ($row_categoria = $result_categoria->fetch_assoc()) {

                    $id_categoria = $row_categoria["idCategoria"];
                }
            } else {
                header("Location: ../dashboard/sidebar.php");
                exit();
            }

            if ($sexo == "femea") {
                $sql = "INSERT INTO animal (Brinco, Especie, Sexo, Pelagem, Data_de_nascimento, IdCategoria, idRebanho, idProdutor) 
                VALUES ('$brinco','$especie','F','$pelagem','$data','$id_categoria','$id_rebanho','$idprodutor')";
            } else {
                $sql = "INSERT INTO animal (Brinco, Especie, Sexo, Pelagem, Data_de_nascimento, IdCategoria, idRebanho, idProdutor) 
                VALUES ('$brinco','$especie','M','$pelagem','$data','$id_categoria','$id_rebanho','$idprodutor')";
            }

            if ($conn->query($sql)) {

                header("Location: ../dashboard/sidebar_animal.php?e=c4ca4238a0b923820dcc509a6f75849b");
                exit();
            }
        } else {
            header("Location: ../dashboard/sidebar_animal.php");
            exit();
        }
    } else {
        header("Location: ../dashboard/sidebar_animal.php");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
