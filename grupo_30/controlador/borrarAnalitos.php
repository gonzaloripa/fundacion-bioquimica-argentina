<?php 
include('cfgTwig.php');
include('../modelo/modelo.php');
include ('verificarSesion.php');
	
	$rol=nombreRol($_SESSION['miSession']['rol']);
	if ($rol== 'admin' ){
		
		$idanalito=$_GET['borrar'];
		bajaAnalito($idanalito);
		$msj= "Baja Analito Exitosa";
		$analitos= obtenerAnalitos();
	
		$vista='vistaAltaAnalitos.tpl'; 
		$template = $twig->loadTemplate("plantilla.tpl"); 
                $template->display(array('logueado'=>$logueado,'analitos' => $analitos,'vista' => $vista,'rol'=>$rol, 'codigo'=>$codigo, 'nombre'=>$nombre ));
			
			
	}
		
	
	else{
		$template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
                $template->display();			
	}
?>