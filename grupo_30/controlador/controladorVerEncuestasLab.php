<?php
include('cfgTwig.php');
include('../modelo/modelo.php');
include ('verificarSesion.php');
$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol == 'personalFBA') {
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
    $template->display();
    exit();
}
 $idLaboratorio=obteneridLaboratorio($_SESSION['miSession']['usuario']);
 $encuestas=obtenerEncuestasLab($idLaboratorio);
 $vista="vistaConsultaEncuestasLab.tpl";
 $template = $twig->loadTemplate("plantilla.tpl"); 
 $template->display(array('logueado'=>$logueado,'encuestas' => $encuestas,'idlaboratorio'=>$idLaboratorio,'vista' => $vista,'rol'=>$rol ));
    
?>