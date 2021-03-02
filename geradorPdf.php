<?php

    use Dompdf\Dompdf;

    // include autoloader
    require_once './dompdf-master/autoload.inc.php';

    $dompdf = new DOMPDF();

    ob_start();
    require_once 'telaExemploPdf.php';
    $dompdf->loadHtml(ob_get_clean());
    
    $dompdf->setPaper("A4");

    $dompdf->render();
    $dompdf->stream(
        "Relatorio de componentes cadastrados.pdf",
        ["Attachment" => false]
    );

?>