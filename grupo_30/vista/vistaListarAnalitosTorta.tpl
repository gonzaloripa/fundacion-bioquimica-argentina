<table>
<tr>
    <td>Codigo</td>
    <td>Nombre</td>
    <td></td>
    </tr>
{% for h in analitos %}
<tr> 
    <td>{{h.codigo}}</td>
    <td>{{h.nombre}} </td>
    <td><a href="../controlador/controladorGraficoAnalitoTorta.php?idanalito={{h.idanalito}}&amp;idencuesta={{encuesta}}">Ver Grafico</a> </td>        
</tr>
{% endfor %}
</table>