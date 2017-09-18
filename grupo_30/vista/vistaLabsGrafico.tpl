<br>
  <h3>.Listado de laboratorios activos. Seleccione la opcion "Seleccionar Encuesta" para ver su gráfico</h3>
<br>
<table>
<tr>
	<td>codigo:</td>
	<td>institucion:</td>
	<td>ciudad:</td>
	<td>pais:</td>
	<td></td>	

	<td></td>
</tr>
{% for laboratorio in laboratorios %} 
<tr>
	<td>{{ laboratorio.codigo}}</td>
	<td>{{ laboratorio.institucion}}</td>
	<td>{{ laboratorio.ciudad}}</td>
	<td>{{ laboratorio.pais}}</td>
	<td><a href="../controlador/consultadeLaboratorio.php?consulta={{ laboratorio.idlaboratorio}}"> + Informacion </a> </td>

        <td><a href="../controlador/controladorSeleccionarEncuestaGrafico.php?laboratorio={{ laboratorio.idlaboratorio}}"> Seleccionar Encuesta </a> </td>
</tr>	
	{% endfor %}
</table>