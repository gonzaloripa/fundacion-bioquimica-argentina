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
$encuesta = $_GET['idencuesta'];
$analitos = obtenerAnalitos();

$vista='vistaListarAnalitosTorta.tpl';
$template = $twig->loadTemplate("plantilla.tpl"); 
$template->display(array('logueado'=>$logueado,'encuesta' => $encuesta,'vista' => $vista,'rol'=>$rol,'analitos' => $analitos ));


?>