<?php
include('../modelo/modelo.php');
include('cfgTwig.php');
include('verificarSesion.php');
$rol=nombreRol($_SESSION['miSession']['rol']);	
if($rol=='admin'){
	//CAMPOS NO OBLIGATORIOS:

	//CAMPOS OBLIGATORIOS:
				$error="";
	/*USUARIO*/	$errorUsuario=false;
				if (isset($_POST['usuario'])){
						$puede=traerUsuario(strip_tags($_POST['usuario']);
						if($puede){	
							$usuario=strip_tags($_POST['usuario']);
						}else{
							$msj="Ya existe un usuario con ese nombre de usuario";
							$errorUsuario=true;
						}
				}else{
					$msj="Complete el campo usuario";
					$errorUsuario=true;
				}
	/*CONTRASE�A*/$errorPass=false;
				if (isset($_POST['contrasena'])){
						$contrasena=strip_tags($_POST['contrasena']);
				}else{
					$msj="Complete el campo contraseña";
					$errorPass=true;
				}
	/*ROL*/		$errorRol=false;
				if (isset($_POST['idRol'])){
						if($_POST['idRol']==0){
						$errorRol=true;
						$msj="Seleccione un Rol";}
						else $idRol=$_POST['idRol'];
				}else{
					$msj="Seleccione un Rol";
					$errorRol=true;
				}
				
				if (!$errorUsuario and !$errorPass and !$errorRol){
                                        $idLab=$_POST['idlab'];
                                        if($_POST['idRol']!=2){
                                            $idLab=NULL;
                                        }

                                        
                                        $email=strip_tags($_POST['email']);
                                        $nombre=strip_tags$_POST(['nombre']);
                                        $apellido=strip_tags$_POST(['apellido']);
                                                                                
					insertarUsuario($usuario,$contrasena,$idRol,$nombre,$apellido,$email,$idLab);
					$msj="Se ha insertado el nuevo usuario con éxito!";
				}
	
	
				//$vista='vistaAltaUsuario.php';
				$template = $twig->loadTemplate("plantilla.tpl"); 
                                $template->display(array('logueado'=>$logueado,'msj'=>$msj,'rol'=>$rol ));
}else{
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
    $template->display();
}
?>