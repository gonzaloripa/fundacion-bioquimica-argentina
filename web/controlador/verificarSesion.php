<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
 
if (!isset($_SESSION['logueado'])){
        $msj= "debe loguearse para acceder a dicha seccion";
		//$vista= "controladorLogin.php";
        
        $template = $twig->loadTemplate("plantilla.tpl"); 
        $template->display(array('logueado'=>$logueado,'msj' => $msj));
	exit();
	}
$logueado='true';
?>