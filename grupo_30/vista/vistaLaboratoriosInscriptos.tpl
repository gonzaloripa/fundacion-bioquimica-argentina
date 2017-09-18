<h1> Laboratorios Inscriptos a UN solo Analito</h1>
<table>
<tr>
	<td>codigo:</td>
	<td>institucion:</td>
	<td>ciudad:</td>
	<td>pais:</td>
	<td></td>	


</tr>
{% for laboratorio in analitos1 %} 
<tr>
	<td>{{ laboratorio.codigo}}</td>
	<td>{{ laboratorio.institucion}}</td>
	<td>{{ laboratorio.ciudad}}</td>
	<td>{{ laboratorio.pais}}</td>
	<td><a href="../controlador/consultadeLaboratorio.php?consulta={{ laboratorio.idlaboratorio}}"> + Informacion </a> </td>


</tr>		
	{% endfor %}
</table>

<hr> 
<h1> Laboratorios Inscriptos a mas de un Analito</h1>
<table>
<tr>
	<td>codigo:</td>
	<td>institucion:</td>
	<td>ciudad:</td>
	<td>pais:</td>
	<td></td>	


</tr>
{% for laboratorio in analitosvarios %} 
<tr>
	<td>{{ laboratorio.codigo}}</td>
	<td>{{ laboratorio.institucion}}</td>
	<td>{{ laboratorio.ciudad}}</td>
	<td>{{ laboratorio.pais}}</td>
	<td><a href="../controlador/consultadeLaboratorio.php?consulta={{ laboratorio.idlaboratorio}}"> + Informacion </a> </td>


</tr>		
	{% endfor %}
</table>