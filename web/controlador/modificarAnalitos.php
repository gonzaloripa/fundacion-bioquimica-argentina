<?php 
include('cfgTwig.php');
include_once('../modelo/modelo.php');
include ('verificarSesion.php');
	
        $rol=nombreRol($_SESSION['miSession']['rol']);
	if ($rol== 'admin' ){
	 	if(isset($_POST['modenvioan'])){
			
				$codigo=$_POST['codigo'];
				$nombre=$_POST['nombre'];
				$codviejo=$_POST['codviejo'];
				$nomviejo=$_POST['nomviejo'];

                                
                                if((!existeAnalito($codigo))or ($codigo==$codviejo and $nombre!=$nomviejo)){
                                    modificarAnalito($nombre,$codigo,$codviejo);
                                    $msj= "Modificacion Analito Exitosa ";
                                    $codviejo=$codigo;
                                    $nomviejo=$nombre;
                                }
                                elseif( $codigo==$codviejo and $nombre==$nomviejo ){
                                    
                                    $msj="Se debe modificar algun campo ";
                                }else{
                                    
                                    $msj= "Ya existe el codigo de analito ".$codigo.". Ingrese un codigo que no exista o cambie solo el nombre";
                                    $codigo=$codviejo;
                                    $nombre=$nomviejo;
                                }
                                
				
				
				$vista='vistaModAnalitos.tpl';
		 		$template = $twig->loadTemplate("plantilla.tpl"); 
                                $template->display(array('logueado'=>$logueado,'codigo'=>$codigo,'codviejo'=>$codviejo,'nombre'=>$nombre,'vista' => $vista,'rol'=>$rol ));
				
		  		
		}
	
	    elseif($_GET['seCambia']=='analito') {
				
				$codigo=$_GET['modcodigo'];
                                $codviejo=$_GET['modcodigo'];
                                $nombre=$_GET['modnombre'];
				  
				
				$vista='vistaModAnalitos.tpl';
		 		$template = $twig->loadTemplate("plantilla.tpl"); 
                                $template->display(array('logueado'=>$logueado,'codigo'=>$codigo,'codviejo'=>$codviejo,'nombre'=>$nombre,'vista' => $vista,'rol'=>$rol ));
		}
	}
		
	else{
		$template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
                $template->display(); 			
	}
?>
