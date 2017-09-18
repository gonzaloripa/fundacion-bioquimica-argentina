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
$laboratorios=  obtenerLaboratoriosOrdenado();
$vista='vistaLabsImpresion.tpl';
$template = $twig->loadTemplate("plantilla.tpl"); 
$template->display(array('logueado'=>$logueado,'laboratorios' => $laboratorios,'vista' => $vista,'rol'=>$rol,'logueado'=>$logueado ));

?>
