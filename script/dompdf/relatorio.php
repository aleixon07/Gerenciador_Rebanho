<?php

header("Location: ../sidebar_estoque.php");

    include('config.php');
    echo 'entrei no arquivo';
    $sql = "SELECT * FROM estoque";

    $res = $conn->query($sql);

    if($res->num_rows > 0) {
        while( $row = $res->fetch_object() ) {
            print $row->idAnimal;
            print $row->idInventario;
            print $row->Peso;
            print $row->Status;
            print $row->BO;
            print $row->idProdutor;
        }
    }else{
        print 'Nenhum dado registrado';
    }


    use Dompdf\Dompdf;
    echo 'passei pelo iff';

    require_once 'dompdf/autoload.inc.php';

    $dompdf = new Dompdf();

    $dompdf->loadHtml('Relátorios de estoque de animais!');

    $dompdf->set_option('defaultFont','sans');

    $dompdf-> setPaper('A4','portrait'); //landscape

    $dompdf->render();

    $dompdf-> stream();
?>