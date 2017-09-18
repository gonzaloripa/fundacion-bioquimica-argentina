<br>
  <h3>.Listado de los ususarios registrados en el sistema</h3>
<br>
<table>
<tr>
    <td>Nombre</td>
    <td>Apellido</td>
    <td>Usuario</td>
    <td>Contraseña</td>
    <td>Email</td>
    <td>Rol</td>
    <td>Laboratorio</td>
    <td></td>
    <td></td> 
</tr>
{% for us in usuarios %}
<tr> 
    <td>{{us.nombre}} </td>
    <td>{{us.apellido}} </td>
    <td>{{us.usuario}} </td>
    <td>{{us.contrasena}} </td>
    <td>{{us.email}} </td>
    <td>{{us.rol}} </td>
    <td>{{us.institucion}} </td>
    <td><a href="../controlador/controladorModificarUsuario.php?modificar={{us.idusuario}}"> Modificar </a> </td>
    <td><a href="../controlador/controladorBajaUsuario.php?borrar={{us.idusuario}}"> Borrar </a> </td>
</tr>
{% endfor %}
</table>