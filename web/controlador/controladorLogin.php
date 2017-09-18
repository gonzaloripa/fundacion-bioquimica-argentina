<?php 
include('cfgTwig.php');
include('../modelo/modelo.php');
if (isset($_SESSION['logueado'])){		
        $template = $twig->loadTemplate("plantilla.tpl"); 
        $template->display();
        exit();
}
$template = $twig->loadTemplate("vistaLogin.tpl"); 
$template->display();
?>