<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Fundacion Bioquimica Argentina-Sistema para Control de Calidad</title>
        <meta name="robots" content="all"/>

        <meta content="control, muestras, laboratorios," name="keywords" />
        <!--hoja de estilos css -->
        <link rel="stylesheet" href="../css/estilo.css" type="text/css" />

        <!--fuentes de google -->

        <link href='http://fonts.googleapis.com/css?family=Freckle+Face' rel='stylesheet' type='text/css'>
    
		<link href='http://fonts.googleapis.com/css?family=Trade+Winds' rel='stylesheet' type='text/css'>
        <!-- plugin para que se vea en IE -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true">
        </script>
        <script type="text/javascript" src='../js/codigo.js'></script>


    </head>
    <body>
      <section class="sitio">
      <header><h2>Fundacion Bioquimica Argentina</h2>
      </header>
          <section class="contenidoprincipal">
		    <div class="separador"> 
			   		{% include "encabezado.tpl" %}
			</div>
			  <article class="izquierda"><h3> Bienvenido. Inicie sesi&oacute;n </h3>
					<form name="registro" action="../controlador/controladorHome.php" method="post">
					<p>{% if msj is defined %} {{ msj }} {% else %} {{ "Por favor ingrese usuario y contraseña" }} {% endif %}</p>
					<p> Usuario: <input name="user" type="text" value="" required="required"/></p>
					<p> Contrase&nacute;a: <input name="pass" type="password" value="" required="required"/></p>  
					<p> <input name="ingresar" type="submit" value="Ingresar"  /> 
					</p>
					
					</form>
				</article>
              </section>
           <div class=" separador"></div>
          <footer><p>Proyecto de software 2013 - UNLP</p></footer>
      </section>
          </body>
</html>