<?php
include('../modelo/modelo.php');
include('cfgTwig.php');
include ('verificarSesion.php');
$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol == 'personalLAB') {
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
    $template->display();
    exit();
}
if(!isset($_POST['envioresultadoencuesta'])) {
       $vista='vistaInicialEncuesta.php';
        $template = $twig->loadTemplate("plantilla.tpl"); 
        $template->display(array('logueado'=>$logueado,'rol' => $rol,'vista'=>$vista));
        include ('../vista/plantilla.php');
}else{  
    $metodos=$_POST['metodo'];
    $calibradores=$_POST['calibrador'];
    $reactivos=$_POST['reactivo'];
    $muestra1 = $_POST['idmuestra1'];
    $muestra2=$_POST['idmuestra2'];
    $descripcionm1=$_POST['descripcionm1'];
    $descripcionm2=$_POST['descripcionm2'];
    $papelesdefiltro=$_POST['papeldefiltro'];
    $valorescortes=$_POST['valorcorte'];
    $comentario=$_POST['comentarios'];
    $diai=$_POST['dia_ini'];
    $mesi=$_POST['mes_ini'];
    $anoi=$_POST['fechainicio'];
    $fechainicio=$anoi.'-'.$mesi.'-'.$diai;
    $diaf=$_POST['dia_fin'];
    $mesf=$_POST['mes_fin'];
    $anof=$_POST['fechafin'];
    $fechafin=$anof.'-'.$mesf.'-'.$diaf;
    $resultadosm1=$_POST['resultadom1'];
    $decisionesm1=$_POST['decisionm1'];
    $interpretacionesm1=$_POST['interpretacionm1'];
    $resultadosm2=$_POST['resultadom2'];
    $decisionesm2=$_POST['decisionm2'];
    $interpretacionesm2=$_POST['interpretacionm2'];
    
    $analitosexistentes = obtenerAnalitos();
    insertarEncuesta($fechainicio,$fechafin);
    $idencuesta=obtenerEncuesta($fechainicio,$fechafin);
    
    insertarMuestra($muestra1,$descripcionm1,$idencuesta);
    insertarMuestra($muestra2,$descripcionm2,$idencuesta);
    
    //$muestras = obtenerIdMuestras($idencuesta);
    foreach ($analitosexistentes as $an) {
       $idanalito=$an['idanalito'];
       insertarResultadoPrueba(NULL,$idencuesta,$idanalito,$metodos[$idanalito],$calibradores[$idanalito],$reactivos[$idanalito],$papelesdefiltro[$idanalito],$valorescortes[$idanalito],$comentario[$idanalito],'0000-00-00','0000-00-00','0000-00-00');
    
       $idResP=obtenerResultadoPruebaNull($idencuesta,$idanalito);
        
       insertarResultadoMuestra2($muestra1,$muestra2,$idResP,$resultadosm2[$idanalito],$decisionesm2[$idanalito],$interpretacionesm2[$idanalito]);     
              
    } 
    $msj="Alta de Resultado Exitoso";
    $template = $twig->loadTemplate("plantilla.tpl"); 
    $template->display(array('logueado'=>$logueado,'rol' => $rol,'msj'=>$msj));
}
?>