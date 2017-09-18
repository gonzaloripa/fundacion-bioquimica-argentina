<?php

include('cfgTwig.php');
include('../modelo/modelo.php');
include ('verificarSesion.php');
$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol == 'personalFBA') {
    $tablalabs = obtenerLaboratoriosActivos();
    $vista = 'vistaConsultaLaboratorio.tpl';
    $template = $twig->loadTemplate("plantilla.tpl"); 
    $template->display(array('logueado'=>$logueado,'tablalabs' => $tablalabs,'vista' => $vista,'rol'=>$rol ));
} else {
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl");
    $template->display();
}
?>