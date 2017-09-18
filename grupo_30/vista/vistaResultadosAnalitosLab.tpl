<br>
  <h2>.Resultados de la encuesta</h2>
<br>
{% set  i=0 %}
{% for an in analitos %} 

{% set i=i+1 %}
{% if i%2!=0 %}
    <hr> 
    <h2> {{an.nombreanalito}}  </h2> 
   
    <h1> Metodo: {{an.nombremetodo}} </h1>
    <h1> Reactivo: {{an.nombrereactivo}} </h1>
    <h1> Calibrador: {{an.nombrecalibrador}} </h1>
    <h1> Papel de Filtro: {{an.nombrepapelfiltro}}  </h1>
    <h1> Valor Corte: {{an.valorcorte}}</h1>
    <h1> Comentario: {{an.comentario}}  </h1> 
    <br>
    {% endif %}
    
   <table> 
     <tr>
    <td colspan="3"><h3>#Control: {{an.descripcion}} </h3></td>
    </tr>
    <tr>
    <td></td>
    <td><h3> LABORATORIO</h3></td>
    <td class="fba"><h3> FBA</h3> </td>
    </tr>
    <tr>
    <td><h1> Resultado</h1></td><td> {{an.resultadocontrol}}</td><td> {{anaFBA[an.idanalito].resultadocontrol}} </td>
    </tr>
    <tr>
   <td><h1> Interpretacion</h1></td><td>{{an.nombreinterpretacion}} </td><td> {{anaFBA[an.idanalito].nombreinterpretacion}} </td> 
   </tr>
   <tr>
   <td><h1> Decision</h1></td><td> {{an.nombredecision}} </td><td>{{anaFBA[an.idanalito].nombredecision}} </td> 
   </tr>
   </table>
   
{% endfor %}