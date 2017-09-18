<br>
  <h3>.Listado de encuestas completadas. Presione "Ver Comparacion" para comparar sus resultados con los de FBA</h3>
<br>
<table>
<tr>
    <th>N° Encuesta</th>
    <th>Fecha de Inicio</th>
    <th>Fecha de Finalizacion</th>
    <td></td>
    </tr>
{% for h in encuestas %}
<tr> 
    <td>{{h.idencuesta}} </td>
    <td>{{h.fecha_inicio}} </td>
    <td>{{h.fecha_fin}} </td>
    <td><a href="../controlador/controladorComparacionFba.php?idencuesta={{h.idencuesta}}&amp;idlab={{idlaboratorio}}">Ver Comparacion</a> </td>        
</tr>
{% endfor %}
</table>