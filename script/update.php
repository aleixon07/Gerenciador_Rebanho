<?php

session_start();
include "connection.php";

if (isset($_SESSION['idProdutor'])) {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $cpf = $_POST["cpf"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];
    $rg = $_POST["rg"];
    $localidade = $_POST["localidade"];
    $propriedade_rural = $_POST["propriedade_rural"];
    $municipio = $_POST["municipio"];
    $cep = $_POST["cep"];
    $id_edit = $_POST["id_edit"];


    $sql_verif_email = "SELECT * FROM usuario WHERE idProdutor != '$id_edit' AND email = '$email'";
    $result_verif_email = mysqli_query($conn, $sql_verif_email);

    if (mysqli_num_rows($result_verif_email) > 0) {

        header("location: ../dashboard/sidebar_usuario.php?e=a87ff679a2f3e71d9181a67b7542122c");
        exit();
    }

    $sql_verif_cpf = "SELECT * FROM usuario WHERE idProdutor != '$id_edit' AND cpf = '$cpf'";
    $result_verif_cpf = mysqli_query($conn, $sql_verif_cpf);

    if (mysqli_num_rows($result_verif_cpf) > 0) {

        header("location: ../dashboard/sidebar_usuario.php?e=a87ff679a2f3e71d9181a67b7542122c");
        exit();
    }

    $sql_verif_rg = "SELECT * FROM usuario WHERE idProdutor != '$id_edit' AND rg = '$rg'";
    $result_verif_rg = mysqli_query($conn, $sql_verif_rg);

    if (mysqli_num_rows($result_verif_rg) > 0) {

        header("location: ../dashboard/sidebar_usuario.php?e=a87ff679a2f3e71d9181a67b7542122c");
        exit();
    }

    $sql = "UPDATE usuario SET Nome = '$nome', Email = '$email', Cpf ='$cpf', Telefone = '$telefone', Endereco = '$endereco', Rg = '$rg', Localidade = '$localidade', Prop_rural = '$propriedade_rural', Municipio = '$municipio', Cep = '$cep' WHERE idProdutor = '$id_edit' ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: ../dashboard/sidebar_usuario.php?e=c81e728d9d4c2f636f067f89cc14862c"); //se tudo der certo volta para página inicial
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
