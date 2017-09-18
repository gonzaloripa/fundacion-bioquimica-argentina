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
    <td><a href="../controlador/controladorGraficoTorta.php?idencuesta={{h.idencuesta}}">Ver Grafico</a> </td>        
</tr>
{% endfor %}
</table>