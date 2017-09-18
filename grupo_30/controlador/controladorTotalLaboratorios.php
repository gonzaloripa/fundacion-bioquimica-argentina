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
$tablalabs=obtenerLaboratoriosOrdenado();
$vista='vistaTotalLaboratorios.tpl';
$template = $twig->loadTemplate("plantilla.tpl"); 
$template->display(array('logueado'=>$logueado,'vista' => $vista,'rol'=>$rol,'tablalabs'=>$tablalabs ));

?>