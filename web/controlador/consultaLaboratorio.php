<?php 
include('cfgTwig.php');
include('../modelo/modelo.php');
include ('verificarSesion.php');
	//$usuario= $_SESSION['usuario'];
	//$rol= devolverRol($usuario);
	$rol=nombreRol($_SESSION['miSession']['rol']);
	if ($rol =='admin'){
		$tablalabs=obtenerLaboratorios();
		$vista='vistaConsultaLaboratorio.tpl';
		$template = $twig->loadTemplate("plantilla.tpl"); 
                $template->display(array('logueado'=>$logueado,'tablalabs'=>$tablalabs,'vista' => $vista,'rol'=>$rol ));
	}else{
		//$msj="no tiene permiso para consultar esto";	
		$template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
                $template->display(); 
	}
		

?>