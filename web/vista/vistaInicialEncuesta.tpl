<br>
  <h3 >.Complete los campos para agregar una nueva encuesta</h3>
<br>
<form name="inicialencuesta" action="controladorAgregarEncuestaInicio.php" method="Post">
     <p>Fecha de Inicio:  
        <select name="dia_ini" class="fecha">
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
        <select name="mes_ini" class="fecha">
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
        <select name="fechainicio" class="fecha">
        {% for i in 2013..2050 %} 
        <option value="{{i }}" >{{i }}</option> 
           {% endfor %}
        </select>
        </p>
        <p>Fecha de Fin:  
        <select name="dia_fin" class="fecha">
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
        <select name="mes_fin" class="fecha">
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
        <select name="fechafin" class="fecha">
        {% for i in 2013..2050 %}
        <option value="{{i }}" >{{i }}</option> 
           {% endfor %}
        </select>
        </p>    
        <a href="../controlador/controladorLaboratoriosActivos.php">Ver Laboratorios Participantes</a> 
    <hr>
    <p> Numero de Muestra 1: <input name="idmuestra1" type="text"  value="{{idmuestra1}}"/> </p>
    <p> Descripcion: <input name="descripcionm1" type="text"  value="{{descripcionm1}}"/> </p>
    <hr>
    <p> Numero de Muestra 2: <input name="idmuestra2" type="text" value="{{idmuestra2}}"/> </p>
    <p> Descripcion: <input name="descripcionm2" type="text" value="{{descripcionm2}}" /> </p>
    <p> <input name="encuestainicial" type ="submit" value="Enviar" /> </p>
</form>