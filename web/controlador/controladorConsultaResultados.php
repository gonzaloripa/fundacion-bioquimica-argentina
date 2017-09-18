<?php


session_start();
error_reporting(E_ALL & ~E_NOTICE);
include('../modelo/modelo.php');
include ('verificarSesion.php');
include('cfgTwig.php');
$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol == 'personalLAB') {
    include('../vista/vistaErrorPermisos.php');
    exit();
}


$idencuesta=$_GET['idencuesta'];
$resultados=obtenerResultadosEncuestas($idencuesta);
$vista='vistaResultadosEncuestas.tpl';
$template = $twig->loadTemplate("plantilla.tpl"); 
$template->display(array('logueado'=>$logueado,'resultados' => $resultados,'vista' => $vista,'rol'=>$rol ));
?>
