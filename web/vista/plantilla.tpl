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
        <link href='http://fonts.googleapis.com/css?family=Risque' rel='stylesheet' type='text/css'>
        <!-- plugin para que se vea en IE -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true">
        </script>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
            var geocoder;
            var map;
            function initialize() {
                geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(-34.397, 150.644);
                var mapOptions = {
                    zoom: 15,
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
            }
            function codeAddress() {

                //var items ={{ items }};
                //alert({{ items }});
                if (document.getElementById("domicilio") != null && document.getElementById("ciudad1") != null && document.getElementById("pais1") != null) {
                    var x = document.getElementById("domicilio").value + " " + document.getElementById("ciudad1").value + " " + document.getElementById("pais1").value;
                    //alert(x);
                    //for ( i=0; i < items.length; i++ ) { 
                    if (x != null) {
                        initialize();
                        var address = x;
                        //alert(address);
                        geocoder.geocode({'address': address}, function(results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                map.setCenter(results[0].geometry.location);
                                var marker = new google.maps.Marker({
                                    map: map,
                                    position: results[0].geometry.location,
                                    title: address
                                });
                            } else {
                                document.getElementById("map_canvas").style.display = 'none';
                            }
                        });
                    }
                }

            }


        </script>
    <script type="text/javascript" src="//www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript" >
      function drawVisualization() {
         var st=document.getElementById("stgraf").value;
         if(st==null){
             return;
         }
         //var st='1,2,3';
         var datos=st.split(",");
        // Create and populate the data table.Tiempo de Envio', 'Tiempo de Analisis', 'Tiempo de Ingreso
        var data = google.visualization.arrayToDataTable([
          ['', 'Dias'],
          ['Envio',  parseInt(datos[0])],
          ['Analisis', parseInt(datos[1])],
          ['Ingreso',  parseInt(datos[2])]
        ]);
      
        // Create and draw the visualization.
        new google.visualization.BarChart(document.getElementById('visualization')).
            draw(data,
                 {title:"",
                  width:850, height:400,
                  vAxis: {title: "Tiempo"},
                  hAxis: {title: "Dias"}}
            );
      }
      

      google.setOnLoadCallback(drawVisualization);
    </script>
      
    
    
    <script type="text/javascript">
      google.load('visualization2', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization2() {
        // Create and populate the data table.
        var st1=document.getElementById("stgraf2").value;
        var st2=document.getElementById("stgraf1").value;
         if(st1==null){
             return;
         }
        var data = google.visualization.arrayToDataTable([
          ['', ''],
          ['Contestadas', parseInt(st1)],
          ['No Contestadas', parseInt(st2)]
        ]);
      
        // Create and draw the visualization.
        new google.visualization.PieChart(document.getElementById('visualization2')).
            draw(data, {title:"Porcentaje de Encuestas"});
      }
      

      google.setOnLoadCallback(drawVisualization2);
    </script>
        
        

    </head>
    <body onload="codeAddress();" >
        <section class="sitio">
            <header><h2>Fundacion Bioquimica Argentina</h2>
            </header>
            <section class="contenidoprincipal">
                <div class="separador"> 
                    {% include "encabezado.tpl" %}
                </div>
                {% if rol == "admin"  %}
                    <article class="arriba"><h1>Menu - ADMIN </h1>
                        <div class="operaciones"> 
                           <nav >
                                <ul>
                                <li class="menuv"><a href="../controlador/altaLaboratorio.php">Alta de Laboratorio</a></li>
                                <li class="menuv"><a href="../controlador/consultaLaboratorio.php">Gestion de Laboratorios</a></li>
                                <li class="menuv"><a href="../controlador/listarLaboratoriosInactivos.php">Laboratorios Inactivos</a></li>
                                <li class="menuv"><a href="../controlador/controladorAltaUsuario.php">Alta de Usuario</a></li>
                                <li class="menuv"><a href="../controlador/controladorConsultaUsuarios.php">Gestion de Usuarios</a></li>
                                <li class="menuv"><a href="../controlador/controladorConsultaHistorial.php">Historial de Laboratorio</a></li>
                                <li class="menuv"><a href="../controlador/altaAnalitos.php">Datos de Referencia</a></li>
                                </ul>
                            </nav >
                                <nav >
                                <ul>  
                                
                                <li class="menuv"><a href="../controlador/controladorTotalLaboratorios.php">Total de Labs Inscriptos</a></li>
                                <li class="menuv"><a href="../controlador/controladolLaboratoriosReinscriptos.php">Labs Reinscriptos</a></li>
                                <li class="menuv"><a href="../controlador/controladorLabsImpresion.php">Impresion de Etiquetas</a></li>
                                <li class="menuv"><a href="../controlador/controladorLabsGrafico.php">Graficos de Laboratorio</a></li>
                                <li class="menuv"><a href="../controlador/controladorLaboratoriosInscriptos.php">Laboratorios Inscriptos a Analitos</a></li>
                                
                              </ul>
                            </nav>
                        </div>
                    </article>

                {% elseif rol == "personalFBA" %}
                    <article class="arriba"><h1>Menu - Personal FBA </h1>
                        <div class="operaciones"> 
                                <nav>
                                <ul>
                                <li class="menuv"><a href="../controlador/altaLaboratorio.php">Alta de Laboratorio</a></li>
                                <li class="menuv"><a href="../controlador/listarLaboratoriosInactivos.php">Laboratorios Inactivos</a></li>
                                <li class="menuv"><a href="../controlador/controladorLaboratoriosActivos.php">Laboratorios Activos</a></li>
                                <li class="menuv"><a href="../controlador/controladorAgregarEncuestaInicio.php">Alta de Encuesta + Resultado</a></li>
                                <li class="menuv"><a href="../controlador/controladorConsultaEncuestas.php">Consulta de Resultados de Encuestas</a></li>
                                <li class="menuv"><a href="../controlador/controladorTotalLaboratorios.php">Total de Labs Inscriptos</a></li>
                                    
                                <li class="menuv"><a href="../controlador/controladorListadoEncuestasTorta.php">Grafico de Encuestas</a></li>
                                </ul> 
                                </nav>
                                <nav>
                                <ul>
                                <li class="menuv"><a href="../controlador/controladorListarEncAnalitosTorta.php">Grafico de Analitos por Encuestas</a></li>
                                <li class="menuv"><a href="../controlador/controladorLaboratoriosReinscriptos.php">Labs Reinscriptos</a></li>
                                <li class="menuv"><a href="../controlador/controladorLabsImpresion.php">Impresion de Etiquetas</a></li>
                                <li class="menuv"><a href="../controlador/controladorLabsGrafico.php">Graficos de Laboratorio</a></li>
                                <li class="menuv"><a href="../controlador/controladorLaboratoriosInscriptos.php">Laboratorios Inscriptos a Analitos</a></li>
                                </ul>
                               </nav>
                        </div>
                    </article>


                {% elseif rol == "personalLAB" %}
                    <article id="lab"><h1>Menu - Personal LAB </h1>
                        <div class="operaciones"> 
                            <nav >
                            <ul>
                                <li class="menuv"><a href="../controlador/modificarLaboratorio.php">Modificar Datos de Laboratorio</a></li>
                                <li class="menuv"><a href="../controlador/controladorEncuestasDisponibles.php">Cargar Resultado de Encuesta</a></li>
                                <li class="menuv"><a href="../controlador/controladorVerEncuestasLab.php">Encuestas completadas</a></li>
                            </ul>
                            </nav>
                        </div>
                    </article>
                {% endif %}

                <div class="separador"> 
                    {% if msj is defined %}
                        {{ msj }}
                    {% endif %}
                     {%if vista is defined %}
                        {% include vista %}
                     {% endif %}
                </div>
                <div class=" separador"></div>
                <footer><p>Proyecto de software 2013 - UNLP</p></footer>
            </section>
    </section>
    </body>
</html>