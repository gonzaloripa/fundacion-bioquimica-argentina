
<form name="altaUsr" action="../controlador/controladorModificarUsuario.php" method="post">
    <input name="usuarioold" value="{{infoUsuario.usuario}}" hidden="true" >
    <p> Rol: 
        <select name="idRol" onchange="if (this.value == '2') {
                    document.getElementById('lab').style.display = ''
                } else {
                    document.getElementById('lab').style.display = 'none'
                }">

{% for var in roles %}
                <option {% if var.idrol == infoUsuario.idrol %} selected {% endif %} value="{{var.idrol}}">{{var.rol}}  </option> {% endfor %}
        </select></p>
    <p> Usuario: <input name="usuario" type="text" value="{{infoUsuario.usuario}}"/></p>
    <p> Contrase&nacute;a: <input name="contrasena" type="password" value="{{infoUsuario.contrasena}}" /></p>
    <p> Nombre: <input name="nombre" type="text" value="{{infoUsuario.nombre}}"/></p>
    <p> Apellido: <input name="apellido" type="text" value="{{infoUsuario.apellido}}"/></p>
    <p id="lab" {% if infoUsuario.rol != "personalLAB" %} style="display: none" {% endif %} > Laboratorio: 
        <select name="idlab"> 
{% for var2 in lab %}
                <option  {% if var.idlaboratorio== infoUsuario.idlaboratorio %} selected {% endif %} value="{{var2.idlaboratorio}}">{{var2.institucion}}  </option> {% endfor %}
        </select>
    <p> E-Mail: <input name="email" type="text" value="{{infoUsuario.email}}"/></p>
    <p> <input name="modificarenvio" type="submit" value="Ingresar"  /> 
    </p>
</form>
