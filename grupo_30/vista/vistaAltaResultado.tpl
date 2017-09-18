<form name="altaresultado" action="altaResultados.php" method="post">
     <input hidden name="idencuesta" value="{{ idencuesta }}">
    <p>Fecha de Recepci&oacute;n del material:  
        <select name="dia_recep" class="fecha">
        {% for i in 1..31 %}
          {% if i<10 %}
                {% set a=i %}
                <option value="{{a }}" >{{a }}</option>
           {% else %}
            <option value="{{i }}" >{{i }}</option>  
           {% endif %}
           {% endfor %}
        </select>
        /
        <select name="mes_recep" class="fecha">
        {% for i in 1..12 %} 
            {% if i<10 %}
               {% set a=i %}
                <option value="{{a }}" >{{a }}</option>
           {% else %}
            <option value="{{i }}" >{{i }}</option>  
           {% endif %}
           {% endfor %}
        </select>
        /
        <select name="ano_recep" class="fecha">
        {% for i in 2013..2050 %} 
        <option value="{{i }}" >{{i }}</option> 
           {% endfor %}
        </select>
        </p>
        <p>Fecha de An&aacute;lisis:  
        <select name="dia_analisis" class="fecha">
        {% for i in 1..31 %}
          {% if i<10 %}
                {% set a=i %}
                <option value="{{a }}" >{{a }}</option>
           {% else %}
            <option value="{{i }}" >{{i }}</option>  
           {% endif %}
           {% endfor %}
        </select>
        /
        <select name="mes_analisis" class="fecha">
        {% for i in 1..12 %} 
            {% if i<10 %}
               {% set a=i %}
                <option value="{{a }}" >{{a }}</option>
           {% else %}
            <option value="{{i }}" >{{i }}</option>  
           {% endif %}
           {% endfor %}
        </select>
        /
        <select name="ano_analisis" class="fecha">
        {% for i in 2013..2050 %} 
        <option value="{{i }}" >{{i }}</option> 
           {% endfor %}
        </select>
        </p>
        <p>Fecha de Ingreso de los resultados:  
        <select name="dia_res" class="fecha">
        {% for i in 1..31 %}
          {% if i<10 %}
                {% set a=i %}
                <option value="{{a }}" >{{a }}</option>
           {% else %}
            <option value="{{i }}" >{{i }}</option>  
           {% endif %}
           {% endfor %}
        </select>
        /
        <select name="mes_res" class="fecha">
        {% for i in 1..12 %} 
            {% if i<10 %}
               {% set a=i %}
                <option value="{{a }}" >{{a }}</option>
           {% else %}
            <option value="{{i }}" >{{i }}</option>  
           {% endif %}
           {% endfor %}
        </select>
        /
        <select name="ano_res" class="fecha">
        {% for i in 2013..2050 %} 
        <option value="{{i }}" >{{i }}</option> 
           {% endfor %}
        </select>
        </p>
    
    {% for an2 in analitoselegidos2 %}
        <h2> {{ an2.nombre }}   </h2> 
        <p>Metodo:</p> <select name="metodo[{{ an2.idanalito }}]" >
       
       {% for a in metodos[an2.idanalito] %}
            <option value="{{ a.idmetodo }}" >  {{ a.codigo }} - {{ a.nombre }} </option>         
        {% endfor %}
    </select>
    <p>Calibrador:</p> <select name="calibrador[{{ an2.idanalito }}]" >
    {% for a2 in calibrador[an2.idanalito] %}
        <option value="{{ a2.idcalibrador }}" >  {{ a2.codigo }} - {{ a2.nombre }} </option> 		
   {% endfor %}
    </select>
    <p>Reactivos:</p> <select name="reactivo[{{ an2.idanalito }}]" >
    {% for a3 in reactivos[an2.idanalito] %}
        <option value="{{ a3.idreactivo }}" >  {{ a3.codigo }} - {{ a3.nombre }} </option> 		
    {% endfor %}
    </select>
    <p>Papel de Filtro</p><select name="papeldefiltro[{{ an2.idanalito }}]" >
    {% for a4 in papeldefiltro[an2.idanalito] %}
        <option value="{{ a4.idpapelfiltro }}" >  {{ a4.codigo }} - {{ a4.nombre }} </option> 		
   {% endfor %}
    </select>
    <p> Valor de Corte</p> <input name="valorcorte[{{ an2.idanalito }}]" type ="text">

    <h1> Resultado: </h1>
    <h3>#Control: {{ muestras[0].descripcion }} </h3>
<p> Resultado: </p><input name="resultadom1{{ an2.idanalito }}]" type='text' /> 
    <p>Interpretacion:</p> <select name="interpretacionm1[{{ an2.idanalito }}]" >
    {% for a5 in interpretacioncontrol[an2.idanalito] %}
        <option value="{{ a5.idinterpretacion }}" >  {{ a5.codigo }} - {{ a5.nombre }} </option> 		
  {% endfor %}
    </select>
    <p>Decision: </p><select name="decisionm1[{{ an2.idanalito }}]" >
    {% for a7 in decisioncontrol[an2.idanalito] %}
        <option value="{{ a7.iddecision }}" >  {{ a7.codigo }} - {{ a7.nombre }} </option> 		
   {% endfor %}
    </select>
    
    <h3>#Control: {{ muestras[1].descripcion }} </h3>
    <p> Resultado:</p> <input name='resultadom2[{{ an2.idanalito }}]' type='text' /> 
        <p>Interpretacion: </p><select name="interpretacionm2[{{ an2.idanalito }}]" >
    {% for a6 in interpretacioncontrol2[an2.idanalito] %}
        <option value="{{ a6.idinterpretacion }}" >  {{ a6.codigo }} - {{ a6.nombre }} </option> 		
   {% endfor %}
    </select>
    <p>Decision:</p> <select name="decisionm2[{{ an2.idanalito }}]" >
    {% for a8 in decisioncontrol2[an2.idanalito] %}
        <option value="{{ a8.iddecision }}" >  {{ a8.codigo }} - {{ a8.nombre }} </option> 		
   {% endfor %}
    </select>
        <p> Comentario: <input name='comentarios[{{ an2.idanalito }}]' type='text' /> </p>
    <hr>
{% endfor %}
    <input type="submit" value="Enviar" name="envioresultado">

</form>