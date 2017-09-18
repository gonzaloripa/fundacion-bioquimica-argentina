<?php
include('../modelo/modelo.php');
include('cfgTwig.php');
include ('verificarSesion.php');
$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol == 'personalFBA') {
     $template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
     $template->display();
    exit();
}
if(!isset($_POST['envioresultado'])) {
    $idlab = $_SESSION['miSession']['idlaboratorio'];

    $analitoselegidos = obtenerAnalitosPar($idlab);
    $analitoselegidos2 = obtenerAnalitosPar($idlab);
    $idencuesta = $_GET['idencuesta'];
    $muestras = obtenerIdMuestras($idencuesta);

    foreach ($analitoselegidos as $an) {
        //echo $an['nombre'];
        $metodos[$an['idanalito']] = obtenerMetodosid($an['idanalito']);
        $reactivos[$an['idanalito']] = obtenerReactivosid($an['idanalito']);
        $calibrador[$an['idanalito']] = obtenerCalibradoresid($an['idanalito']);
        $papeldefiltro[$an['idanalito']] = obtenerPapelesdeFiltro($an['idanalito']);
        $valordecorte[$an['idanalito']] = obtenerValoresdeCorte($an['idanalito']);
        $decisioncontrol[$an['idanalito']] = obtenerDecisionesControl($an['idanalito']);
        $interpretacioncontrol[$an['idanalito']] = obtenerInterpretacionesControl($an['idanalito']);
         $decisioncontrol2[$an['idanalito']] = obtenerDecisionesControl($an['idanalito']);
        $interpretacioncontrol2[$an['idanalito']] = obtenerInterpretacionesControl($an['idanalito']);
        
    }
    $vista = 'vistaAltaResultado.tpl';
    $template = $twig->loadTemplate("plantilla.tpl"); 
    $template->display(array('logueado'=>$logueado,'muestras'=>$muestras,'idencuesta'=>$idencuesta,'analitoselegidos2'=>$analitoselegidos2,'metodos'=>$metodos,'reactivos'=>$reactivos,'calibrador'=>$calibrador,'papeldefiltro'=>$papeldefiltro,'decisioncontrol'=>$decisioncontrol,'interpretacioncontrol'=>$interpretacioncontrol,'decisioncontrol2'=>$decisioncontrol2,'interpretacioncontrol2'=>$interpretacioncontrol2,'vista' => $vista,'rol'=>$rol ));
}else{
    $idlab = $_SESSION['miSession']['idlaboratorio'];
    $idencuesta = $_POST['idencuesta'];
    
    $metodos=$_POST['metodo'];
    $calibradores=$_POST['calibrador'];
    $reactivos=$_POST['reactivo'];
    $papelesdefiltro=$_POST['papeldefiltro'];
    $valorescortes=$_POST['valorcorte'];
    $comentario=$_POST['comentarios'];
    $fecharecepcion=$_POST['ano_recep']."-".$_POST['mes_recep']."-".$_POST['dia_recep'];
    $fechaanalisis=$_POST['ano_analisis']."-".$_POST['mes_analisis']."-".$_POST['dia_analisis'];
    $fecharesultados=$_POST['ano_res']."-".$_POST['mes_res']."-".$_POST['dia_res'];
    $resultadosm1=$_POST['resultadom1'];
    $decisionesm1=$_POST['decisionm1'];
    $interpretacionesm1=$_POST['interpretacionm1'];
    $resultadosm2=$_POST['resultadom2'];
    $decisionesm2=$_POST['decisionm2'];
    $interpretacionesm2=$_POST['interpretacionm2'];

    $muestras = obtenerIdMuestras($idencuesta);
    $analitoselegidos = obtenerAnalitosPar($idlab);
    $analitoselegidos2 = obtenerAnalitosPar($idlab);

        if(existeResultado($idlab,$idencuesta)){
            $msj="Ya existe resultado cargado para esa prueba";
            $template = $twig->loadTemplate("plantilla.tpl"); 
            $template->display(array('msj'=>$msj,'rol'=>$rol,'logueado'=>$logueado));
            exit();
        }  
    foreach ($analitoselegidos as $an) { 
       $idanalito=$an['idanalito'];
       
       insertarResultadoPrueba($idlab,$idencuesta,$idanalito,$metodos[$idanalito],$calibradores[$idanalito],$reactivos[$idanalito],$papelesdefiltro[$idanalito],$valorescortes[$idanalito],$comentario[$idanalito],$fecharecepcion,$fechaanalisis,$fecharesultados);
       $idResP=obtenerResultadoPrueba($idlab,$idencuesta,$idanalito);
        insertarResultadoMuestra2($muestras[0]['idmuestra'],$muestras[1]['idmuestra'],$idResP,$resultadosm2[$idanalito],$decisionesm2[$idanalito],$interpretacionesm2[$idanalito]);      
    } 
    $msj="Alta de Resultado Exitoso";
    $template = $twig->loadTemplate("plantilla.tpl"); 
    $template->display(array('msj' => $msj,'rol'=>$rol,'logueado'=>$logueado));
}
?>