<?php

// Carregar o Composer
require './dashboard/sidebar.php';

// Incluir conexao com BD
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "tcc";


$conn = mysqli_connect($servername, $username, $password,$db_name);
// Executar a QUERY
$result_usuarios->execute();

// Informacoes para o PDF
$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<link rel='stylesheet' href='http://localhost/tcc/dashboard/sidebar_estoque.php'";
$dados .= "<title>Celke - Gerar PDF</title>";
$dados .= "</head>";
$dados .= "<body>";
$dados .= "<h1>Listar os Usuário</h1>";

// Ler os registros retornado do BD
while($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)){
    //var_dump($row_usuario);
    extract($row_usuario);
    $dados .= "ID: $id <br>";
    $dados .= "Nome: $nome <br>";
    $dados .= "E-mail: $email <br>";
    $dados .= "<hr>";
}


$dados .= "O PHP proin iaculis, libero et dictum fringilla, ex metus scelerisque mauris, sit amet lobortis enim justo quis arcu. Proin eget pharetra ipsum, eget auctor purus.";
$dados .= "</body>";


// Referenciar o namespace Dompdf
use Dompdf\Dompdf;

// Instanciar e usar a classe dompdf
$dompdf = new Dompdf(['enable_remote' => true]);

// Instanciar o metodo loadHtml e enviar o conteudo do PDF
$dompdf->loadHtml($dados);

// Configurar o tamanho e a orientacao do papel
// landscape - Imprimir no formato paisagem
//$dompdf->setPaper('A4', 'landscape');
// portrait - Imprimir no formato retrato
$dompdf->setPaper('A4', 'portrait');

// Renderizar o HTML como PDF
$dompdf->render();

// Gerar o PDF
$dompdf->stream();
