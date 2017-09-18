<?php

include('../modelo/modelo.php');
include('cfgTwig.php');
include('verificarSesion.php');

$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol == 'personalLab') {
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl");
    $template->display();
    exit();
}
$idlab = $_GET['idlab'];
$idencuesta = $_GET['idencuesta'];
$fechaenvio1 = obtenerFechaEnvio($idencuesta);


$resultpruebas = obtenerResultadosPruebas($idlab, $idencuesta);

$fechaenvio = new DateTime($fechaenvio1);
//echo $fechaenvio;
$fecharecepcion = new DateTime($resultpruebas[0]['fecharecepcion']);
$interval = $fechaenvio->diff($fecharecepcion);
$tiempoenvio = $interval->format('%a');
//echo $interval->format('%a');

$fechaanalisis = new DateTime($resultpruebas[0]['fechaanalisis']);
$interval2 = $fechaanalisis->diff($fecharecepcion);
$tiempoanalisis = $interval2->format('%a');

$fechaingreso = new DateTime($resultpruebas[0]['fechaingreso']);
$interval3 = $fechaanalisis->diff($fechaingreso);
$tiempoingreso = $interval3->format('%a');

//echo $tiempoenvio, ' ', $tiempoanalisis, ' ' ,$tiempoingreso ; 

$a1 = array($tiempoenvio, $tiempoanalisis, $tiempoingreso);
//$a2 = array('Tiempo de Envio', 'Tiempo de Analisis', 'Tiempo de Ingreso');
//$chx = implode("|", $a2);
$chd = implode(",", $a1);

$st=$chd;

$vista = 'vistaGraficoEncuesta.tpl';

$template = $twig->loadTemplate("plantilla.tpl");
$template->display(array('logueado'=>$logueado,'url' => $url, 'vista' => $vista, 'rol' => $rol, 'st'=>$st));



/*
$a1 = array($tiempoenvio, $tiempoanalisis, $tiempoingreso);
$a2 = array('Tiempo de Envio', 'Tiempo de Analisis', 'Tiempo de Ingreso');
$chx = implode("|", $a2);
$chd = implode(",", $a1);

$pars = array(
    "http://chart.apis.google.com/chart?chs=920x150",
    "cht=bhs",
    "chxt=y,x",
    "chds=1,100",
    //"chds=0,160",
    "chxl=0:|" . $chx,
    "chtt=Encuesta ". $idencuesta,
    "chd=t:" . $chd,
    "chco=4D89F9,C6D9FD",
    "chm=R,C6555D,1,0,8|D,4D89F9,0,0,0",
    "chg=20,50,1,0"
);

$url = implode("&", $pars);



$vista = 'vistaGraficoEncuesta.tpl';

$template = $twig->loadTemplate("plantilla.tpl");
$template->display(array('logueado'=>$logueado,'url' => $url, 'vista' => $vista, 'rol' => $rol));

*/
/*


  foreach( $this->ventas as $venta ){
  $dia[] = $venta['dia'];
  $cant[] = $venta['cantidad'];
  }

  $chx = implode( "|", $dia );
  $chd = implode( ",", $cant );

  $pars = array(
  "http://chart.apis.google.com/chart?chs=1000x300",
  "cht=ls",
  "chxt=x,y",
  "chds=1,100",
  "chxl=0:|" . $chx . "|1:|0|50mil|100mil|150mil|200mil",
  "chtt=Ventas por Dia",
  "chd=t:" . $chd,
  "chm=D,C6D9FD,1,0,8|D,4D89F9,0,0,4",
  "chg=20,50,1,0"
  );

  $url = implode( "&", $pars );

  ?>
  <table border=1 align="center">
  <tr>
  <td>
  <img src="<?php echo $url ?>" alt="Ventas por Dia"/>
  </td>
  </tr>
  </table> */
?>
 