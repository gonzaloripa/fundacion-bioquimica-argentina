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
$analitos1=obtenerLaboratorios1();
$analitosvarios=obtenerLaboratoriosVarios();
$vista='vistaLaboratoriosInscriptos.tpl';
$template = $twig->loadTemplate("plantilla.tpl"); 
$template->display(array('logueado'=>$logueado,'analitos1' => $analitos1,'vista' => $vista,'rol'=>$rol,'analitosvarios' => $analitosvarios ));
?>