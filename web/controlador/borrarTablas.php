<?php 
include('cfgTwig.php');
include('../modelo/modelo.php');
include ('verificarSesion.php');
	
        $rol=nombreRol($_SESSION['miSession']['rol']);
	if ($rol== 'admin' ){
		switch ($_GET['seBorra']) {
			case 'metodo':
				$idmetodo=$_GET['borrar'];
				bajaMetodo($idmetodo);
				$msj= "Baja Metodo Exitosa";
				
				break;
			case 'reactivo':
				$idreactivo=$_GET['borrar'];
				bajaReactivo($idreactivo);
				$msj= "Baja Reactivo Exitosa";
								
				
				break;
			case 'calibrador':
				$idcalibrador=$_GET['borrar'];
				bajaCalibrador($idcalibrador);
				$msj= "Baja Calibrador Exitosa";
							
				
				break;
			case 'papelFiltro':
				$idpapelFiltro=$_GET['borrar'];
				bajaPapelFiltro($idpapelFiltro);
				$msj= "Baja Papel Filtro Exitosa";
								
				
				break;
			case 'interpretacion':
				$idinter=$_GET['borrar'];
				bajaInterpretacion($idinter);
				$msj= "Baja Interpretacion Exitosa";
								
				
				
				break;
			case 'decision':
				$iddecision=$_GET['borrar'];
				bajaDecision($iddecision);
				$msj= "Baja Decision Exitosa";
								
				
				break;
		}
		$idan=$_GET['analito'];
		$codigoAn=obtenerCodigoAnalito($idan);
		$metodos= obtenerMetodosid($idan);
		$reactivos= obtenerReactivosid($idan);
		$calibradores= obtenerCalibradoresid($idan);
		$papelesFiltro= obtenerPapelesdeFiltro($idan);
		$interpretaciones= obtenerInterpretacionesControl($idan);
		$decisiones= obtenerDecisionesControl($idan);
			
		$vista='vistaAltaTablas.tpl'; 
		$template = $twig->loadTemplate("plantilla.tpl"); 
                $template->display(array('logueado'=>$logueado,'metodos' => $metodos,'reactivos' => $reactivos,'calibradores' => $calibradores,'papelesFiltro' => $papelesFiltro,'interpretaciones' => $interpretaciones,'decisiones' => $decisiones,'vista' => $vista,'rol'=>$rol, 'codigoAn'=>$codigoAn ));
			
			
	}
		
	
	else{
		$template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
                $template->display();			
	}
?>