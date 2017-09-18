<?php

include('cfgTwig.php');
include('../modelo/modelo.php');
include ('verificarSesion.php');
$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol == 'admin') {
    if (isset($_POST["modificarenvio"])) {
        //CAMPOS NO OBLIGATORIOS:
        //CAMPOS OBLIGATORIOS:
        $error = "";
        /* USUARIO */ $errorUsuario = false;
        if (isset($_POST['usuario'])) {
            $puede = traerUsuario($_POST['usuario']);
            if ($puede || $_POST['usuario'] == $_POST['usuarioold']) {
                $usuario = $_POST['usuario'];
            } else {
                $error = "Ya existe un usuario con ese nombre de usuario";
                $errorUsuario = true;
            }
        } else {
            $error = "Complete el campo usuario";
            $errorUsuario = true;
        }
        /* CONTRASE�A */$errorPass = false;
        if (isset($_POST['contrasena'])) {
            $contrasena = $_POST['contrasena'];
        } else {
            $error = "Complete el campo contrse&ntilde;a";
            $errorPass = true;
        }
        /* ROL */ $errorRol = false;
        if (isset($_POST['idRol'])) {
            if ($_POST['idRol'] == 0) {
                $errorRol = true;
                $error = "Seleccione un Rol";
            } else
                $idRol = $_POST['idRol'];
        }else {
            $error = "Seleccione un Rol";
            $errorRol = true;
        }
        echo!$errorUsuario;
        echo!$errorPass;
        echo!$errorRol;
        echo $error;
        if (!$errorUsuario and !$errorPass and !$errorRol) {

            echo "--------------";
            $usuarioold = $_POST['usuarioold'];
            $usuario = $_POST['usuario'];
            $contrasena = $_POST['contrasena'];
            $idRol = $_POST['idRol'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $idLab = $_POST['idlab'];
            if ($_POST['idRol'] != 2) {
                $idLab = NULL;
            }
            echo $idLab;
            modificarUsuario($usuarioold, $usuario, $contrasena, $idRol, $nombre, $apellido, $email, $idLab);
            $error = "Se ha insertado el nuevo usuario con &eacute;xito!";
        }

        $msj = 'Modificacion Exitosa';
        $template = $twig->loadTemplate("plantilla.tpl"); 
        $template->display(array('logueado'=>$logueado,'msj' => $msj,'rol'=>$rol));
    } else {

        $idusuario = $_GET["modificar"];
        $infoUsuario = obtenerUsuario($idusuario);
        $lab = traeLabs();
        $roles = traeRoles();
        $vista = "vistaModificarUsuario.tpl";
        $template = $twig->loadTemplate("plantilla.tpl"); 
        $template->display(array('logueado'=>$logueado,'lab' => $lab,'vista' => $vista,'rol'=>$rol,'roles'=>$roles,'infoUsuario'=>$infoUsuario ));
    }
} else {
        $template = $twig->loadTemplate("vistaErrorPermisos.tpl"); 
        $template->display();
}
?>