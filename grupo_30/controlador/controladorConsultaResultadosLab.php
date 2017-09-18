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
$idencuesta=$_GET['ide'];
//echo $_GET['idl'];
if ($_GET['idl']==null || $_GET['idl']==''){
    $idlaboratorio=NULL;
}else{
    $idlaboratorio=$_GET['idl'];
}
    $analitos=obtenerIDAnalitos($idencuesta,$idlaboratorio); //
	$analitosFBA=ObtenerAnalitosNull($idencuesta);
    foreach ($analitosFBA as $an){
        $anaFBA[$an['idanalito']]= $an;
    }
$vista='vistaResultadosAnalitosLab.tpl';
$template = $twig->loadTemplate("plantilla.tpl"); 
$template->display(array('analitos'=>$analitos,'anaFBA'=>$anaFBA,'logueado'=>$logueado,'vista' => $vista,'rol'=>$rol));


?>