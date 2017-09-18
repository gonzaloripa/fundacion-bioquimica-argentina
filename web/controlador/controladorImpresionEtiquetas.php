<?php

include('../modelo/modelo.php');
include('cfgTwig.php');
include('verificarSesion.php');
error_reporting(E_ALL & ~E_NOTICE);
include ('fpdf17/fpdf.php');
$rol = nombreRol($_SESSION['miSession']['rol']);
if ($rol == 'personalLab') {
    $template = $twig->loadTemplate("vistaErrorPermisos.tpl");
    $template->display();
    exit();
}

$laboratorios = $_POST['laboratorios'];
if (count($laboratorios) == 0) {
    $msj = 'Debe seleccionar algun laboratorio';
    $vista = 'vistaLabsImpresion.tpl';
    $laboratorios = obtenerLaboratorios();
    $template = $twig->loadTemplate("plantilla.tpl");
    $template->display(array('logueado' => $logueado, 'msj' => $msj, 'vista' => $vista, 'rol' => $rol, 'laboratorios' => $laboratorios));
    exit();
}
$etiquetas = $_POST['etiquetas'];
if (count($etiquetas) == 0) {
    $msj = 'Debe seleccionar alguna etiqueta';
    $vista = 'vistaLabsImpresion.tpl';
    $laboratorios = obtenerLaboratorios();
    $template = $twig->loadTemplate("plantilla.tpl");
    $template->display(array('logueado' => $logueado, 'msj' => $msj, 'vista' => $vista, 'rol' => $rol, 'laboratorios' => $laboratorios));
    exit();
}

///

class PDF extends FPDF {

// Cabecera de página
    function Header() {
        // Logo
        //$this->Image('logo_pb.png', 10, 8, 33);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        $this->SetDrawColor(0, 80, 180);
        $this->SetFillColor(230, 230, 0);
        $this->SetTextColor(220, 50, 50);
        // Movernos a la derecha
        $this->Cell(50);
        // Título
        $this->Cell(90, 10, 'Fundacion Bioquimica Argentina', 1, 0, 'C');
        // Salto de línea
        $this->Ln(20);
    }

// Pie de página
    function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

$pdf = new PDF();
foreach ($laboratorios as $lab) {
    $infolab = obtenerInfoLab($lab); // trae un arreglo de info lab
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Cell(0, 10, 'Laboratorio: ' . $infolab['institucion'], 0, 1);
    for ($i = 0; $i < count($etiquetas); $i++) {
        if ($etiquetas[$i] == 'analitos') {
            $analitos = TiposPruebasSelec($lab);
            $texto = 'Analitos inscriptos:';
            $pdf->Cell(0, 10, $texto, 0, 1);
            foreach ($analitos as $analito) {

                $texto = '   >> ' . $analito['codigo'] . ' - ' . $analito['nombre'];
                $pdf->Cell(0, 10, $texto, 1, 1);
            }
            $pdf->Cell(0, 2, '', 0, 1);
        } else {

            $var = $infolab[$etiquetas[$i]]; // ejemplo: $infolab['codigo'].... $etiquetas[$i] esto es igual a 'codigo'
            if ($etiquetas[$i] == 'domicilio_correspondencia') {
                $etiqueta = "domicilio de correspondencia";
                $texto = $etiqueta . ': ' . $var;
                $pdf->Cell(0, 10, $texto, 1, 1);
                $pdf->Cell(0, 2, '', 0, 1);
            } elseif ($etiquetas[$i] == 'codigopostal') {
                $etiqueta = "codigo postal";
                $texto = $etiqueta . ': ' . $var;
                $pdf->Cell(0, 10, $texto, 1, 1);
                $pdf->Cell(0, 2, '', 0, 1);
            } elseif ($etiquetas[$i] == 'tipolaboratorio') {
                $etiqueta = "tipo de laboratorio";
                $texto = $etiqueta . ': ' . $var;
                $pdf->Cell(0, 10, $texto, 1, 1);
                $pdf->Cell(0, 2, '', 0, 1);
            } else {
                $texto = $etiquetas[$i] . ': ' . $var;
                $pdf->Cell(0, 10, $texto, 1, 1);
                $pdf->Cell(0, 2, '', 0, 1);
            }
        }
    }

    //  $infolab = obtenerInfoLab($lab);
}
$pdf->Output();
// Creación del objeto de la clase heredada
//$pdf->SetFont('Times', '', 12);

$pdf->Output();


///
/*
  $vista = 'vistaSeleccionEtiquetas.tpl';
  $template = $twig->loadTemplate("plantilla.tpl");
  $template->display(array('logueado'=>$logueado,'infolab' => $infolab, 'vista' => $vista, 'rol' => $rol)); */
?>

