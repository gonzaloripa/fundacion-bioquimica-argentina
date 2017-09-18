<?php
include('../modelo/modelo.php');
include('cfgTwig.php');
include('verificarSesion.php');
$rol=nombreRol($_SESSION['miSession']['rol']);	
if($rol=='personalLab'){
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
    $template->display();
   exit();
}
$idlab = $_GET['laboratorio'];
$encuestas = obtenerEncuestas($idlab);

$vista='vistaVerGraficoEncuesta.tpl';
$template = $twig->loadTemplate("plantilla.tpl"); 
$template->display(array('logueado'=>$logueado,'encuestas' => $encuestas,'idlab' => $idlab,'vista' => $vista,'rol'=>$rol ));


?>

    <?php
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
26  <table border=1 align="center">
27   <tr>
28    <td>
29     <img src="<?php echo $url ?>" alt="Ventas por Dia"/>
30    </td>
31   </tr>
32  </table>
*/
?>