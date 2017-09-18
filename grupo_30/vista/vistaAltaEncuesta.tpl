<form name="altaencuesta" action="altaEncuesta.php" method="post">
   <input name="fechainicio" type="text"  value="{{fechainicio}}" hidden/>
    <input name="fechafin" type="text" value="{{fechafin}}" hidden/> 
    <input name="idmuestra1" type="text" value="{{  idmuestra1 }}" hidden/>
   <input name="descripcionm1" type="text" value="{{  descripcionm1 }}" hidden/>
<input name="idmuestra2" type="text" value="{{ idmuestra2 }}" hidden />
     <input name="descripcionm2" type="text" value="{{ descripcionm2 }}" hidden /> </p>

     
    
{% for an2 in analitosexistentes2 %}
        <h2> {{ an2.nombre }} </h2> 
        <p>Metodo: <select name="metodo[{{ an2.idanalito }}]" >  </p>
        {% for a in metodos[an2.idanalito] %}
            <option value="{{ a.idmetodo }}" >  {{ a.codigo }} - {{ a.nombre }} </option>     	
        {% endfor %}
    </select>
    <p>Calibrador: <select name="calibrador[{{ an2.idanalito }}]" ></p>
    {% for a2 in calibrador[an2.idanalito] %}
        <option value="{{ a2.idcalibrador }}" >  {{ a2.codigo }} - {{ a2.nombre }} </option> 		
    {% endfor %}
    </select>
    <p>Reactivos: <select name="reactivo[{{ an2.idanalito }}]" ></p>
    {% for a3 in reactivos[an2.idanalito] %}
        <option value="{{ a3.idreactivo }}" >  {{ a3.codigo }} - {{ a3.nombre }} </option> 		
    {% endfor %}
    </select>
    <p>Papel de Filtro: <select name="papeldefiltro[{{ an2.idanalito }}]" ></p>
    {% for a4 in papeldefiltro[an2.idanalito] %}
        <option value="{{ a4.idpapelfiltro }}" >  {{ a4.codigo }} - {{ a4.nombre }} </option> 		
    {% endfor %}
    </select>
    <p> Valor de Corte: <input name="valorcorte[{{ an2.idanalito }}]" type ="text"> </p>

    <h1> Resultado: </h1>
    <h3>#Control: {{ descripcionm1 }} </h3>
    <p> Resultado: <input name="resultadom1{{ an2.idanalito }}]" type='text' /> </p>
    <p>Interpretacion: <select name="interpretacionm1[{{ an2.idanalito }}]" ></p>
    {% for a5 in interpretacioncontrol[an2.idanalito] %}
        <option value="{{ a5.idinterpretacion }}" >  {{ a5.codigo }} - {{ a5.nombre }} </option> 		
    {% endfor %}
    </select>
    <p>Decision: <select name="decisionm1[{{ an2.idanalito }}]" ></p>
    {% for a7 in decisioncontrol[an2.idanalito] %}
        <option value="{{ a7.iddecision }}" >  {{ a7.codigo }} - {{ a7.nombre }} </option> 		
    {% endfor %}
    </select>

    <h3>#Control: {{  descripcionm2 }} </h3>
    <p> Resultado: <input name='resultadom2[{{ an2.idanalito }}]' type='text' /> </p>
        <p>Interpretacion: <select name="interpretacionm2[{{ an2.idanalito }}]" ></p>
    {% for a6 in interpretacioncontrol2[an2.idanalito] %}
        <option value="{{ a6.idinterpretacion }}" >  {{ a6.codigo }} - {{ a6.nombre }} </option> 		
    {% endfor %}
    </select>
    <p>Decision: <select name="decisionm2[{{ an2.idanalito }}]" ></p>
    {% for a8 in decisioncontrol2[an2.idanalito] %}
        <option value="{{ a8.iddecision }}" >  {{ a8.codigo }} - {{ a8.nombre }} </option> 		
    {% endfor %}
    </select>
        <p> Comentario: <input name='comentarios[{{ an2.idanalito }}]' type='text' /> </p>
    <hr>
{% endfor %}
    <input type="submit" value="Enviar" name="envioresultadoencuesta">

</form>