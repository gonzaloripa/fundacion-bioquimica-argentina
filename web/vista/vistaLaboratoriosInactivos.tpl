<br>
  <h3>.Listado de los laboratorios que se encuentran inactivos hasta el momento</h3>
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
{% for labsinact in labinactivos %}
<tr>
	<td>{{labsinact.codigo}}</td>
	<td>{{labsinact.institucion}}</td>
	<td>{{labsinact.ciudad}}</td>
	<td>{{labsinact.pais}}</td>
	<td><a href="../controlador/consultadeLaboratorio.php?consulta={{labsinact.idlaboratorio}}"> Ver Informacion </a> </td>
	<td><a href="../controlador/reinscripcionLab.php?reinscribir={{labsinact.idlaboratorio}}"> Reinscribir </a> </td>
</tr>		
	{% endfor %}	
</table>