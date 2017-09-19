<?php

include('cfgTwig.php');

include('../modelo/modelo.php');
include ('verificarSesion.php');
//$usuario= $_SESSION['usuario'];
//$rol= devolverRol($usuario);
$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol == "personalFBA") {
    // No tiene el rol para realizar la modificacion
    //$msj="NO TIENE PERMISO";
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
    $template->display();
    exit();
}

if (!isset($_POST['modificarenvio'])) {

    if ($rol == "admin") {
        $laboratorio = obtenerInfoLab($_GET['modificar']);
        $tiposPruebas = obtenerTiposPruebas();
        $vista = 'vistaModificarLaboratorio.tpl';
        $template = $twig->loadTemplate("plantilla.tpl"); 
        $template->display(array('logueado'=>$logueado,'laboratorio' => $laboratorio,'tiposPruebas'=>$tiposPruebas,'vista' => $vista,'rol'=>$rol ));
    } elseif ($rol == "personalLAB") {
        $usuario = $_SESSION['miSession']['usuario'];

        $idlab = obteneridLaboratorio($usuario);
        $laboratorio = obtenerInfoLab($idlab);
        $tiposPruebas = obtenerTiposPruebas();
        $vista = 'vistaModificarLaboratorio.tpl';
        $template = $twig->loadTemplate("plantilla.tpl"); 
        $template->display(array('logueado'=>$logueado,'laboratorio' => $laboratorio,'tiposPruebas'=>$tiposPruebas,'vista' => $vista,'rol'=>$rol ));
        exit();
    }
}
if (isset($_POST['modificarenvio'])) {
    // Se realiza la operacion de insercion en la bd
    /// SACAR 
    ///
    $codigo = $_POST['codigo'];
    $institucion = $_POST['institucion'];
    $sector = $_POST['sector'];
    $responsable = $_POST['responsable'];
    $domicilio = $_POST['domicilio'];
    $domiciliocorresp = $_POST['domicilio_corresp'];
    $ciudad = $_POST['ciudad'];
    $pais = $_POST['pais'];
    $codigopostal = $_POST['codigopostal'];
    $tipoPrueba = $_POST['prueba']; //lista con tipos de prueba
    $email = $_POST['email'];
    $telfax = $_POST['telfax'];
    $tipolab = $_POST['tipolab'];
    $empresa = $_POST['empresa'];
    $tiposPruebas = obtenerTiposPruebas();



    if (count($tipoPrueba) == 0 || $tipolab == null || $pais == null) {
        $msj = 'Campos obligatorios: tipos de prueba y tipos de laboratorio';

        //$vista='vistaModificarLaboratorio.php';
        $template = $twig->loadTemplate("plantilla.tpl"); 
        $template->display(array('logueado'=>$logueado,'msj'=>$msj,'rol'=>$rol ));
        exit();
    }
    $ok = false;
    $estado = 'activo';
    modificarLaboratorio($codigo, $institucion, $sector, $responsable, $domicilio, $domiciliocorresp, $ciudad, $pais, $codigopostal, $email, $telfax, $empresa, $tipolab, $tipoPrueba);

    $msj = "Modificacion Exitosa";

        $template = $twig->loadTemplate("plantilla.tpl"); 
        $template->display(array('logueado'=>$logueado,'msj'=>$msj,'rol'=>$rol ));
}
?>