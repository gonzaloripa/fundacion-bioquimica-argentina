<?php

include('cfgTwig.php');
include('../modelo/modelo.php');
include ('verificarSesion.php'); // Verifica que el usuario haya iniciado sesion

$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol == "admin") {
    if (!isset($_POST['altaenvio'])) {

        $idan = $_GET['agregartablas'];
        $codigoAn = obtenerCodigoAnalito($idan);
        $metodos = obtenerMetodosid($idan);
        $reactivos = obtenerReactivosid($idan);
        $calibradores = obtenerCalibradoresid($idan);
        $papelesFiltro = obtenerPapelesdeFiltro($idan);
        $interpretaciones = obtenerInterpretacionesControl($idan);
        $decisiones = obtenerDecisionesControl($idan);
        $vista = "vistaAltaTablas.tpl";
        $ar = array('vista'=>$vista,'logueado' => $logueado, 'metodos' => $metodos, 'reactivos' => $reactivos, 'calibradores' => $calibradores, 'papelesFiltro' => $papelesFiltro, 'interpretaciones' => $interpretaciones, 'decisiones' => $decisiones, 'rol' => $rol, 'codigoAn' => $codigoAn);
        $template = $twig->loadTemplate("plantilla.tpl");
        $template->display($ar);
    }
    // Se realiza la operacion de insercion en la bd
    else {

        switch ($_POST['operacion']) {
            case 'altaMetodo':
                $codigoAn = $_POST['analito'];
                $codigo = $_POST['codigo'];
                $nombre = $_POST['nombre'];
                $idanalito = obtenerIdAnalito($codigoAn);
                if (!existeMetodo($codigo, $idanalito)) {

                    if (existeAnalito($codigoAn)) {
                        altaMetodo($nombre, $codigo, $idanalito);
                        $msj = "Alta Metodo Exitosa";
                    } else {
                        $msj = 'no existe el codigo de analito: ' . $codigoAn;
                    }
                } else {
                    $msj = 'Ya existe el codigo de metodo ' . $codigo . ' para el analito con codigo' . $codigoAn;
                }

                break;
            case 'altaReactivo':
                $codigoAn = $_POST['analito'];
                $codigo = $_POST['codigo'];
                $nombre = $_POST['nombre'];
                $idanalito = obtenerIdAnalito($codigoAn);
                if (!existeReactivo($codigo, $idanalito)) {
                    if (existeAnalito($codigoAn)) {
                        altaReactivo($nombre, $codigo, $idanalito);
                        $msj = "Alta Reactivo Exitosa";
                    } else {
                        $msj = 'no existe el codigo de analito: ' . $codigoAn;
                    }
                } else {
                    $msj = 'Ya existe el codigo de reactivo ' . $codigo . ' para el analito con codigo: ' . $codigoAn;
                }

                break;
            case 'altaCalibrador':
                $codigoAn = $_POST['analito'];
                $codigo = $_POST['codigo'];
                $nombre = $_POST['nombre'];
                $idanalito = obtenerIdAnalito($codigoAn);
                if (!existeCalibrador($codigo, $idanalito)) {
                    if (existeAnalito($codigoAn)) {
                        altaCalibrador($nombre, $codigo, $idanalito);
                        $msj = "Alta Calibrador Exitosa";
                    } else {
                        $msj = 'no existe el codigo de analito: ' . $codigoAn;
                    }
                } else {
                    $msj = 'Ya existe el codigo de calibrador ' . $codigo . ' para el analito con codigo: ' . $codigoAn;
                }

                break;
            case 'altaPapelFiltro':
                $codigoAn = $_POST['analito'];
                $codigo = $_POST['codigo'];
                $nombre = $_POST['nombre'];
                $idanalito = obtenerIdAnalito($codigoAn);
                if (!existePapelFiltro($codigo, $idanalito)) {
                    if (existeAnalito($codigoAn)) {
                        altaPapelFiltro($nombre, $codigo, $idanalito);
                        $msj = "Alta Papel Filtro Exitosa";
                    } else {
                        $msj = 'no existe el codigo de analito: ' . $codigoAn;
                    }
                } else {
                    $msj = 'Ya existe el codigo de papel filtro ' . $codigo . 'para el analito con codigo: ' . $codigoAn;
                }

                break;
            case 'altaInterpretacion':
                $codigoAn = $_POST['analito'];
                $codigo = $_POST['codigo'];
                $nombre = $_POST['nombre'];
                $idanalito = obtenerIdAnalito($codigoAn);
                if (!existeInterpretacion($codigo, $idanalito)) {
                    if (existeAnalito($codigoAn)) {
                        altaInterpretacion($nombre, $codigo, $idanalito);
                        $msj = "Alta Interpretacion Exitosa";
                    } else {
                        $msj = 'no existe el codigo de analito: ' . $codigoAn;
                    }
                } else {
                    $msj = 'Ya existe el codigo de interpretacion ' . $codigo . ' para el analito con codigo: ' . $codigoAn;
                }

                break;
            case 'altaDecision':
                $codigoAn = $_POST['analito'];
                $codigo = $_POST['codigo'];
                $nombre = $_POST['nombre'];
                $idanalito = obtenerIdAnalito($codigoAn);
                if (!existeInterpretacion($codigo, $idanalito)) {
                    if (existeAnalito($codigoAn)) {
                        altaDecision($nombre, $codigo, $idanalito);
                        $msj = "Alta Decision Exitosa";
                    } else {
                        $msj = 'no existe el codigo de analito: ' . $codigoAn;
                    }
                } else {
                    $msj = 'Ya existe el codigo de decision ' . $codigo . ' para el analito con codigo: ' . $codigoAn;
                }

                break;
        }
        $idan = obtenerIdAnalito($codigoAn);
        $metodos = obtenerMetodosid($idan);
        $reactivos = obtenerReactivosid($idan);
        $calibradores = obtenerCalibradoresid($idan);
        $papelesFiltro = obtenerPapelesdeFiltro($idan);
        $interpretaciones = obtenerInterpretacionesControl($idan);
        $decisiones = obtenerDecisionesControl($idan);
        $vista = "vistaAltaTablas.tpl";
        $ar = array('vista'=>$vista,'logueado' => $logueado, 'metodos' => $metodos, 'reactivos' => $reactivos, 'calibradores' => $calibradores, 'papelesFiltro' => $papelesFiltro, 'interpretaciones' => $interpretaciones, 'decisiones' => $decisiones, 'msj' => $msj, 'rol' => $rol, 'codigo' => $codigo, 'nombre' => $nombre, 'codigoAn' => $codigoAn);
        $template = $twig->loadTemplate("plantilla.tpl");
        $template->display($ar);
        $_POST[] = "";
    }


} else {
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl");
    $template->display();
}
?>