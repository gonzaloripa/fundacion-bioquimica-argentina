<br>
  <h3>.Listado de encuestas que tiene disponibles</h3>
<br>
<table>
<tr>
    <td>Nº Encuesta</td>
    <td>Fecha de Inicio</td>
    <td>Fecha de Finalizacion</td>
    <td></td>
    </tr>
{% for h in encuestas %}
<tr> 
    <td>{{h.idencuesta}} </td>
    <td>{{h.fecha_inicio}} </td>
    <td>{{h.fecha_fin}} </td>
    <td><a href="../controlador/altaResultados.php?idencuesta={{h.idencuesta}}">Cargar Resultado</a> </td>        
</tr>
{% endfor %}
</table>