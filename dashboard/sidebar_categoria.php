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
$sql_conta = "SELECT COUNT(*) as num_categoria FROM categoria WHERE idProdutor = '$id'";
$result_conta = $conn->query($sql_conta);
$row_conta = $result_conta->fetch_assoc();
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
                <div> <a href="sidebar.php" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Administrativa</span> </a>
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
                        <a href="sidebar_estoque.php" class="nav_link">
                            <i class='bx bx-wallet nav_icon'></i> 
                            <span class="nav_name">Estoque</span>
                        </a>
                        <a href="sidebar_relatorio.php" class="nav_link">
                            <i class='bx bx-wallet nav_icon'></i> 
                            <span class="nav_name">Relatorios</span>
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

            <h3 class="text-center">Listagem de Categorias</h3>

            <!-- Button trigger modal -->

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content border border-dark border-2">
                        <div class="modal-header border-bottom border-dark" style="background-color: #5afac2;">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionando Categoria</h1>
                        </div>
                        <div class="modal-body">
                            <form action="../script/cad_categoria.php" method="POST">
                                <input type="text" name="categoria" class="form-control border-dark border" id="categoria" required placeholder="Título">
                                <input type="hidden" name="idprodutor" id="idprodutor" value="<?php echo $id;?>" required >

                        </div>
                        <div class="modal-footer border-tom border-dark">
                            <div>
                                <a type="button" class="btn bg-secondary-subtle border border-dark" data-bs-dismiss="modal">Fechar</a>
                                <button type="submit" class="btn border border-dark" style="background-color: #5afac2;">Adicionar</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            <div class="ms-5">
                <button type="button" class="btn bg-secondary-subtle border border-dark mt-3 mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    + Adicionar
                </button>
                <div class="row">
                    <table class="table w-50 col-5 border border-2 border-dark">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql = "SELECT * FROM categoria  WHERE idProdutor = '$id'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {

                            ?>
                                    <tr>
                                        <td><?php echo $row["Nome"]; ?></td>
                                        <td>
                                            <a href='form_edit_categoria.php?id=<?php echo $row["idCategoria"]; ?>' class='btn border border-dark border-opacity-25 '><i class="bi bi-pencil-fill"></i></a>

                                            <button onclick='AlertDeletCategoria(<?php echo $row["idCategoria"]; ?>)' class='btn border border-dark border-opacity-25'><i class="bi bi-trash-fill"></i></button>
                                        </td>
                                    </tr>

                            <?php
                                }
                            }else{
                               
                            }
                            ?>
                        </tbody>
                    </table>

                    <div class="col-2 ms-3">
                        <div class=" border border-dark border-2" style="border-radius: 25px;">
                            <h5 class="text-center border-bottom border-dark border-2 pb-2">Categorias Cadastradas</h5>
                            <h1 class="text-center" style="color: #35b085;"><?php echo $row_conta["num_categoria"]; ?></h1>
                        </div>
                    </div>
                </div>
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
    <?php  }else if ($_GET['e'] == md5(20)) { ?>
        <script>
            // Função para mostrar o SweetAlert
            Swal.fire({
                title: "Atenção!",
                text: "Você não pode deletar uma categoria já cadastrada em um animal.",
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