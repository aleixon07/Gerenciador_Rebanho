<?php
session_start();

if (!isset($_SESSION["idProdutor"])) {
    header("Location: ../login/index.php");
}
if (!isset($_GET["id"])) {
    header("Location: sidebar_animal.php");
}
if (empty($_GET["id"])) {
    header("Location: sidebar_animal.php");
}
require_once "../script/connection.php";

$id = $_SESSION["idProdutor"];

$sql_usuario = "SELECT * FROM usuario WHERE idProdutor = '$id'";
$result_usuario = $conn->query($sql_usuario);

if ($result_usuario->num_rows > 0) {

    // Recorrer los resultados y mostrar los datos
    while ($row_usuario = $result_usuario->fetch_assoc()) {

        $name_user = $row_usuario["Nome"];
        $nivel = $row_usuario["Nivel"];
    }
} else {
    header("Location: ../login/index.php");
}

$edit_id = $_GET["id"];

$sql1 = "SELECT * FROM animal WHERE idAnimal ='$edit_id' AND idProdutor = '$id'";
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {

    $row1 = $result1->fetch_assoc();

    $brinco_animal = $row1["Brinco"];
    $especie_animal = $row1["Especie"];
    $sexo_animal = $row1["Sexo"];
    $data_nasc_animal = $row1["Data_de_nascimento"];
    $pelagem_animal = $row1["Pelagem"];
    $id_categoria_animal = $row1["idCategoria"];
    $id_rebanho_animal = $row1["idRebanho"];


    $sql2 = "SELECT * FROM categoria WHERE idCategoria ='$id_categoria_animal'";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {

        $row2 = $result2->fetch_assoc();

        $nome_categoria_animal =  $row2["Nome"];
    } else {
        header("Location: sidebar_animal.php");
    }

    $sql3 = "SELECT * FROM rebanho WHERE idRebanho ='$id_rebanho_animal'    ";
    $result3 = $conn->query($sql3);
    if ($result3->num_rows > 0) {

        $row3 = $result3->fetch_assoc();

        $nome_rebanho_animal =  $row3["Nome"];
    } else {
        header("Location: sidebar_animal.php");
    }
} else {
    header("Location: sidebar_animal.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Gerenciador do Rebanho</title>

    <link rel="stylesheet" href="sidebar.css">
    <script src="sidebar.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        h4 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            max-width: auto;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-row {
            margin-bottom: 15px;
        }

        .form-row label,
        .form-row input {
            flex: 1;
            margin-right: 10px;
        }

        .form-row input:last-child {
            margin-right: 0;
        }

        input[type="submit"] {
            background-color: #129667;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color: #0b704d;
        }
    </style>


</head>

<body>

    <body id="body-pd">
        <header class="header" id="header">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <div>
                <h4 class="text-light">Olá <?php echo $name_user;  ?></h4>
            </div>
            <div class="header_img"><img src="https://www.promoview.com.br/uploads/images/unnamed%2819%29.png" alt=""> </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div> <a href="" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Administrativa</span> </a>
                    <div class="nav_list">
                        <?php if ($nivel >= 2) { ?>
                            <a href="sidebar_usuario.php" class="nav_link">
                                <i class='bx bx-user nav_icon'></i> <span class="nav_name">Usuários</span>
                            </a>
                        <?php } ?>

                        <a href="sidebar_animal.php" class="nav_link active">
                            <i class='bx bx-message-square-detail nav_icon'></i>
                            <span class="nav_name">Animal</span>
                        </a>

                        <a href="sidebar_categoria.php" class="nav_link ">
                            <i class='bx bx-grid-alt nav_icon'></i>
                            <span class="nav_name">Categoria</span>
                        </a>

                        <a href="sidebar_rebanho.php" class="nav_link ">
                            <i class='bx bx-bookmark nav_icon'></i>
                            <span class="nav_name">Rebanho</span>
                        </a>

                        <a href="sidebar_inventario.php" class="nav_link">
                            <i class='bx bx-bar-chart-alt-2 nav_icon'></i>
                            <span class="nav_name">Inventário</span>
                        </a>
                    </div>
                </div>
                <div>
                    <a href="form_edit_user.php?id=<?php echo $id; ?>" class="nav_link"> <i class='bx bx-user-circle nav_icon'></i> <span class="nav_name">Editar Perfil</span> </a>
                    <a href="../script/logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Sair</span> </a>
                </div>
            </nav>
        </div>
        <!--Container Main start-->
        <div class="height-100 bg-light" style="margin-top: 80px;">

            <h3 class="mb-5 text-center">Edição Animal</h3>

            <div>
                <form action="../script/edit_animal.php" method="POST">

                    <a href="sidebar_animal.php"><i class="bi bi-arrow-return-left"></i></a>

                    <h4>Formulário de Edição</h4>
                    <div class="row form-row">
                        <div class="row mx-1">
                            <div class="col">
                                <label for="brinco" class="form-label ms-1">Brinco</label>
                                <input type="text" name="brinco" id="brinco" class="form-control border-dark border mb-3  me-2" id="floatingInput" required value="<?php echo $brinco_animal; ?>">
                            </div>
                            <div class="col">
                                <label for="especie" class="form-label ms-1">Espécie</label>
                                <input type="text" name="especie" id="especie" class="form-control border-dark border mb-3 " id="floatingInput" required value="<?php echo $especie_animal; ?>">
                            </div>
                        </div>

                        <div class="row mx-1">
                            <div class="col">
                                <label for="categoria" class="form-label ms-1">Categoria</label>
                                <select id="categoria" name="categoria" class="form-select border-dark border mb-3" required>
                                    <option selected value="<?php echo $nome_categoria_animal; ?>"><?php echo $nome_categoria_animal; ?></option>
                                    <?php

                                    $sql_categoria = "SELECT * FROM categoria WHERE Nome != '$nome_categoria_animal'";
                                    $result_categoria = $conn->query($sql_categoria);

                                    if ($result_categoria->num_rows > 0) {

                                        while ($row_categoria = $result_categoria->fetch_assoc()) {

                                    ?>
                                            <option value="<?php echo $row_categoria['Nome']; ?>"><?php echo $row_categoria["Nome"]; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="col">
                                <label for="rebanho" class="form-label ms-1">Rebanho</label>
                                <select id="rebanho" name="rebanho" class="form-select border-dark border mb-3" required>
                                    <option selected value="<?php echo $nome_rebanho_animal; ?>"><?php echo $nome_rebanho_animal; ?></option>
                                    <?php

                                    $sql_rebanho = "SELECT * FROM rebanho WHERE Nome != '$nome_rebanho_animal'";
                                    $result_rebanho = $conn->query($sql_rebanho);

                                    if ($result_rebanho->num_rows > 0) {

                                        while ($row_rebanho = $result_rebanho->fetch_assoc()) {

                                    ?>
                                            <option value="<?php echo $row_rebanho['Nome']; ?>" class="text-capitalize"><?php echo $row_rebanho["Nome"]; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mx-1">
                            <div class="col">
                                <label for="" class="form-label ms-1">Pelagem</label>
                                <input type="text" name="pelagem" id="pelagem" class="form-control border-dark border mb-3  me-2" id="pelagem" required value="<?php echo $pelagem_animal; ?>">
                            </div>
                            <div class="col">
                                <label for="" class="form-label ms-1">Data de Nascimento</label>
                                <input type="date" name="date" class="form-control border-dark border mb-3 " id="date" required value="<?php echo $data_nasc_animal; ?>">
                            </div>
                        </div>

                        <div class="row mx-1">
                            
                            <div class="col ">
                                <label for="">Sexo</label>
                                <?php if ($sexo_animal == "M") { ?>

                                    <div class="form-check form-check-inline col-2">
                                        <input class="form-check-input border border-dark" type="radio" name="sexo" id="macho" value="macho" checked>
                                        <label class="form-check-label" for="sexo">Macho</label>
                                    </div>
                                    <div class="form-check form-check-inline col-2">
                                        <input class="form-check-input border border-dark" type="radio" name="sexo" id="femea" value="femea">
                                        <label class="form-check-label" for="sexo">Fêmea</label>
                                    </div>

                                <?php } else { ?>
                                    <div class="form-check form-check-inline col-2">
                                        <input class="form-check-input border border-dark" type="radio" name="sexo" id="macho" value="macho">
                                        <label class="form-check-label" for="sexo">Macho</label>
                                    </div>
                                    <div class="form-check form-check-inline col-2">
                                        <input class="form-check-input border border-dark" type="radio" name="sexo" id="femea" value="femea" checked>
                                        <label class="form-check-label" for="sexo">Fêmea</label>
                                    </div>
                                <?php   } ?>
                            </div>


                        </div>

                    </div>
                    <input type="hidden" id="id_edit" name="id_edit" value="<?php echo $edit_id; ?>">
                    <input type="hidden" id="id_produtor" name="idprodutor" value="<?php echo $id; ?>">

                    <input type="submit" value="Enviar">
                </form>
            </div>

        </div>
        <!--Container Main end-->
    </body>
    <?php if (!isset($_GET['e'])) {
    } else if ($_GET['e'] == md5(1)) {

    ?>
        <script>
            // Função para mostrar o SweetAlert
            Swal.fire({
                title: "Sucesso!",
                text: "Categoria adicionada com sucesso.",
                icon: "success"

            }).then((result) => {
                window.location.href = "sidebar_categoria.php";
            });
        </script>

    <?php

    } else if ($_GET['e'] == md5(2)) { ?>
        <script>
            // Função para mostrar o SweetAlert
            Swal.fire({
                title: "Sucesso!",
                text: "Categoria deletada com sucesso.",
                icon: "success"

            }).then((result) => {
                window.location.href = "sidebar_categoria.php";
            });
        </script>
    <?php  } else if ($_GET['e'] == md5(3)) { ?>
        <script>
            // Função para mostrar o SweetAlert
            Swal.fire({
                title: "Sucesso!",
                text: "Categoria editado com sucesso.",
                icon: "success"

            }).then((result) => {
                window.location.href = "sidebar_categoria.php";
            });
        </script>
    <?php  } else if ($_GET['e'] == md5(4)) { ?>
        <script>
            // Função para mostrar o SweetAlert
            Swal.fire({
                title: "Ops!",
                text: "Não foi possível deletar a categoria.",
                icon: "error"

            }).then((result) => {
                window.location.href = "sidebar_categoria.php";
            });
        </script>
    <?php  } ?>

    <script>
        function AlertDeletCategoria(id) {
            Swal.fire({
                title: 'Tem certeza?',
                text: 'Você não será capaz de reverter isso!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `../script/delet_categoria.php?id=${id}`;
                }
            });
        }
    </script>

</html>