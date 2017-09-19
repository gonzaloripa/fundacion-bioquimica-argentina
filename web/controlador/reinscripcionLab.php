<?php

include('cfgTwig.php');
include('../modelo/modelo.php');
include ('verificarSesion.php');
$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol == "personalLAB") {
    //$msj="No tiene permiso para realizar esta accion";
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl");
    $template->display();
    exit();
}
$idlaboratorio = $_GET['reinscribir'];
$fecha_actual = date('Y-m-d');
$estado = "activo";
$accion = "alta";
reinscribirLab($idlaboratorio);
$idultimaencuesta = ultimaEncuesta();
$idultimaencuesta = $idultimaencuesta['idencuesta'];
almacenarhistorial($idlaboratorio, $idultimaencuesta, $fecha_actual, $accion);
$msj = "Reinscripcion exitosa";
$labinactivos = ObtenerLabsInactivos();
$vista = 'vistaLaboratoriosInactivos.tpl';
$template = $twig->loadTemplate("plantilla.tpl");
$template->display(array('logueado'=>$logueado,'labinactivos' => $labinactivos, 'vista' => $vista, 'rol' => $rol,'msj'=>$msj));
?>