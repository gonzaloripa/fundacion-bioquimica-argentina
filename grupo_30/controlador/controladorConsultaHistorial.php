<?php

include('cfgTwig.php');
include('../modelo/modelo.php');
include ('verificarSesion.php');
$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol == 'admin') {
    $historial = obtenerHistorial();
    $vista = 'vistaConsultaHistorial.tpl';
    $template = $twig->loadTemplate("plantilla.tpl"); 
    $template->display(array('logueado'=>$logueado,'historial' => $historial,'vista' => $vista,'rol'=>$rol ));
} else {
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
    $template->display();
}
?>