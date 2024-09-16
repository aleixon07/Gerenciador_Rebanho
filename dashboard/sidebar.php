<?php
session_start();

if (!isset($_SESSION["idProdutor"])) {
    header("Location: ../login/index.php");
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <body id="body-pd">
        <header class="header" id="header">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <div>
                <h4 class="text-light">Olá <?php echo $name_user; ?></h4>
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

                        <a href="sidebar_categoria.php" class="nav_link ">
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

                        <a href="sidebar_estoque.php" class="nav_link">
                            <i class='bx bx-wallet nav_icon'></i> 
                            <span class="nav_name">Estoque</span>
                        </a>
                        <a href="sidebar_relatorio.php" class="nav_link">
                            <i class='bx bx-wallet nav_icon'></i> 
                            <span class="nav_name">Relatórios</span>
                        </a>
                    </div>
                </div>
                <div>
                    <a href="form_edit_user.php?id=<?php echo $id; ?>" class="nav_link"> <i class='bx bx-user-circle nav_icon' ></i> <span class="nav_name">Editar Perfil</span> </a>
                    <a href="../script/logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Sair</span> </a>
                </div>
            </nav>
            
        </div>
        <!--Container Main start-->
        <h3 class="text-center">Seja Bem-Vindo ao SGR-Gerenciador do Rebanho</h3>
        <div class="height-100" style="background-image: url(img/gado.png);">

            <div class="row ms-5">
                <div class="col mt-5"> <a href="sidebar_animal.php" class=""><img class="border border-3 border-dark" src="img/vermelho.jpeg" alt="" height="150" width="280"></a>
                </div>
                <div class="col mt-5"> <a href="sidebar_categoria.php" class=""><img class="border border-3 border-dark" src="img/azul.jpeg" alt="" height="150" width="280"></a>
                </div>
                <div class="col mt-5"> <a href="sidebar_inventario.php" class=""><img class="border border-3 border-dark" src="img/amarelo.jpeg" alt="" height="150" width="280"></a>
                </div>
            </div>
            <?php if ($nivel >= 2){?>
            <div class="row ms-5">

                <div class="col mt-5"> <a href="sidebar_rebanho.php" class=""><img class="border border-3 border-dark" src="img/verde.jpeg" alt="" height="150" width="280"></a>
                </div>
                <div class="col mt-5"> <a href="sidebar_estoque.php" class=""><img class="border border-3 border-dark" src="img/roxo.jpeg" alt="" height="150" width="280"></a>
                </div>
                <div class="col mt-5"> <a href="sidebar_usuario.php" class=""><img class="border border-3 border-dark" src="img/rosa.jpeg" alt="" height="150" width="280"></a>
                </div>
                </div>
                <?php
            }
            else{ ?>
            <div class="row">

                <div class="col-2"></div>
                <div class="col mt-5"> <a href="sidebar_rebanho.php" class=""><img class="border border-3 border-dark" src="img/verde.jpeg" alt="" height="150" width="280"></a>
                </div>
                <div class="col mt-5 me-5"> <a href="sidebar_estoque.php" class=""><img class="border border-3 border-dark" src="img/roxo.jpeg" alt="" height="150" width="280"></a>
                </div>
            </div>
                <?php } ?> 
                

            
            <div>

            </div>
        </div>
        <!--Container Main end-->
        <?php if (!isset($_GET['e'])) {
    } else if ($_GET['e'] == md5(11)) {

    ?>
        <script>
            // Função para mostrar o SweetAlert
            Swal.fire({
                title: "Sucesso!",
                text: "Perfil editado com sucesso.",
                icon: "sucess"

            }).then((result) => {
                window.location.href = "sidebar.php";
            });
        </script>

    <?php

    } ?>
    </body>

</html>