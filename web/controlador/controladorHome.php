<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
include('../modelo/modelo.php');
include('cfgTwig.php');
//include('verificarSesion.php');

/*
  if (isset($_SESSION['miSession'])){
  $miSession=$_SESSION['miSession'];
  $msj="logueado";
  $userIngresado=$_SESSION['miSession']['usuario'];
  $passIngresado=$_SESSION['miSession']['contrasena'];
  }else{

  }
 */
if (isset($_SESSION['logueado'])) {
    
    $logueado = 'true';
    $rol = nombreRol($_SESSION['miSession']['rol']);
    $template = $twig->loadTemplate("plantilla.tpl"); 
    $template->display(array('rol'=>$rol,'logueado'=>$logueado ));
    exit();
}
if (isset($_POST['user']) and isset($_POST['pass'])) {

    $userIngresado = strip_tags($_POST['user']);
    $passIngresado = strip_tags($_POST['pass']);
    if (validarDatos($userIngresado, $passIngresado)) {
        if (validarLabInactivo($userIngresado)){
            $msj = 'Su laboratorio se encuentra inactivo';
            $template = $twig->loadTemplate("plantilla.tpl"); 
            $template->display(array('rol'=>$rol,'msj'=>$msj,'logueado'=>$logueado ));
            exit();
        }
        $logueado = 'true';
        $_SESSION['logueado'] = true;
        $_SESSION['miSession'] = asignaDatosSesion($userIngresado, $passIngresado);
        $rol = nombreRol($_SESSION['miSession']['rol']); // Traer el Rol
       
      
        $template = $twig->loadTemplate("plantilla.tpl"); 
        $template->display(array('rol'=>$rol,'logueado'=>$logueado ));
        exit();
    } else {
        $msj = 'Usuario o contraseña incorrectos';
        $template = $twig->loadTemplate("vistaLogin.tpl"); 
        $template->display(array('msj'=>$msj,'logueado'=>$logueado ));
        exit();
        
    }
} else {
    $msj = 'Debe ingresar el Usuario y contraseña';
    $template = $twig->loadTemplate("vistaLogin.tpl"); 
    $template->display(array('msj'=>$msj ));
    exit();
}
/*
  if($msj=="Bienvenido!" or $msj=="logueado"){
  $_SESSION['miSession']=asignaDatosSesion($userIngresado,$passIngresado);
  if(logueadoConRol($_SESSION['miSession'],1)){
  include('../vistas/vistaHomeAdmin.php');
  }else{
  if(logueadoConRol($_SESSION['miSession'],2)){
  include('../vistas/vistaHomeFBA.php');
  }else{
  if(logueadoConRol($_SESSION['miSession'],3)){
  include('../vistas/vistaHomeLab.php');
  }
  }
  }
  }else{
  if ($msj=="No se encontr&oacute; la combinaci&oacute;n de correo y contrase&ntilde;a ingresados"){
  include('../vistas/vistaLogin.php');
  }else{
  include('../vistas/vistaErrorLoguearse.php');
  }
  }
 */
?>