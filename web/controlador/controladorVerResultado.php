<?php

include('cfgTwig.php');
include('../modelo/modelo.php');
include ('verificarSesion.php');
$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol == 'personalLAB') {
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
    $template->display();
    exit();
}
$idencuesta = $_GET['ide'];
//echo $_GET['idl'];
if ($_GET['idl'] == null || $_GET['idl'] == '') {
    $idlaboratorio = NULL;
    
} else {
    $idlaboratorio = $_GET['idl'];
    
}
if ($idlaboratorio == NULL) {
  
    
    $analitos = ObtenerAnalitosNull($idencuesta);
} else {
    $analitos = obtenerIDAnalitos($idencuesta, $idlaboratorio); //
    
}
$vista = 'vistaResultadosAnalitos.tpl';
$template = $twig->loadTemplate("plantilla.tpl"); 
$template->display(array('logueado'=>$logueado,'analitos' => $analitos,'vista' => $vista,'rol'=>$rol ));
?>