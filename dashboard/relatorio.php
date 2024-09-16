<?php
require './vendor/autoload.php';

require_once "../script/connection.php";

$data_relatorio = date("d-m-y");
$nome_arquivo = uniqid() . 'relatorio_' . $data_relatorio . '.pdf';

$sql = "SELECT * FROM estoque ";

$result = mysqli_query($conn, $sql);

$date_atual = date('y-m-d');

$row = mysqli_fetch_assoc($result);

$id_cat = $row['tipo_incidente'];

$sql_cat = "SELECT * FROM categoria WHERE idcategoria = '$id_cat'";

$result_cat = mysqli_query($conn, $sql_cat);

$row_cat = mysqli_fetch_assoc($result_cat);

$dados = '

<h1 style="text-align: center;">Denúncia SADM</h1>
<table style="border-collapse: collapse; width: 100%;">
    <tr style="background-color: #f2f2f2;">
        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Campos</th>
        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;"></th>
    </tr>
    <tr>
        <td style="border: 1px solid #ddd; padding: 8px;">Nome da Denunciante:</td>
        <td style="border: 1px solid #ddd; padding: 8px;">';

if ($row['nome_denuciante'] == null) {
    $dados .= "<em style='color:#c2c0c2;'>Anônimo</em>";
} else {
    $dados .= $row['nome_denuciante'];
}

$dados .= '</td>
    </tr>
    <tr>
        <td style="border: 1px solid #ddd; padding: 8px;">Informações de Contato:</td>
        <td style="border: 1px solid #ddd; padding: 8px; ">';

if ($row['info_contato'] == null) {
    $dados .= "<em style='color:#c2c0c2;'>Sem informações de contato</em>";
} else {
    $dados .= $row['info_contato'];
}

$dados .= '</td>
    </tr>
    <tr>
        <td style="border: 1px solid #ddd; padding: 8px;">Data e Hora da Ocorrência:</td>
        <td style="border: 1px solid #ddd; padding: 8px; ">' . $row['data_hora'] . '</td>
    </tr>
    <tr>
        <td style="border: 1px solid #ddd; padding: 8px;">Local da Ocorrência:</td>
        <td style="border: 1px solid #ddd; padding: 8px; ">' . $row['local_ocorrencia'] . '</td>
    </tr>
    <tr>
        <td style="border: 1px solid #ddd; padding: 8px;">Descrição dos Incidentes:</td>
        <td style="border: 1px solid #ddd; padding: 8px; ">' . $row['descricao_incidente'] . '</td>
    </tr>
    <tr>
        <td style="border: 1px solid #ddd; padding: 8px;">Tipo de Incidente:</td>
        <td style="border: 1px solid #ddd; padding: 8px; ">' . $row_cat['nome'] . '</td>
    </tr>
    <tr>
        <td style="border: 1px solid #ddd; padding: 8px;">Nome do Agressor:</td>
        <td style="border: 1px solid #ddd; padding: 8px;">';

if ($row['nome_agressor'] == null) {
    $dados .= "<em style='color:#c2c0c2;'>Sem conhecimento do nome do Agressor</em>";
} else {
    $dados .= $row['nome_agressor'];
}

$dados .= '</td>
    </tr>
    <tr>
        <td style="border: 1px solid #ddd; padding: 8px;">Detalhes sobre o Agressor:</td>
        <td style="border: 1px solid #ddd; padding: 8px; ">' . $row['detalhe_agressor'] . '</td>
    </tr>
    <tr>
        <td style="border: 1px solid #ddd; padding: 8px;">Testemunhas:</td>
        <td style="border: 1px solid #ddd; padding: 8px;">';

if ($row['testemunhas'] == null) {
    $dados .= "<em style='color:#c2c0c2;'>Nenhuma testemunha</em>";
} else {
    $dados .= $row['testemunhas'];
}

$dados .= '</td>
    </tr>
    <tr>
        <td style="border: 1px solid #ddd; padding: 8px;">Evidências:</td>
        <td style="border: 1px solid #ddd; padding: 8px; ">';

if ($row['evidencia'] == null) {
    $dados .= "<em style='color:#c2c0c2;'>Sem evidências</em>";
} else {
    $evidencia = $row['evidencia'];
    $dados .= "<a  style='text-decoration: underline;' >Evidência em anexo  </a>";
}

$dados .= '</td>
    </tr>
    <tr>
        <td style="border: 1px solid #ddd; padding: 8px;">Detalhes sobre a Relação entre a Denunciante e o Agressor:</td>
        <td style="border: 1px solid #ddd; padding: 8px; ">';

if ($row['relacao_agressor'] == null) {
    $dados .= "<em style='color:#c2c0c2;'>Sem ligação com o Agressor</em>";
} else {
    $dados .= $row['relacao_agressor'];
}

$dados .= '</td>
    </tr>
</table>

<p>Data de Envio de Denúncia: <strong>';

$dados .= $row['data_envio'];

$dados .= '

</strong></p>

';


$dados .= '

<p style="margin-top: 10px;">Data de Submição da Denúncia: <strong>';

$dados .= $date_atual;

$dados .= '

</strong></p>

';


use Dompdf\Dompdf;

$dompdf = new Dompdf();

$dompdf->loadHtml($dados);

$dompdf->setPaper('A4', 'portrait'); // formato do pdf

$dompdf->render();

$dompdf->stream($nome_arquivo); // Nome do arquivo
