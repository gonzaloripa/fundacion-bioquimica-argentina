<?php

include('cfgTwig.php');
include('../modelo/modelo.php');
include ('verificarSesion.php');
$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol == 'admin') {
    $idusuario = $_GET["borrar"];
    if ($idusuario != $_SESSION['miSession']['idusuario']) {
        borrarUsuario($idusuario);
        $usuarios = obtenerUsuarios();
        $msj = 'borrado exitoso';
        $vista = 'vistaConsultaUsuarios.tpl';
        $template = $twig->loadTemplate("plantilla.tpl"); 
        $template->display(array('logueado'=>$logueado,'msj'=>$msj,'usuarios' => $usuarios,'vista' => $vista,'rol'=>$rol ));
    } else {
        $msj = 'No puede borrarse a si mismo';
        $template = $twig->loadTemplate("plantilla.tpl"); 
        $template->display(array('msj'=>$msj,'vista' => $vista,'rol'=>$rol,'logueado'=>$logueado ));
    }
} else {
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl");
    $template->display();
}
?>