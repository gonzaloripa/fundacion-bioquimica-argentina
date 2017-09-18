<?php

include('cfgTwig.php');
include('../modelo/modelo.php');
include ('verificarSesion.php');
$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol != 'personalLAB') {
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
    $template->display();
    exit();
}
$fa= date('Y-m-d');
$encuestas=encuestaActivas($fa);
$vista = 'vistaEncuestasDisponibles.tpl';
$template = $twig->loadTemplate("plantilla.tpl"); 
$template->display(array('logueado'=>$logueado,'encuestas' => $encuestas,'vista' => $vista,'rol'=>$rol ));
?>

