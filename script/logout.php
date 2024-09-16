<?php
// Inicializa a sessão.
session_start();

// Apaga todas as variáveis da sessão
$_SESSION = array();

// Por último, destrói a sessão
session_destroy();
header("Location: ../login/index.php");
?>