<form name="altaAnalitos" method="post" autocomplete="off" action="altaAnalitos.php"> 
  
  <h2>GESTION ANALITOS</h2>
  <br>
  <h3 >.Presione Ver Info para visualizar las tablas y realizar Altas</h3>
  <h3 >.Presione borrar para eliminar un elemento</h3>
  <h3 >.Presione modificar para relizar modificaciones sobre un elemento</h3>
   <h3 >.Presione Enviar para dar de alta un nuevo analito</h3>
 <br>
  <div > <h1>Codigo:<input type="text" name="codigo"  value="{{ codigo }}" required='required'></h1> </div> 
  <div > <h1>Nombre:<input type="text" name="nombre"  value="{{ nombre }}" required='required'></h1> </div> 
	<br>
  <input class="boton" name="envioAnalitos" type="submit" value="Enviar">
  <input class="boton" name="borrartodo" type="button" value="Borrar Todo" onclick="document.getElementsByName('altaTablas')[0].reset();">
  
  <br>
  <br>

  <div id="an" class="tablas">
  <table>
  <tr >  
	<td colspan="5" id="top"> ANALITOS</td>
  </tr>
  <tr>
	
	<td>Codigo</td>
	<td colspan="4">Nombre</td>
	
  </tr>
    {% for analito in analitos %}
	<tr>
	<td>{{ analito.codigo}}</td>
	<td>{{ analito.nombre}}</td>
	{% if rol=="admin" %}
	<td><a href="../controlador/altaTablas.php?agregartablas={{ analito.idanalito }}"> Ver Info </a> </td>
	<td><a href="../controlador/modificarAnalitos.php?modcodigo={{ analito.codigo }}&amp;modnombre={{analito.nombre|url_encode(true)}}&amp;seCambia=analito"> Modificar </a> </td>
	<td><a href="../controlador/borrarAnalitos.php?borrar={{ analito.idanalito }}&amp;seBorra=analito"> Borrar </a> </td>
	</tr>
	{% endif %} 
    {% endfor %}
	 </table>
	</div> 	
</form>