{% set i=0 %}
{% for an in analitos %}
{% set i=i+1 %}
{% if i%2!=0 %}
    <hr> 
    <h2> {{an.nombreanalito}}  </h2> 
    <p> Metodo: {{an.nombremetodo}}</p>
    <p> Reactivo: {{an.nombrereactivo}}</p>
    <p> Calibrador: {{an.nombrecalibrador}}</p>
    <p> Papel de Filtro: {{an.nombrepapelfiltro}}</p>
    <p> Valor Corte: {{an.valorcorte}}</p>
    <p> Comentario: {{an.comentario}}</p> 
{% endif %}
    <h3>#Control: {{an.descripcion}} </h3>
    <p> Resultado: {{an.resultadocontrol}} </p> 
   <p>Interpretacion:{{an.nombreinterpretacion}} </p>
    <p>Decision: {{an.nombredecision}} </p>
 
{% endfor %}