<?php
include('cfgTwig.php');
include('../modelo/modelo.php');
include ('verificarSesion.php'); // Verifica que el usuario haya iniciado sesion

$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol == "admin") {
    if (!isset($_POST['envioAnalitos'])) {
        $analitos = obtenerAnalitos();
        $vista = "vistaAltaAnalitos.tpl";
        $ar=array('vista'=>$vista,'analitos' => $analitos, 'rol' => $rol, 'logueado' => $logueado);
        $template = $twig->loadTemplate("plantilla.tpl");
        $template->display($ar);
    }
    // Se realiza la operacion de insercion en la bd
    else {


        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];


        if (!existeAnalito($codigo)) {

            altaAnalito($nombre, $codigo);
            $msj = "Alta Analito Exitosa";
        } else {
            $msj = 'Ya existe el codigo de analito a insertar';
        }
        $vista = "vistaAltaAnalitos.tpl";
        $analitos = obtenerAnalitos();
        $ar = array('vista'=>$vista,'analitos' => $analitos, 'rol' => $rol, 'codigo' => $codigo, 'nombre' => $nombre, 'logueado' => $logueado,'msj'=>$msj);
        $template = $twig->loadTemplate("plantilla.tpl");
        $template->display($ar);
        
        $_POST[] = "";
    }
   

} else {
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl");
    $template->display();
}
?>