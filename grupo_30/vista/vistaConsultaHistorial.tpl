<br>
  <h3>.Historial de cada laboratorio</h3>
<br>

<table >
<tr>
    <td>Accion</td>
    <td>Fecha</td>
    <td>Ultima Encuesta</td>
    <td>Laboratorio</td>
    </tr>
{% for h in historial %}
<tr> 
    <td>{{h.accion}} </td>
    <td>{{h.fecha}} </td>
    <td>{{h.idencuesta}} </td>
    <td>{{h.institucion}} </td>
        
</tr>
{% endfor %}
</table>