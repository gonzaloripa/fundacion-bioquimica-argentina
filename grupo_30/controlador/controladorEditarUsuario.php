<?php

include('../modelo/modelo.php');
include('cfgTwig.php');
include('verificarSesion.php');
$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol == 'admin') {
    $vista = 'vistaEditarUsuario.tpl';
    $lab = traeLabs();
    $roles = traeRoles();
    $template = $twig->loadTemplate("plantilla.tpl"); 
    $template->display(array('logueado'=>$logueado,'lab' => $lab,'roles'=>$roles,'vista' => $vista,'rol'=>$rol ));
} else {
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
    $template->display();
}
?>