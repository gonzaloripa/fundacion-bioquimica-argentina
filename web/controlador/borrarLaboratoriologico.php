<?php 
include('cfgTwig.php');
include('../modelo/modelo.php');
include ('verificarSesion.php');
	
        $rol=nombreRol($_SESSION['miSession']['rol']);
	if ($rol!= 'personalLAB' ){
		
		$lab=$_GET['borrar'];
		$estado=obtenerEstado($lab);
		if ($estado=='activo'){
			bajaLab($lab); // se le da de baja seteando el estado en inactivo
			$fecha_actual = date('Y-m-d');
			//$fingreso= fechaIngresoLab($lab);
                        //echo $fingreso;
			$idultimaencuesta= ultimaEncuesta();
			//echo $idultimaencuesta['idencuesta'];
                        if(count($idultimaencuesta)==0){
                            $idultimaencuesta=NULL;   
                        }else{
                            $idultimaencuesta=$idultimaencuesta['idencuesta'];
                        }
			$accion = 'baja';
			almacenarhistorial($lab,$idultimaencuesta,$fecha_actual,$accion);
			$msj= 'Laboratorio Borrado';
			//print $msj;
                        if($rol=='admin'){
                                $tablalabs=obtenerLaboratorios();                       
                        }else{
                                $tablalabs=  obtenerLaboratoriosActivos();
                        }			
			$vista='vistaConsultaLaboratorio.tpl'; 
			$template = $twig->loadTemplate("plantilla.tpl"); 
                        $template->display(array('tablalabs' => $tablalabs,'vista' => $vista,'rol'=>$rol,'msj'=>$msj,'logueado'=>$logueado));
		}else{
			$msj= 'El laboratorio ya se encuentra en estado inactivo';
			//print $msj;
			$tablalabs=obtenerLaboratorios();                        
			$vista='vistaConsultaLaboratorio.tpl'; 
			$template = $twig->loadTemplate("plantilla.tpl"); 
                        $template->display(array('tablalabs' => $tablalabs,'vista' => $vista,'rol'=>$rol,'msj'=>$msj,'logueado'=>$logueado ));
			
		}
		
			
	}else{
		$template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
                $template->display();			
	}
?>