<?php
if (filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
  $row = 1;
  $participantes = array();
  $participantes_email = array();
  if (($handle = fopen("participantes-tech-interior.csv", "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
          $row++;
          array_push($participantes,$data);
          array_push($participantes_email,$data[1]);
      }
      fclose($handle);
  }

  $participante = array_search($_POST['email'],$participantes_email);
  if($participante !== FALSE){

    require_once __DIR__ . '/vendor/autoload.php';
    $mpdf = new mPDF('c','A4');

    $html = "<div class='centro'>
          <img class='logo' src='imgs/logo.png' />
        </div>
        <br />
        <p class='just'>
          Certificamos que <strong>".$participantes[$participante][0]."</strong> participou do Tech Interior 2017 na cidade de Jaboticabal no dia 27 de maio de 2017, totalizando <strong>8 horas</strong> de palestras/workshops.
        </p>
        <br />
        <div class='centro txt-assinatura'>
          <img class='assinatura' src='imgs/assinatura.png' /><br />
          __________________________<br />
          <strong>Organização - Tech Interior</strong>
        </div>";

    $stylesheet = file_get_contents('style.css');

    $mpdf->AddPage('L');

    $mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;

  } else {
    header("location: index.php?erro=1");
  }

} else {
    header("location: index.php?erro=1");
}
