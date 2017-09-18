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
if (isset($_POST['encuestainicial'])) {
    if ((isset($_POST['dia_ini'])) and (isset($_POST['mes_ini'])) and (isset($_POST['fechainicio'])) and (isset($_POST['dia_fin'])) and (isset($_POST['mes_fin'])) and (isset($_POST['fechafin']))) {
        $diai = $_POST['dia_ini'];
        $mesi = $_POST['mes_ini'];
        $anoi = $_POST['fechainicio'];
        $fechainicio = $anoi . "-" . $_POST['mes_ini'] . "-" . $_POST['dia_ini'];
        $diaf = $_POST['dia_fin'];
        $mesf = $_POST['mes_fin'];
        $anof = $_POST['fechafin'];
        $fechafin = $anof . "-" . $_POST['mes_fin'] . "-" . $_POST['dia_fin'];
        $fechaok = validarfecha($diai, $mesi);
        if ($fechaok == true) {
            $fechaok = validarfecha($diaf, $mesf);
            if ($fechaok == true) {
                $fechasok = comparafechas($diai, $mesi, $anoi, $diaf, $mesf, $anof);
                if ($fechasok == true) {
                    if (existeEncuesta($fechainicio, $fechafin)) {
                        $msj = 'Ya existe encuesta con esa fecha';
                        $vista = 'vistaInicialEncuesta.tpl';
                        $template = $twig->loadTemplate("plantilla.tpl"); 
                        $template->display(array('logueado'=>$logueado,'msj' => $msj,'vista' => $vista,'rol'=>$rol ));
                    } else {
                        if ((isset($_POST['idmuestra1']) and $_POST['idmuestra1'] != "" ) and (isset($_POST['idmuestra2']) and $_POST['idmuestra2'] != "" ) and (isset($_POST['descripcionm1']) and $_POST['descripcionm1'] != "" ) and (isset($_POST['descripcionm2']) and $_POST['descripcionm2'] != "" )) {
                            $idmuestra1 = $_POST['idmuestra1'];
                            $idmuestra2 = $_POST['idmuestra2'];
                            $descripcionm1 = $_POST['descripcionm1'];
                            $descripcionm2 = $_POST['descripcionm2'];

                            if ($idmuestra1 == $idmuestra2) {
                                $msj = "El id de muestra 1 no puede ser igual al de muestra 2";
                                $vista = 'vistaInicialEncuesta.tpl';
                                $template = $twig->loadTemplate("plantilla.tpl"); 
                                $template->display(array('logueado'=>$logueado,'msj' => $msj,'vista' => $vista,'rol'=>$rol,'idmuestra1'=> $idmuestra1,'idmuestra2'=>$idmuestra2,'descripcionm1'=>$descripcionm1,'descripcionm2'=>$descripcionm2,'fechafin'=>$fechafin ));
                            } else {
                                $analitosexistentes = obtenerAnalitos();
                                $analitosexistentes2 = obtenerAnalitos();
                                foreach ($analitosexistentes as $an) {
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
                                $vista = 'vistaAltaEncuesta.tpl';
                                $template = $twig->loadTemplate("plantilla.tpl"); 
                                $template->display(array('logueado'=>$logueado,'idmuestra1' => $idmuestra1,'idmuestra2' => $idmuestra2,'descripcionm1' => $descripcionm1,'descripcionm2' => $descripcionm2,'analitosexistentes2'=>$analitosexistentes2,'metodos'=>$metodos,'reactivos'=>$reactivos,'calibrador'=>$calibrador,'papeldefiltro'=>$papeldefiltro,'decisioncontrol'=>$decisioncontrol,'interpretacioncontrol'=>$interpretacioncontrol,'decisioncontrol2'=>$decisioncontrol2,'interpretacioncontrol2'=>$interpretacioncontrol2,'vista' => $vista,'rol'=>$rol,'fechainicio'=>$fechainicio,'fechafin'=>$fechafin ));
                            
                            }
                        }//Si cargó todos los campos
                        else {
                            $msj = "Deben completarse todos los datos de las muestras";
                            $vista = 'vistaInicialEncuesta.tpl';
                            $template = $twig->loadTemplate("plantilla.tpl"); 
                            $template->display(array('logueado'=>$logueado,'msj' => $msj,'vista' => $vista,'rol'=>$rol,'idmuestra1'=> $idmuestra1,'idmuestra2'=>$idmuestra2,'descripcionm1'=>$descripcionm1,'descripcionm2'=>$descripcionm2,'fechafin'=>$fechafin ));
                        }
                    }
                }//end if fecha fin es mayor a fecha ini
                else {
                    $msj = "La fecha de inicio no puede ser posterior a la fecha de fin";
                    $vista = 'vistaInicialEncuesta.tpl';
                    $template = $twig->loadTemplate("plantilla.tpl"); 
                    $template->display(array('logueado'=>$logueado,'msj' => $msj,'vista' => $vista,'rol'=>$rol,'idmuestra1'=> $idmuestra1,'idmuestra2'=>$idmuestra2,'descripcionm1'=>$descripcionm1,'descripcionm2'=>$descripcionm2,'fechafin'=>$fechafin ));
                }
            }//end if fecha fin está bien
            else {
                $msj = "Verifique el mes y día de fin ingresados";
                $vista = 'vistaInicialEncuesta.tpl';
                $template = $twig->loadTemplate("plantilla.tpl"); 
                $template->display(array('logueado'=>$logueado,'msj' => $msj,'vista' => $vista,'rol'=>$rol,'idmuestra1'=> $idmuestra1,'idmuestra2'=>$idmuestra2,'descripcionm1'=>$descripcionm1,'descripcionm2'=>$descripcionm2,'fechafin'=>$fechafin ));
            }
        }//end if fecha inicio está bien
        else {
            $msj = "Verifique el mes y día de inicio ingresados";
            $vista = 'vistaInicialEncuesta.tpl';
            $template = $twig->loadTemplate("plantilla.tpl"); 
            $template->display(array('logueado'=>$logueado,'msj' => $msj,'vista' => $vista,'rol'=>$rol,'idmuestra1'=> $idmuestra1,'idmuestra2'=>$idmuestra2,'descripcionm1'=>$descripcionm1,'descripcionm2'=>$descripcionm2,'fechafin'=>$fechafin ));
        }
    }//end if cargó la fecha ini y fin
    else {
        $msj = "Ingrese los datos de la fecha de inicio y de fin";
        $vista = 'vistaInicialEncuesta.tpl';
        $template = $twig->loadTemplate("plantilla.tpl"); 
        $template->display(array('logueado'=>$logueado,'msj' => $msj,'vista' => $vista,'rol'=>$rol,'idmuestra1'=> $idmuestra1,'idmuestra2'=>$idmuestra2,'descripcionm1'=>$descripcionm1,'descripcionm2'=>$descripcionm2,'fechafin'=>$fechafin ));
    }
} else {

    $vista = 'vistaInicialEncuesta.tpl';
    $template = $twig->loadTemplate("plantilla.tpl"); 
    $template->display(array('logueado'=>$logueado,'vista' => $vista,'rol'=>$rol));
}
?>