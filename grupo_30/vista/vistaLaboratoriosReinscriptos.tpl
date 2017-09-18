<br>
  <h3 >.Listado de los laboratorios que han sido reinscriptos hasta el momento</h3>
<br>
<table>
<tr>
	<td>codigo:</td>
	<td>institucion:</td>
	<td>ciudad:</td>
	<td>pais:</td>
	<td></td>	


</tr>
{% for laboratorio in labsreinscriptos %} 
<tr>
	<td>{{ laboratorio.codigo}}</td>
	<td>{{ laboratorio.institucion}}</td>
	<td>{{ laboratorio.ciudad}}</td>
	<td>{{ laboratorio.pais}}</td>
	<td><a href="../controlador/consultadeLaboratorio.php?consulta={{ laboratorio.idlaboratorio}}"> + Informacion </a> </td>


</tr>		
	{% endfor %}
</table>