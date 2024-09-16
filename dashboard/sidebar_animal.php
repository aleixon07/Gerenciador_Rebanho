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

$sql_conta = "SELECT COUNT(*) as num_animal FROM animal WHERE idProdutor = '$id'";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Animação de impressão (de cima para baixo) */
        @keyframes printAnimation {
            0% {
                transform: translateY(-100%);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .print-in {
            animation: printAnimation 1.0s ease-in-out;
            display: block;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>


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
            <div class="header_img"><img src="https://www.promoview.com.br/uploads/images/unnamed%2819%29.png" alt="">
            </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div> <a href="sidebar.php" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span
                            class="nav_logo-name">Administrativa</span> </a>
                    <div class="nav_list">
                        <?php if ($nivel >= 2) { ?>
                            <a href="sidebar_usuario.php" class="nav_link">
                                <i class='bx bx-user nav_icon'></i> <span class="nav_name">Usuários</span>
                            </a>
                        <?php } ?>

                        <a href="#" class="nav_link active">
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
                    <a href="form_edit_user.php?id=<?php echo $id; ?>" class="nav_link"> <i
                            class='bx bx-user-circle nav_icon'></i> <span class="nav_name">Editar Perfil</span> </a>
                    <a href="../script/logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                            class="nav_name">Sair</span> </a>
                </div>
            </nav>
        </div>
        <!--Container Main start-->
        <div class="height-100 bg-light" style="margin-top: 80px;">

            <h3 class="text-center">Listagem de Animais</h3>

            <div class="ms-5 me-5">

                <button onclick="toggleForm()" class="btn bg-secondary-subtle border border-dark mt-3 mb-3">
                    + Adicionar
                </button>

                <div id="formContainer" class="fade-in mb-5" style="display: none;">
                    <!-- Seu formulário aqui -->
                    <div class="mb-3 text-end">
                        <button class="btn border border-dark " style="background-color: #5afac2;"
                            data-bs-toggle="modal" data-bs-target="#modal_categoria">+ Adicionar Categoria</button>
                        <button class="btn border border-dark " style="background-color: #5afac2;"
                            data-bs-toggle="modal" data-bs-target="#modal_rebanho">+ Adicionar Rebanho</button>
                    </div>

                    <form action="../script/cad_animal.php" method="POST">

                        <div class="row mx-1">
                            <div class="col">
                                <label for="brinco" class="form-label ms-1">Brinco</label>
                                <input type="text" name="brinco" id="brinco"
                                    class="form-control border-dark border mb-3  me-2" id="floatingInput" required
                                    placeholder="">
                            </div>
                            <div class="col">
                                <label for="especie" class="form-label ms-1">Espécie</label>
                                <input type="text" name="especie" id="especie"
                                    class="form-control border-dark border mb-3 " id="floatingInput" required
                                    placeholder="">
                            </div>
                        </div>

                        <div class="row mx-1">
                            <div class="col">
                                <label for="categoria" class="form-label ms-1">Categoria</label>
                                <select id="categoria" name="categoria" class="form-select border-dark border mb-3"
                                    required>
                                    <option selected>Escolha...</option>
                                    <?php

                                    $sql_categoria = "SELECT * FROM categoria";
                                    $result_categoria = $conn->query($sql_categoria);

                                    if ($result_categoria->num_rows > 0) {

                                        while ($row_categoria = $result_categoria->fetch_assoc()) {

                                            ?>
                                            <option value="<?php echo $row_categoria['Nome']; ?>">
                                                <?php echo $row_categoria["Nome"]; ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="col">
                                <label for="rebanho" class="form-label ms-1">Rebanho</label>
                                <select id="rebanho" name="rebanho" class="form-select border-dark border mb-3"
                                    required>
                                    <option selected>Escolha...</option>
                                    <?php

                                    $sql_rebanho = "SELECT * FROM rebanho";
                                    $result_rebanho = $conn->query($sql_rebanho);

                                    if ($result_rebanho->num_rows > 0) {

                                        while ($row_rebanho = $result_rebanho->fetch_assoc()) {

                                            ?>
                                            <option value="<?php echo $row_rebanho['Nome']; ?>" class="text-capitalize">
                                                <?php echo $row_rebanho["Nome"]; ?>
                                            </option>
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
                                <input type="text" name="pelagem" id="pelagem"
                                    class="form-control border-dark border mb-3  me-2" id="pelagem" required
                                    placeholder="">
                            </div>
                            <div class="col">
                                <label for="" class="form-label ms-1">Data de Nascimento</label>
                                <input type="date" name="date" class="form-control border-dark border mb-3 " id="date"
                                    required>
                            </div>
                        </div>

                        <div class="row mx-1">

                            <div class="col">
                                <label for="">Sexo</label>
                                <div class="form-check form-check-inline col-2">
                                    <input class="form-check-input border border-dark" type="radio" name="sexo"
                                        id="macho" value="macho" checked>
                                    <label class="form-check-label" for="sexo">Macho</label>
                                </div>
                                <div class="form-check form-check-inline col-2">
                                    <input class="form-check-input border border-dark" type="radio" name="sexo"
                                        id="femea" value="femea">
                                    <label class="form-check-label" for="sexo">Fêmea</label>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="idprodutor" id="idprodutor" value="<?php echo $id; ?>">

                        <div class="text-center">
                            <a onclick="toggleForm()" class="btn bg-secondary-subtle border border-dark">Fechar</a>
                            <button type="submit" class="btn border border-dark"
                                style="background-color: #5afac2;">Adicionar</button>
                        </div>
                </div>
                </form>
                <div class="row">
                    <table class="table col border border-2 border-dark">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Brinco</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Rebanho</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql = "SELECT * FROM animal  WHERE idProdutor = '$id'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    $id_categoria = $row["idCategoria"];
                                    $id_rebanho = $row["idRebanho"];


                                    $sql_rebanho = "SELECT * FROM rebanho WHERE idRebanho = '$id_rebanho'";
                                    $result_rebanho = $conn->query($sql_rebanho);

                                    if ($result_rebanho->num_rows > 0) {

                                        // Recorrer los resultados y mostrar los datos
                                        while ($row_rebanho = $result_rebanho->fetch_assoc()) {

                                            $nome_rebanho = $row_rebanho["Nome"];
                                        }
                                    } else {
                                        header("Location: ../dashboard/sidebar.php");
                                    }

                                    $sql_categoria = "SELECT * FROM categoria WHERE idCategoria = '$id_categoria'";
                                    $result_categoria = $conn->query($sql_categoria);

                                    if ($result_categoria->num_rows > 0) {

                                        // Recorrer los resultados y mostrar los datos
                                        while ($row_categoria = $result_categoria->fetch_assoc()) {

                                            $nome_categoria = $row_categoria["Nome"];
                                        }
                                    } else {
                                        header("Location: ../dashboard/sidebar.php");
                                    }

                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row["Brinco"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $nome_categoria; ?>
                                        </td>
                                        <td>
                                            <?php echo $nome_rebanho; ?>
                                        </td>

                                        <td>
                                            <button data-bs-toggle="modal"
                                                data-bs-target="#modal<?php echo $row["idAnimal"]; ?>"
                                                class='btn border border-dark border-opacity-25 '><i
                                                    class="bi bi-eye-fill"></i></button>
                                            <a href='form_edit_animal.php?id=<?php echo $row["idAnimal"]; ?>'
                                                class='btn border border-dark border-opacity-25 '><i
                                                    class="bi bi-pencil-fill"></i></a>
                                            <button onclick='AlertDeletAnimal(<?php echo $row["idAnimal"]; ?>)'
                                                class='btn border border-dark border-opacity-25'><i
                                                    class="bi bi-trash-fill"></i></button>
                                        </td>
                                    </tr>

                                    <!-- modal animal -->
                                    <div class="modal fade" id="modal<?php echo $row["idAnimal"]; ?>" tabindex="-1"
                                        aria-labelledby="modal<?php echo $row["idAnimal"]; ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">

                                            <div class="modal-content border border-dark border-2">
                                                <div class="modal-header border-bottom border-dark"
                                                    style="background-color: #5afac2;">
                                                    <h1 class="modal-title fs-5" id="modal<?php echo $row["idAnimal"]; ?>">Vendo
                                                        Animal</h1>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mx-1">
                                                        <div class="col">
                                                            <label for="brinco" class="form-label ms-1">Brinco</label>
                                                            <input type="text" id="brinco"
                                                                class="form-control border-dark border mb-3  me-2"
                                                                value="<?php echo $row["Brinco"]; ?>" disabled required
                                                                placeholder="">
                                                        </div>
                                                        <div class="col">
                                                            <label for="especie" class="form-label ms-1">Espécie</label>
                                                            <input type="text" id="especie"
                                                                class="form-control border-dark border mb-3 "
                                                                value="<?php echo $row["Especie"]; ?>" disabled required
                                                                placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="row mx-1">
                                                        <?php
                                                        $c = $row["idCategoria"];
                                                        $sql_categoria_listagem = "SELECT * FROM categoria WHERE idCategoria = '$c'";
                                                        $result_categoria_listagem = $conn->query($sql_categoria_listagem);
                                                        $row_categoria_listagem = $result_categoria_listagem->fetch_assoc();
                                                        ?>
                                                        <div class="col">
                                                            <label for="brinco" class="form-label ms-1">Categoria</label>
                                                            <input type="text" id="brinco"
                                                                class="form-control border-dark border mb-3  me-2"
                                                                value="<?php echo $row_categoria_listagem["Nome"]; ?>" disabled
                                                                required placeholder="">
                                                        </div>
                                                        <?php
                                                        $d = $row["idRebanho"];
                                                        $sql_rebanho_listagem = "SELECT * FROM rebanho WHERE idRebanho = '$d'";
                                                        $result_rebanho_listagem = $conn->query($sql_rebanho_listagem);
                                                        $row_rebanho_listagem = $result_rebanho_listagem->fetch_assoc();
                                                        ?>
                                                        <div class="col">
                                                            <label for="especie" class="form-label ms-1">Rebanho</label>
                                                            <input type="text" id="especie"
                                                                class="form-control border-dark border mb-3 "
                                                                value="<?php echo $row_rebanho_listagem["Nome"]; ?>" disabled
                                                                required placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="row mx-1">
                                                        <div class="col">
                                                            <label for="brinco" class="form-label ms-1">Pelagem</label>
                                                            <input type="text" name="brinco" id="brinco"
                                                                class="form-control border-dark border mb-3  me-2"
                                                                value="<?php echo $row["Pelagem"]; ?>" disabled required
                                                                placeholder="">
                                                        </div>
                                                        <div class="col">
                                                            <label for="especie" class="form-label ms-1">Data de
                                                                Nascimento</label>
                                                            <input type="text" name="especie" id="especie"
                                                                class="form-control border-dark border mb-3 "
                                                                value="<?php echo $row["Data_de_nascimento"]; ?>" disabled
                                                                required placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="row mx-1">

                                                        <?php
                                                        $a = $row["Sexo"];
                                                        if ($a == "F") {
                                                            $b = "Fêmea";
                                                        } else {
                                                            $b = "Macho";
                                                        }
                                                        ?>
                                                        <div class="col">
                                                            <label for="especie" class="form-label ms-1">Sexo</label>
                                                            <input type="text" name="especie" id="especie"
                                                                class="form-control border-dark border mb-3 "
                                                                value="<?php echo $b; ?>" disabled required placeholder="">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="modal-footer border-tom border-dark">
                                                    <div>
                                                        <a type="button"
                                                            class="btn bg-secondary-subtle border border-dark w-100"
                                                            data-bs-dismiss="modal">Fechar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                        <?php
                                }
                            }
                            ?>
                </tbody>
                </table>
                <div class="col-2 ms-3">
                    <div class=" border border-dark border-2" style="border-radius: 25px;">
                        <h5 class="text-center border-bottom border-dark border-2 pb-2">Animais Cadastrados</h5>
                        <h1 class="text-center" style="color: #35b085;">
                            <?php echo $row_conta["num_animal"]; ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- modal categoria -->
        <div class="modal fade" id="modal_categoria" tabindex="-1" aria-labelledby="modal_categoria" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content border border-dark border-2">
                    <div class="modal-header border-bottom border-dark" style="background-color: #5afac2;">
                        <h1 class="modal-title fs-5" id="modal_categoria">Adicionando Categoria</h1>
                    </div>
                    <div class="modal-body">
                        <form action="../script/cad_categoria.php" method="POST">
                            <input type="text" name="categoria" class="form-control border-dark border"
                                id="floatingInput" required placeholder="Título">
                            <input type="hidden" name="a" id="a" value="1">

                    </div>
                    <div class="modal-footer border-tom border-dark">
                        <div>
                            <a type="button" class="btn bg-secondary-subtle border border-dark"
                                data-bs-dismiss="modal">Fechar</a>
                            <button type="submit" class="btn border border-dark"
                                style="background-color: #5afac2;">Adicionar</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>

        <!-- modal rebanho -->
        <div class="modal fade" id="modal_rebanho" tabindex="-1" aria-labelledby="modal_rebanho" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content border border-dark border-2">
                    <div class="modal-header border-bottom border-dark" style="background-color: #5afac2;">
                        <h1 class="modal-title fs-5" id="modal_rebanho">Adicionando Rebanho</h1>
                    </div>
                    <div class="modal-body">
                        <form action="../script/cad_rebanho.php" method="POST">
                            <input type="text" name="rebanho" class="form-control border-dark border" id="floatingInput"
                                required placeholder="Título">
                            <input type="hidden" name="a" id="a" value="1">
                    </div>
                    <div class="modal-footer border-tom border-dark">
                        <div>
                            <a type="button" class="btn bg-secondary-subtle border border-dark"
                                data-bs-dismiss="modal">Fechar</a>
                            <button type="submit" class="btn border border-dark"
                                style="background-color: #5afac2;">Adicionar</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>

        </div>
        <!--Container Main end-->
    </body>
    <div>
        <?php if (!isset($_GET['e'])) {
        } else if ($_GET['e'] == md5(1)) {

            ?>
                <script>
                    // Função para mostrar o SweetAlert
                    Swal.fire({
                        title: "Sucesso!",
                        text: "Animal adicionado com sucesso.",
                        icon: "success"

                    }).then((result) => {
                        window.location.href = "sidebar_animal.php";
                    });
                </script>

            <?php

        } else if ($_GET['e'] == md5(2)) { ?>
                    <script>
                        // Função para mostrar o SweetAlert
                        Swal.fire({
                            title: "Sucesso!",
                            text: "Animal deletado com sucesso.",
                            icon: "success"

                        }).then((result) => {
                            window.location.href = "sidebar_animal.php";
                        });
                    </script>
        <?php } else if ($_GET['e'] == md5(3)) { ?>
                        <script>
                            // Função para mostrar o SweetAlert
                            Swal.fire({
                                title: "Sucesso!",
                                text: "Animal editado com sucesso.",
                                icon: "success"

                            }).then((result) => {
                                window.location.href = "sidebar_animal.php";
                            });
                        </script>
        <?php } else if ($_GET['e'] == md5(4)) { ?>
                            <script>
                                // Função para mostrar o SweetAlert
                                Swal.fire({
                                    title: "Ops!",
                                    text: "Não foi possível deletar o animal.",
                                    icon: "error"

                                }).then((result) => {
                                    window.location.href = "sidebar_animal.php";
                                });
                            </script>
        <?php } else if ($_GET['e'] == md5(7)) { ?>
                                <script>
                                    // Função para mostrar o SweetAlert
                                    Swal.fire({
                                        title: "Ops!",
                                        text: "Já existe um animal com Brinco.",
                                        icon: "error"

                                    }).then((result) => {
                                        window.location.href = "sidebar_animal.php";
                                    });
                                </script>
        <?php } else if ($_GET['e'] == md5(9)) { ?>
                                    <script>
                                        // Função para mostrar o SweetAlert
                                        Swal.fire({
                                            title: "Sucesso!",
                                            text: "Categoria adicionada com sucesso.",
                                            icon: "success"

                                        }).then((result) => {
                                            window.location.href = "sidebar_animal.php";
                                        });
                                    </script>
        <?php } else if ($_GET['e'] == md5(10)) { ?>
                                        <script>
                                            // Função para mostrar o SweetAlert
                                            Swal.fire({
                                                title: "Sucesso!",
                                                text: "Rebanho adicionada com sucesso.",
                                                icon: "success"

                                            }).then((result) => {
                                                window.location.href = "sidebar_animal.php";
                                            });
                                        </script>
        <?php } ?>

        <script>
            function AlertDeletAnimal(id) {
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
                        window.location.href = `../script/delet_animal.php?id=${id}`;
                    }
                });
            }
        </script>
    </div>
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