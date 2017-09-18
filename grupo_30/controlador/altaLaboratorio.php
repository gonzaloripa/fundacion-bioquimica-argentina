<?php
include('cfgTwig.php');
include('../modelo/modelo.php');
include ('verificarSesion.php'); // Verifica que el usuario haya iniciado sesion
//$user= $_SESSION['usuario'];
//$rol= devolveRrol($usuario);
$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol == "personalLAB") {
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl");
    $template->display();
    exit();
}
if (!isset($_POST['altaenvio'])) {
    // si el rol es personalFBA o admin y se ingreso la opcion alta
    // Se muestra el formulario de alta
    $tiposPruebas = obtenerTiposPruebas();
    $encuestas = devolverEncuestas();
    $vista = 'vistaAltaLaboratorio.tpl';
    $template = $twig->loadTemplate("plantilla.tpl");
    $template->display(array('tiposPruebas' => $tiposPruebas, 'vista' => $vista, 'rol' => $rol,'encuestas'=>$encuestas,'logueado'=>$logueado));
} else {
    // Se realiza la operacion de insercion en la bd
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
    $estado = 'activo';
    $fechaingreso = date('Y-m-d');
    $ok = false;
    $tiposPruebas = obtenerTiposPruebas();
    //print ;

    if ($codigo == null || count($tipoPrueba) == 0 || $tipolab == null || $pais == null) {
        $msj = 'Campos obligatorios: codigo, tipos de prueba y tipos de laboratorio';

        $vista = 'vistaAltaLaboratorio.tpl';
        $template = $twig->loadTemplate("plantilla.tpl");
        $template->display(array('tiposPruebas' => $tiposPruebas, 'msj' => $msj, 'vista' => $vista, 'rol' => $rol,'logueado'=>$logueado));
        exit();
    }

    if ($pais == "Argentina") {
        if (is_numeric(substr($codigo, 0, 5)) && is_numeric(substr($codigo, 5, 4)) && strlen($codigo) == 9) {
            $ok = true;
        } else {
            if (ctype_alpha(substr($codigo, 0, 1)) && is_numeric(substr($codigo, 1, 4)) && strlen($codigo) == 5) {
                $ok = true;
            }
        }
    } else {
        if (ctype_alpha(substr($codigo, 0, 2)) && is_numeric(substr($codigo, 2, 4)) && strlen($codigo) == 5) {
            $ok = true;
        }
    }
    if (!$ok) {
        $msj = 'debe ingresar codigo de laboratorio valido';
        $vista = 'vistaAltaLaboratorio.tpl';
        $template = $twig->loadTemplate("plantilla.tpl");
        $template->display(array('tiposPruebas' => $tiposPruebas, 'msj' => $msj, 'vista' => $vista, 'rol' => $rol,'logueado'=>$logueado));
        exit();
    }

    if (!existeLab($codigo)) {

        insertarLaboratorio($codigo, $institucion, $sector, $responsable, $domicilio, $domiciliocorresp, $ciudad, $pais, $codigopostal, $tipoPrueba, $email, $telfax, $fechaingreso, $tipolab, $empresa, $estado);
        $msj = "Alta Exitosa";
        $tablalabs = obtenerLaboratorios();
        $idlab = IDLaboratorio($codigo);
        $accion = 'alta';
        $idultimaencuesta = ultimaEncuesta();
        $idultimaencuesta = $idultimaencuesta['idencuesta'];
        almacenarhistorial($idlab, $idultimaencuesta, $fechaingreso, $accion);
        $vista = 'vistaAltaLaboratorio.tpl';
        $template = $twig->loadTemplate("plantilla.tpl");
        $template->display(array('tiposPruebas' => $tiposPruebas, 'msj' => $msj, 'vista' => $vista, 'rol' => $rol,'logueado'=>$logueado));
        exit();
    } else {
        $msj = 'Ya existe el codigo de laboratorio a insertar';
        $vista = 'vistaAltaLaboratorio.tpl';
        $template = $twig->loadTemplate("plantilla.tpl"); 
        $template->display(array('tiposPruebas'=>$tiposPruebas,'msj'=>$msj,'vista' => $vista,'rol'=>$rol,'logueado'=>$logueado ));
	exit();
    }
}
?>