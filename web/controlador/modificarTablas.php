<?php
include('cfgTwig.php');
include_once('../modelo/modelo.php');
include ('verificarSesion.php');

$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol == 'admin') {
    if (isset($_POST['modenvio'])) {

        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $codviejo = $_POST['codviejo'];
        $nomviejo = $_POST['nomviejo'];
        $codigoan = $_POST['analito'];
        $idan = $_POST['idanalito'];
        $cambio = $_POST['secambio'];
        switch ($cambio) {

            case 'metodo':
                if ((!existeMetodo($codigo, $idan)) or ($codigo == $codviejo and $nombre != $nomviejo)) {
                    modificarMetodo($nombre, $codigo, $codviejo, $idan);
                    $msj = "Modificacion Metodo Exitosa ";
                    $codviejo = $codigo;
                    $nomviejo = $nombre;
                } elseif ($codigo == $codviejo and $nombre == $nomviejo) {

                    $msj = "Se debe modificar algun campo ";
                } else {

                    $msj = "Ya existe el codigo de metodo " . $codigo . " para este analito. Ingrese un codigo que no exista o cambie solo el nombre";
                    $codigo = $codviejo;
                    $nombre = $nomviejo;
                }

                break;
            case 'reactivo':
                if ((!existeReactivo($codigo, $idan)) or ($codigo == $codviejo and $nombre != $nomviejo)) {
                    modificarReactivo($nombre, $codigo, $codviejo, $idan);
                    $msj = "Modificacion Reactivo Exitosa ";
                    $codviejo = $codigo;
                    $nomviejo = $nombre;
                } elseif ($codigo == $codviejo and $nombre == $nomviejo) {

                    $msj = "Se debe modificar algun campo ";
                } else {

                    $msj = "Ya existe el codigo de reactivo " . $codigo . " para este analito. Ingrese un codigo que no exista o cambie solo el nombre";
                    $codigo = $codviejo;
                    $nombre = $nomviejo;
                }
                break;
            case 'calibrador':
                if ((!existeCalibrador($codigo, $idan)) or ($codigo == $codviejo and $nombre != $nomviejo)) {
                    modificarCalibrador($nombre, $codigo, $codviejo, $idan);
                    $msj = "Modificacion Calibrador Exitosa ";
                    $codviejo = $codigo;
                    $nomviejo = $nombre;
                } elseif ($codigo == $codviejo and $nombre == $nomviejo) {

                    $msj = "Se debe modificar algun campo ";
                } else {

                    $msj = "Ya existe el codigo de calibrador " . $codigo . " para este analito. Ingrese un codigo que no exista o cambie solo el nombre";
                    $codigo = $codviejo;
                    $nombre = $nomviejo;
                }
                break;
            case 'papelFiltro':
                if ((!existePapelFiltro($codigo, $idan)) or ($codigo == $codviejo and $nombre != $nomviejo)) {
                    modificarMetodo($nombre, $codigo, $codviejo, $idan);
                    $msj = "Modificacion Papel de Filtro Exitosa ";
                    $codviejo = $codigo;
                    $nomviejo = $nombre;
                } elseif ($codigo == $codviejo and $nombre == $nomviejo) {

                    $msj = "Se debe modificar algun campo ";
                } else {

                    $msj = "Ya existe el codigo de papel de filtro " . $codigo . " para este analito. Ingrese un codigo que no exista o cambie solo el nombre";
                    $codigo = $codviejo;
                    $nombre = $nomviejo;
                }
                break;
            case 'interpretacion':
                if ((!existeInterpretacion($codigo, $idan)) or ($codigo == $codviejo and $nombre != $nomviejo)) {
                    modificarMetodo($nombre, $codigo, $codviejo, $idan);
                    $msj = "Modificacion Interpretacion Exitosa ";
                    $codviejo = $codigo;
                    $nomviejo = $nombre;
                } elseif ($codigo == $codviejo and $nombre == $nomviejo) {

                    $msj = "Se debe modificar algun campo ";
                } else {

                    $msj = "Ya existe el codigo de interpretacion " . $codigo . " para este analito. Ingrese un codigo que no exista o cambie solo el nombre";
                    $codigo = $codviejo;
                    $nombre = $nomviejo;
                }
                break;
            case 'decision':
                if ((!existeDecision($codigo, $idan)) or ($codigo == $codviejo and $nombre != $nomviejo)) {
                    modificarMetodo($nombre, $codigo, $codviejo, $idan);
                    $msj = "Modificacion Decision Exitosa ";
                    $codviejo = $codigo;
                    $nomviejo = $nombre;
                } elseif ($codigo == $codviejo and $nombre == $nomviejo) {

                    $msj = "Se debe modificar algun campo ";
                } else {

                    $msj = "Ya existe el codigo de decision " . $codigo . " para este analito. Ingrese un codigo que no exista o cambie solo el nombre";
                    $codigo = $codviejo;
                    $nombre = $nomviejo;
                }
                break;
        }


        $vista = 'vistaModTablas.tpl';
        $template = $twig->loadTemplate("plantilla.tpl"); 
        $template->display(array('logueado'=>$logueado,'msj'=>$msj,'idan'=>$idan,'cambio'=>$cambio,'codigoan'=>$codigoan,'codigo'=>$codigo,'codviejo'=>$codviejo,'nombre'=>$nombre,'vista' => $vista,'rol'=>$rol ));
    } else {

        $codigo = $_GET['modcodigo'];
        $codviejo = $_GET['modcodigo'];
        $nombre = $_GET['modnombre'];
        $idan = $_GET['modanalito'];
        $codigoan = $_GET['modcodanalito'];
        $cambio = $_GET['seCambia'];
        $vista = 'vistaModTablas.tpl';
        $template = $twig->loadTemplate("plantilla.tpl"); 
        $template->display(array('logueado'=>$logueado,'idan'=>$idan,'cambio'=>$cambio,'codigoan'=>$codigoan,'codigo'=>$codigo,'codviejo'=>$codviejo,'nombre'=>$nombre,'vista' => $vista,'rol'=>$rol ));
    }
} else {
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
    $template->display();
}
?>
