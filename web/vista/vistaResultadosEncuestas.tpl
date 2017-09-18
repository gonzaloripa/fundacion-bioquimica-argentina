{# comentario #}
{#  "Resultado TOTAL:" totalLab "-" porcentaje "%"#}
</br>

</br>
{#  "Resultados Fuera de termino: "fueradetermino #}
<table>
<tr>
    <td>Institucion</td>
    <td>Fecha de Analisis</td>
    <td></td>
    </tr>
{% for h in resultados %}
<tr> 
<td>{% if h.institucion=='' %} {{'FBA'}}{% else %}{{h.institucion}}{% endif %} </td>
    <td>{% if h.institucion=='' %} {{'  -  '}}{% else %}{{h.fechaanalisis}} {% endif %}</td>
    <td><a href="../controlador/controladorVerResultado.php?ide={{h.idencuesta}}&amp;idl={{h.idlaboratorio}}">Ver Resultado</a> </td>        
</tr>
{% endfor %}
</table>