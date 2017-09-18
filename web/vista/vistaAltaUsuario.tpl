<br>
  <h3>.Llene el formulario para agregar un nuevo usuario al sistema</h3>
<br>
<form name="altaUsr" action="../controlador/validarAltaUsuario.php" method="post">
<!--<p>{% if msj is defined %}
        {% if msj != "logueado" %}
            {{msj}}
        {% endif %}
            
    {% else %}
        {{ "Por favor ingrese los datos del nuevo usuario" }}
    {% endif %}</p>-->
    <p class="error">{% if error is defined %}
    {{error}}
    {% endif %}</p>
    <p> Rol: 
        <select name="idRol" onchange="if (this.value == '2') {
                                                        document.getElementById('lab').style.display = '';
                                                    } else {
                                                        document.getElementById('lab').style.display = 'none';
                                                    }">
            <option value=0> (-Seleccione un Rol-) </option>
{% for var in roles %}
                <option value="{{var.idrol}}">{{var.rol}}  </option> {% endfor%}
        </select></p>
    <p> Usuario: <input name="usuario" type="text" value="{% if usuario is defined %}
    {{usuario}}
{% endif %}"/></p>
    <p> Contrase&nacute;a: <input name="contrasena" type="password" value="{% if contrasena is defined %}
                {{contrasena}}
            {% endif %}" /></p>
    <p> Nombre: <input name="nombre" type="text" value="{% if nombre is defined %}
                {{nombre}}
            {% endif %}"/></p>
    <p> Apellido: <input name="apellido" type="text" value="{% if apellido is defined %}
                {{apellido}}
            {% endif %}"/></p>
    <p id="lab" style="display: none"> Laboratorio: 
        <select name="idlab"> 
{% for var2 in lab %}
                <option value="{{var2.idlaboratorio}}">{{var2.institucion}}  </option> {% endfor%}
        </select>
    <p> E-Mail: <input name="email" type="text" value="{% if email is defined %}
    {{email}}
{% endif %}"/></p>
    <p> <input name="ingresar" type="submit" value="Ingresar"  /> 
    </p>
</form>
