<br>
  <h3 >.Listado de los laboratorios que se encuentran activos hasta el momento</h3>
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
	<td></td>
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
	<td><a href="../controlador/borrarLaboratoriologico.php?borrar={{laboratorio.idlaboratorio}}"> Deshabilitar </a> </td>
</tr>		
	{% endfor %}	
</table>