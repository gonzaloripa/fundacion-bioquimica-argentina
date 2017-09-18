<br>
  <h3 >.Listado total de los laboratorios inscriptos (activos e inactivos) </h3>
<br>
<table>
<tr>
	<td>codigo:</td>
	<td>institucion:</td>
	<td>ciudad:</td>
	<td>pais:</td>
	<td></td>	
	{% if rol=="admin" %}
	<td></td>
	{% endif %}
	
</tr>
{% for laboratorio in tablalabs  %}
<tr>
	<td>{{laboratorio.codigo}}</td>
	<td>{{laboratorio.institucion}}</td>
	<td>{{laboratorio.ciudad}}</td>
	<td>{{laboratorio.pais}}</td>
	<td><a href="../controlador/consultadeLaboratorio.php?consulta={{laboratorio.idlaboratorio}}"> + Informacion </a> </td>
	{% if rol=="admin" %}
	<td><a href="../controlador/modificarLaboratorio.php?modificar={{laboratorio.idlaboratorio}}"> Modificar </a> </td>
	{% endif %}
	
</tr>		
	{% endfor %}	
</table>