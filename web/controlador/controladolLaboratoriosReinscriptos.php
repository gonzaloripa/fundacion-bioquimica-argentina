<?php
include('../modelo/modelo.php');
include('cfgTwig.php');
include('verificarSesion.php');
$rol=nombreRol($_SESSION['miSession']['rol']);	
if($rol=='personalLab'){
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
    $template->display();
   exit();
}
$labsr=obtenerLaboratoriosReinscriptos();

$labs= Array();
foreach ($labsr as $value) {
    //echo estaActivo($value['idlaboratorio']) ;
    if(estaActivo($value['idlaboratorio'])){
        $labs[]=$value;
    }
}

$labsreinscriptos=$labs;

$vista='vistaLaboratoriosReinscriptos.tpl';
$template = $twig->loadTemplate("plantilla.tpl"); 
$template->display(array('logueado'=>$logueado,'vista' => $vista,'rol'=>$rol,'labsreinscriptos'=>$labsreinscriptos ));

?>