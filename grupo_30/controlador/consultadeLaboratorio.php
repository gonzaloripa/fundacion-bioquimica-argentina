<?php //consulta de un un solo laboratorio
include('cfgTwig.php');
include('../modelo/modelo.php');
include ('verificarSesion.php');
$rol=nombreRol($_SESSION['miSession']['rol']);
	if ($rol=="personalLAB"){
		//$msj="No tiene permiso para realizar esta accion";
		$template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
                $template->display(); 
		exit();	 
	}
	$pLab=$_GET['consulta'];
	$laboratorio= obtenerInfoLab($pLab);
	//$tiposPruebas = obtenerTiposPruebas();
	$tiposPruebasSeleccionados = TiposPruebasSelec($pLab);
	$vista='vistaconsultadeLaboratorio.tpl';
	$template = $twig->loadTemplate("plantilla.tpl"); 
        $template->display(array('logueado'=>$logueado,'laboratorio'=>$laboratorio,'tiposPruebasSeleccionados'=>$tiposPruebasSeleccionados,'vista' => $vista,'rol'=>$rol ));
?>