<?php //controlador

include('cfgTwig.php');
include('../modelo/modelo.php');
include ('verificarSesion.php');
	$rol=nombreRol($_SESSION['miSession']['rol']);
	
	if ($rol=='personalLAB'){
		$user= $_SESSION['miSession']['usuario'];
		$idlab = obteneridLaboratorio($user);
		$laboratorio= obtenerInfoLab($idlab);
		$tiposPruebas = obtenerTiposPruebas();
		$vista='vistaModificarLaboratorio.tpl';
                $template = $twig->loadTemplate("plantilla.tpl"); 
                $template->display(array('logueado'=>$logueado,'tiposPruebas' => $tiposPruebas,'laboratorio'=>$laboratorio,'vista' => $vista,'rol'=>$rol ));
	}else{
		// No tiene el rol para realizar la modificacion
            $template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
            $template->display();
	}
	
?>