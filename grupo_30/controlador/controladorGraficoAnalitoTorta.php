<?php

include('../modelo/modelo.php');
include('cfgTwig.php');
include ('verificarSesion.php');
$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol == 'personalLAB') {
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
    $template->display();
    exit();
}
$idenc=$_GET['idencuesta'];
$idanalito = $_GET['idanalito'];
$fechafin = obtenerFechaFinEcuesta($idenc);
$encuestastotales = obtenerCantidadEncuestas ($fechafin);
$encuestascontestadas = obtenerCantidadContestadasA ($fechafin,$idanalito);
$encuestasnocontestadas = $encuestastotales - $encuestascontestadas;



$vista='vistaGraficoTorta.tpl';
$template = $twig->loadTemplate("plantilla.tpl"); 
$template->display(array('logueado'=>$logueado,'vista' => $vista,'rol'=>$rol, 'encuestastotales'=>$encuestastotales, 'encuestascontestadas'=>$encuestascontestadas, 'encuestasnocontestadas'=>$encuestasnocontestadas));
?>