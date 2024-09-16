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
            $idprodutor = $_POST["idprodutor"];
            $id_edit = $_POST["id_edit"];


            $sql_rebanho = "SELECT * FROM rebanho WHERE Nome = '$rebanho'";
            $result_rebanho = $conn->query($sql_rebanho);

            if ($result_rebanho->num_rows > 0) {

                // Recorrer los resultados y mostrar los datos
                while ($row_rebanho = $result_rebanho->fetch_assoc()) {

                    $id_rebanho = $row_rebanho["idRebanho"];
                }
            } else {
                header("Location: ../dashboard/sidebar.php");
            }

            $sql_categoria = "SELECT * FROM categoria WHERE Nome = '$categoria'";
            $result_categoria = $conn->query($sql_categoria);

            if ($result_categoria->num_rows > 0) {

                // Recorrer los resultados y mostrar los datos
                while ($row_categoria = $result_categoria->fetch_assoc()) {

                    $id_categoria = $row_categoria["idCategoria"];
                }
            } else {
                header("Location: ../dashboard/sidebar.php");
            }

            if ($sexo == "femea") {
                $sql = "UPDATE animal SET Brinco = '$brinco', Especie ='$especie', IdCategoria = '$id_categoria', idRebanho = '$id_rebanho', Pelagem = '$pelagem', Data_de_nascimento = '$data', Sexo = 'F', idProdutor = '$idprodutor' WHERE IdAnimal = '$id_edit' ";
            } else {
                $sql = "UPDATE animal SET Brinco = '$brinco', Especie ='$especie', IdCategoria = '$id_categoria', idRebanho = '$id_rebanho', Pelagem = '$pelagem', Data_de_nascimento = '$data', Sexo = 'M', idProdutor = '$idprodutor' WHERE IdAnimal = '$id_edit' ";
            }

            if ($conn->query($sql)) {

                header("Location: ../dashboard/sidebar_animal.php?e=eccbc87e4b5ce2fe28308fd9f2a7baf3");
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
