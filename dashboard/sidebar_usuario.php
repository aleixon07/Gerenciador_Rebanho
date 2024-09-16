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
    exit();
}

if ($nivel == 1) {
    header("Location: sidebar.php");
    exit();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>

    <body id="body-pd">
        <header class="header" id="header">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <div>
                <h4 class="text-light">Olá
                    <?php echo $name_user; ?>
                </h4>
            </div>
            <div class="header_img"> <img src="https://www.promoview.com.br/uploads/images/unnamed%2819%29.png" alt="">
            </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div> <a href="sidebar.php" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Administrativa</span> </a>
                    <div class="nav_list">
                        <?php if ($nivel >= 2) { ?>
                            <a href="" class="nav_link active">
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
                            <span class="nav_name">Relatorios</span>
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
            <h3 class="mb-5 text-center">Lista de Usuários</h3>
            <button onclick="toggleForm()" class="btn bg-secondary-subtle border border-dark mt-3 mb-3">
                Cadastra-se
            </button>
            <div id="formContainer" class="fade-in mb-5" style="display: none;">

                <form action="../script/cadastra.php" method="POST">

                    <div class="row mx-1">
                        <div class="col">
                            <label for="nome" class="form-label ms-1">Nome</label>
                            <input type="text" name="nome" id="nome" class="form-control border-dark border mb-3  me-2" id="floatingInput" required placeholder="">
                        </div>
                        <div class="col">
                            <label for="especie" class="form-label ms-1">Cpf</label>
                            <input type="text" name="cpf" id="cpf" class="form-control border-dark border mb-3 " id="floatingInput" required placeholder="">
                        </div>
                    </div>
                    <div class="row mx-1">
                        <div class="col">
                            <label for="brinco" class="form-label ms-1">Telefone</label>
                            <input type="text" name="telefone" id="telefone" class="form-control border-dark border mb-3  me-2" id="floatingInput" required placeholder="">
                        </div>
                        <div class="col">
                            <label for="especie" class="form-label ms-1">Endereco</label>
                            <input type="text" name="endereco" id="endereco" class="form-control border-dark border mb-3 " id="floatingInput" required placeholder="">
                        </div>
                    </div>
                    <div class="row mx-1">
                        <div class="col">
                            <label for="brinco" class="form-label ms-1">Email</label>
                            <input type="email" name="email" id="email" class="form-control border-dark border mb-3  me-2" id="floatingInput" required placeholder="">
                        </div>
                        <div class="col">
                            <label for="especie" class="form-label ms-1">Senha</label>
                            <input type="password" name="senha" id="senha" class="form-control border-dark border mb-3 " id="floatingInput" required placeholder="">
                        </div>
                    </div>
                    <div class="row mx-1">
                        <div class="col">
                            <label for="brinco" class="form-label ms-1">Rg</label>
                            <input type="text" name="rg" id="rg" class="form-control border-dark border mb-3  me-2" id="floatingInput" required placeholder="">
                        </div>
                        <div class="col">
                            <label for="especie" class="form-label ms-1">Localidade</label>
                            <input type="text" name="localidade" id="localidade" class="form-control border-dark border mb-3 " id="floatingInput" required placeholder="">
                        </div>
                    </div>
                    <div class="row mx-1">
                        <div class="col">
                            <label for="brinco" class="form-label ms-1">Municipio</label>
                            <input type="text" name="municipio" id="municipio" class="form-control border-dark border mb-3  me-2" id="floatingInput" required placeholder="">
                        </div>
                        <div class="col">
                            <label for="especie" class="form-label ms-1">Cep</label>
                            <input type="text" name="cep" id="Cep" class="form-control border-dark border mb-3 " id="floatingInput" required placeholder="">
                        </div>
                    </div>
                    <div class="row mx-1">
                        <div class="col-6">
                            <label for="brinco" class="form-label ms-1">Propriedade Rural</label>
                            <input type="text" name="prop_rural" id="prop_rural" class="form-control border-dark border mb-3  me-2" id="floatingInput" required placeholder="">
                        </div>
                        
                    </div>


                    <div class="text-center">
                        <a onclick="toggleForm()" class="btn bg-secondary-subtle border border-dark">Fechar</a>
                        <button type="submit" class="btn border border-dark" style="background-color: #5afac2;">Adicionar</button>
                    </div>
            </div>
            </form>
            <div>
                <table class="table border border-2 border-dark">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Email</th>
                            <th scope="col"></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = "SELECT * FROM usuario WHERE Nivel = '1'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {

                        ?>
                                <tr>
                                    <td>
                                        <?php echo $row["Nome"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $row["Cpf"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $row["Email"]; ?>
                                    </td>
                                    <td>
                                        <a href='form_edit_user.php?id=<?php echo $row["idProdutor"]; ?>' class='btn border border-dark border-opacity-25 '><i class="bi bi-pencil-fill"></i></a>

                                        <button onclick='AlertDeletUser(<?php echo $row["idProdutor"]; ?>)' class='btn border border-dark border-opacity-25'><i class="bi bi-trash-fill"></i></button>
                                    </td>
                                </tr>

                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--Container Main end-->
    </body>
    <?php if (!isset($_GET['e'])) {
    } else if ($_GET['e'] == md5(11)) {

    ?>
        <script>
            // Função para mostrar o SweetAlert
            Swal.fire({
                title: "Atenção!",
                text: "Você não pode se deletar.",
                icon: "error"

            }).then((result) => {
                window.location.href = "sidebar_usuario.php";
            });
        </script>

    <?php

    } else if ($_GET['e'] == md5(1)) { ?>
        <script>
            // Função para mostrar o SweetAlert
            Swal.fire({
                title: "Sucesso!",
                text: "Usuário adicionado com sucesso.",
                icon: "success"

            }).then((result) => {
                window.location.href = "sidebar_usuario.php";
            });
        </script>
    <?php } else if ($_GET['e'] == md5(2)) { ?>
        <script>
            // Função para mostrar o SweetAlert
            Swal.fire({
                title: "Sucesso!",
                text: "Usuário editado com sucesso.",
                icon: "success"

            }).then((result) => {
                window.location.href = "sidebar_usuario.php";
            });
        </script>
    <?php } else if ($_GET['e'] == md5(3)) { ?>
        <script>
            // Função para mostrar o SweetAlert
            Swal.fire({
                title: "Sucesso!",
                text: "Usuário deletado com sucesso.",
                icon: "success"

            }).then((result) => {
                window.location.href = "sidebar_usuario.php";
            });
        </script>
    <?php }else if ($_GET['e'] == md5(4)) { ?>
        <script>
            // Função para mostrar o SweetAlert
            Swal.fire({
                title: "Atenção!",
                text: "Esse email, CPF ou Rg já estão cadastrados no sistema, tente outro.",
                icon: "error"

            }).then((result) => {
                window.location.href = "sidebar_usuario.php";
            });
        </script>
    <?php } ?>

    <script>
        function AlertDeletUser(id) {
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
                    window.location.href = `../script/delete.php?id=${id}`;
                }
            });
        }
    </script>
    <script>
        function toggleForm() {
            const formContainer = document.getElementById('formContainer');

            if (formContainer.style.display === 'none') {
                // Se o formulário está oculto, exibimos com animação de impressão
                formContainer.style.display = 'block';
                formContainer.classList.add('print-in');
            } else {
                // Se o formulário está visível, ocultamos imediatamente
                formContainer.style.display = 'none';
                formContainer.classList.remove('print-in');
            }
        }
    </script>

</html>