<?php
session_start();

if (!isset($_SESSION["idProdutor"])) {
    header("Location: ../login/index.php");
}
if (!isset($_GET["id"])) {
    header("Location: sidebar_categoria.php");
}
if (empty($_GET["id"])) {
    header("Location: sidebar_categoria.php");
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

$sql1 = "SELECT * FROM categoria WHERE idCategoria ='$edit_id' AND idProdutor = '$id'";
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {

    $row1 = $result1->fetch_assoc();

    $nome_categoria = $row1["Nome"];
} else {
    header("Location: sidebar_categoria.php");
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

                        <a href="sidebar_animal.php" class="nav_link">
                            <i class='bx bx-message-square-detail nav_icon'></i>
                            <span class="nav_name">Animal</span>
                        </a>

                        <a href="sidebar_categoria.php" class="nav_link active">
                            <i class='bx bx-grid-alt nav_icon'></i>
                            <span class="nav_name">Categoria</span>
                        </a>

                        <a href="sidebar_rebanho.php" class="nav_link">
                            <i class='bx bx-bookmark nav_icon'></i>
                            <span class="nav_name">Rebanho</span>
                        </a>

                        <a href="sidebar_inventario.php" class="nav_link">
                            <i class='bx bx-bar-chart-alt-2 nav_icon'></i>
                            <span class="nav_name">Inventário</span>
                        </a>
                    </div>
                </div> <div>
                    <a href="form_edit_user.php?id=<?php echo $id; ?>" class="nav_link"> <i class='bx bx-user-circle nav_icon' ></i> <span class="nav_name">Editar Perfil</span> </a>
                    <a href="../script/logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Sair</span> </a>
                </div>
            </nav>
        </div>
        <!--Container Main start-->
        <div class="height-100 bg-light" style="margin-top: 80px;">

            <h3 class="mb-5 text-center">Edição Categoria</h3>

            <div>
                <form action="../script/edit_categoria.php" method="POST">

                    <a href="sidebar_categoria.php"><i class="bi bi-arrow-return-left"></i></a>

                    <h4>Formulário de Edição</h4>
                    <div class="row form-row">
                        <div class="col-6">
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" required value="<?php echo $nome_categoria; ?>">
                        </div>

                    </div>
                    <input type="hidden" id="id_edit" name="id_edit" value="<?php echo $edit_id; ?>">

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