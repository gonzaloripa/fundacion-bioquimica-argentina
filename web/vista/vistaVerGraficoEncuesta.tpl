<br>
  <h3>.Listado de encuestas para el laboratorio seleccionado. Seleccione la opcion "Ver Grafico" para visualizar el grafico de la encuesta seleccionada</h3>
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
    <td>{{ h.idencuesta }} </td>
    <td>{{ h.fecha_inicio }} </td>
    <td> {{ h.fecha_fin }} </td>
    <td><a href="../controlador/controladorGraficoEncuesta.php?idencuesta={{h.idencuesta}}&amp;idlab={{idlab}}">Ver Grafico</a> </td>        
</tr>
{% endfor %}
</table>