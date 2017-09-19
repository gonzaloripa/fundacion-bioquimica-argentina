<?php 
include('cfgTwig.php');
include('../modelo/modelo.php');
include ('verificarSesion.php');
	$rol=nombreRol($_SESSION['miSession']['rol']);
	if ($rol=="personalLAB"){
		$msj="No tiene permiso para realizar esta accion";
		$template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
                $template->display();
		exit();	 
	}
	$labinactivos= ObtenerLabsInactivos();
	$vista='vistaLaboratoriosInactivos.tpl';
	$template = $twig->loadTemplate("plantilla.tpl"); 
        $template->display(array('logueado'=>$logueado,'labinactivos' => $labinactivos,'vista' => $vista,'rol'=>$rol ));
	
?>
