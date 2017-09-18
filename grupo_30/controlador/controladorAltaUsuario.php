<?php
include('../modelo/modelo.php');
include('cfgTwig.php');
include('verificarSesion.php');
$rol=nombreRol($_SESSION['miSession']['rol']);	
if($rol=='admin'){
	$lab=traeLabs();
	$roles=traeRoles();
	$vista='vistaAltaUsuario.tpl';
	$template = $twig->loadTemplate("plantilla.tpl"); 
        $template->display(array('logueado'=>$logueado,'lab'=>$lab,'roles'=>$roles,'vista' => $vista,'rol'=>$rol ));
}else{
	$template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
        $template->display(); 
}
?>