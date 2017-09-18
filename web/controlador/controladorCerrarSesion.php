<?php
include('../modelo/modelo.php');
include('cfgTwig.php');
session_start();
session_unset();
session_destroy();
$template = $twig->loadTemplate("vistaLogin.tpl"); 
$template->display(array());
?>