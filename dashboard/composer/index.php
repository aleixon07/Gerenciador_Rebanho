<?php
require './vendor/autoload.php';
require_once '../../script/connection.php';

$data_atual = date('d-m-y');
$nome_arquivo = 'SGR_' . $data_atual . '_' . uniqid() . '.pdf';
$ano_inventario = $_POST['ano'];

    $sql = "SELECT inventario.Nome, inventario.Ano, Brinco, estoque.Peso, BO, Status FROM `estoque`
    JOIN animal USING (idAnimal)
    JOIN inventario USING (idInventario)
    WHERE inventario.Ano = $ano_inventario";

$result = mysqli_query($conn, $sql);




if (mysqli_num_rows($result) > 0) {

    $num_animal = mysqli_num_rows($result);

    $dados = "<h2 style='text-align: center;'>Relátio do SGR</h2>";

    $dados .= "<h4 style='text-align: end;'>Número de Animais: $num_animal</h4>";
    // Início da tabela
    $dados .= "<table style='width:100%; border-collapse: collapse;'>
                    <thead>
                        <tr>
                            <th style='border: 1px solid #000; padding: 2px; background-color: #808080;'>Ano do Inventário</th>
                            <th style='border: 1px solid #000; padding: 8px; background-color: #808080;'>Brinco</th>
                            <th style='border: 1px solid #000; padding: 8px; background-color: #808080;'>Peso</th>
                            <th style='border: 1px solid #000; padding: 8px; background-color: #808080;'>BO</th>
                            <th style='border: 1px solid #000; padding: 8px; background-color: #808080;'>Status</th>
                        </tr>
                    </thead>
                    <tbody>";

    // Loop através dos resultados do banco de dados
    while ($row = mysqli_fetch_assoc($result)) {

        $status1 = $row['Status'];

        if($status1 == 'C'){
            $status2 = 'Consumo';

        }else if($status1 == 'E'){
            $status2 = 'Em Estoque';

        }else if($status1 == 'R'){
            $status2 = 'Roubado';


        }else if($status1 == 'N'){
            $status2 = 'Nascido';


        }else if($status1 == 'M'){
            $status2 = 'Morto';

        }

        $dados .= "<tr>
                        <td style='border: 1px solid #000; padding: 8px; text-transform: capitalize;'>{$row['Nome']} - {$row['Ano']}</td>
                        <td style='border: 1px solid #000; padding: 8px;'>{$row['Brinco']}</td>
                        <td style='border: 1px solid #000; padding: 8px;'>{$row['Peso']} Kg</td>
                        <td style='border: 1px solid #000; padding: 8px;'>{$row['BO']}</td>
                        <td style='border: 1px solid #000; padding: 8px;'>{$status2}</td>
                    </tr>";
    }

    // Fim da tabela
    $dados .= "</tbody></table>
    <h4>Data de Emissão: $data_atual</h4>
";
} else {
    $dados .= "<h1 style='color: red; text-align: center;'>Não foram encontrados animais pertencentes a esse ano.</h1>";
}

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($dados);
$dompdf->setPaper('A4', 'portrait'); // formato do pdf
$dompdf->render();
$dompdf->stream($nome_arquivo); // Nome do arquivo
