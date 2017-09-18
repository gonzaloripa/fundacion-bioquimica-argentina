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
    <td><a href="../controlador/controladorListarAnalitosTorta.php?idencuesta={{h.idencuesta}}">Seleccionar analito</a> </td>        
</tr>
{% endfor %}
</table>