<form name="altaTablas" method="post" autocomplete="off" action="altaTablas.php"> 
   <h2>GESTION TABLAS</h2>
  <br>
  <h3 >.Seleccione una opcion de la lista para realizar Altas</h3>
  <h3 >.Presione borrar para eliminar un elemento</h3>
  <h3 >.Presione modificar para realizar modificaciones sobre un elemento</h3>
   <br>
  <div>
  <select id="operaciones" name="operacion" onchange= "mostrar(this)">  
      <option value="-Seleccione una opcion-" selected="selected" disabled="disabled">-Seleccione una opcion-</option>  
  <option value="altaMetodo">Agregar Metodo</option> 
  <option value="altaReactivo">Agregar Reactivo</option> 
  <option value="altaCalibrador">Agregar Calibrador</option> 
  <option value="altaPapelFiltro">Agregar Papel de Filtro</option>
  <option value="altaInterpretacion">Agregar Interpretacion</option>
  <option value="altaDecision">Agregar Decision</option>    
  </select> 
  </div>
  <div > <h1>Codigo Analito:<input type="text" name="analito" value="{{codigoAn}}" readonly="readonly"></h1> </div>
  <div > <h1>Codigo:<input type="text" name="codigo"  value="{{codigo}}" required='required'></h1> </div> 
  <div > <h1>Nombre:<input type="text" name="nombre"  value="{{nombre}}" required='required'></h1> </div> 
	<br>
  <input class="boton" name="altaenvio" type="submit" value="Enviar"> 
  <input class="boton" name="borrartodo" type="button" value="Borrar Todo" onclick="document.getElementsByName('altaTablas')[0].reset();">
  
  <br>
  <br>
  
	<div id="me" class="tablas">	
	<table>	
	<tr>
	<td colspan="5" class="top"> METODOS</td>
	</tr>
	<tr>
	<td>Codigo Analito</td>
	
	<td>Codigo</td>
	<td colspan="3">Nombre</td>
	</tr>
	{% for metodo in metodos %}
	<tr>
	<td>{{codigoAn}}</td>
	<td>{{metodo.codigo}}</td>
	<td>{{metodo.nombre}}</td>
	{% if rol=="admin" %}
	<td><a href="../controlador/modificarTablas.php?modcodanalito={{codigoAn}}&amp;modanalito={{metodo.idanalito}}&amp;modcodigo={{metodo.codigo}}&amp;modnombre={{metodo.nombre|url_encode(true)}}&amp;seCambia=metodo"> Modificar </a> </td>
	<td><a href="../controlador/borrarTablas.php?borrar={{metodo.idmetodo}}&amp;analito={{metodo.idanalito}}&amp;seBorra=metodo"> Borrar </a> </td>
    </tr>		 	
	{% endif %} 
        {% endfor %}
  </table>
 </div>
   
   <div id="re" class="tablas" >
  <table>
  <tr >  
	<td colspan="5" class="top"> REACTIVOS</td>
  </tr>
  <tr>
	<td>Codigo Analito</td>
	
	<td>Codigo</td>
	<td colspan="3">Nombre</td>	
  </tr>
    {% for reactivo in reactivos %}
	<tr>
	<td>{{codigoAn}}</td>
	
	<td>{{reactivo.codigo}}</td>
	<td>{{reactivo.nombre}}</td>
	{% if rol=="admin" %}
	<td><a href="../controlador/modificarTablas.php?modanalito={{reactivo.idanalito}}&amp;modcodanalito={{codigoAn}}&amp;modcodigo={{reactivo.codigo}}&amp;modnombre={{reactivo.nombre|url_encode(true)}}&amp;seCambia=reactivo"> Modificar </a> </td>
	<td><a href="../controlador/borrarTablas.php?borrar={{reactivo.idreactivo}}&amp;analito={{reactivo.idanalito}}&amp;seBorra=reactivo"> Borrar </a> </td>
	</tr>
	{% endif %} 
        {% endfor %}
	 </table>
	 	
	</div>	
	<div id="ca" class="tablas">
	<table>	
	<tr>
	<td colspan="5" class="top"> CALIBRADORES</td>
	</tr>
	<tr>
	<td>Codigo Analito</td>
	
	<td>Codigo</td>
	<td colspan="3">Nombre</td>
	</tr>
	{% for calibrador in calibradores %}
	<tr>
	<td>{{codigoAn}}</td>
	
	<td>{{calibrador.codigo}}</td>
	<td>{{calibrador.nombre}}</td>
	{% if rol=="admin" %}
	<td><a href="../controlador/modificarTablas.php?modanalito={{calibrador.idanalito}}&amp;modcodanalito={{codigoAn}}&amp;modcodigo={{calibrador.codigo}}&amp;modnombre={{calibrador.nombre|url_encode(true)}}&amp;seCambia=calibrador"> Modificar </a> </td>
	<td><a href="../controlador/borrarTablas.php?borrar={{calibrador.idcalibrador}}&amp;analito={{calibrador.idanalito}}&amp;seBorra=calibrador"> Borrar </a> </td>
	</tr>		
	{% endif %} 
        {% endfor %}
  </table>
 
   </div>
	<div id="pf" class="tablas">
  <table>
  <tr >  
	<td colspan="5" class="top"> PAPELES FILTRO</td>
  </tr>
  <tr>
	<td>Codigo Analito</td>

	<td>Codigo</td>
	<td colspan="3">Nombre</td>
  </tr>
    {% for pf in papelesFiltro %}
	<tr>
	<td>{{codigoAn}}</td>
	
	<td>{{pf.codigo}}</td>
	<td>{{pf.nombre}}</td>
	{% if rol=="admin" %}
	<td><a href="../controlador/modificarTablas.php?modanalito={{ pf.idanalito }}&amp;modcodanalito={{codigoAn}}&amp;modcodigo={{pf.codigo}}&amp;modnombre={{pf.nombre|url_encode(true)}}&amp;seCambia=papelFiltro"> Modificar </a> </td>
	<td><a href="../controlador/borrarTablas.php?borrar={{pf.idpapelfiltro}}&amp;analito={{pf.idanalito}}&amp;seBorra=papelFiltro"> Borrar </a> </td>
	</tr>
	{% endif %} 
        {% endfor %}
	 </table>
	 </div>
	 
	 <div id="de" class="tablas">		
	<table>	
	<tr>
	<td colspan="5" class="top"> DECISIONES</td>
	</tr>
	<tr>
	<td>Codigo Analito</td>

	<td>Codigo</td>
	<td colspan="3">Nombre</td>
	</tr>
	{% for decision in decisiones %}
	<tr>
	<td>{{codigoAn}}</td>
	
	<td>{{decision.codigo}}</td>
	<td>{{decision.nombre}}</td>
	{% if rol=="admin" %}
	<td><a href="../controlador/modificarTablas.php?modanalito={{decision.idanalito}}&amp;modcodanalito={{codigoAn}}&amp;modcodigo={{decision.codigo}}&amp;modnombre={{decision.nombre|url_encode(true)}}&amp;seCambia=decision"> Modificar </a> </td>
	<td><a href="../controlador/borrarTablas.php?borrar={{decision.iddecision}}&amp;analito={{decision.idanalito}}&amp;seBorra=decision"> Borrar </a> </td>
    </tr>		
	{% endif %} 
        {% endfor %}	
  </table>
    </div>
	
	<div id="in" class="tablas">
  	<table>	
	<tr>
	<td colspan="5" class="top"> INTERPRETACIONES</td>
	</tr>
	<tr>
	<td>Codigo Analito</td>

	<td>Codigo</td>
	<td colspan="3">Nombre</td>
	</tr>
	{% for inter in interpretaciones %}
	<tr>
	<td>{{codigoAn}}</td>
	
	<td>{{inter.codigo}}</td>
	<td>{{inter.nombre}}</td>
	{% if rol=="admin" %}
	<td><a href="../controlador/modificarTablas.php?modanalito={{inter.idanalito}}&amp;modcodanalito={{codigoAn}}&amp;modcodigo={{inter.codigo}}&amp;modnombre={{inter.nombre|url_encode(true)}}&amp;seCambia=interpretacion"> Modificar </a> </td>
	<td><a href="../controlador/borrarTablas.php?borrar={{inter.idinterpretacion}}&amp;analito={{inter.idanalito}}&amp;seBorra=interpretacion"> Borrar </a> </td>
    </tr>		
	{% endif %} 
        {% endfor %}	
  </table>
   </div>
 
  
</form>