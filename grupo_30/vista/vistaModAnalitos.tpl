<form name="modAnalitos" method="post" autocomplete="off" action="modificarAnalitos.php"> 
  <h3>- Ingrese los nuevos datos </h3>
   <input type="hidden" name="codviejo" value="{{codviejo}}">
   <input type="hidden" name="nomviejo" value="{{nombre}}">
  <div ><h3>Codigo:<input type="text" name="codigo" value="{{codigo}}" required='required'></h3> </div>
  <div > <h3>Nombre:<input type="text" name="nombre"  value="{{nombre}}" required='required'></h3> </div> 
  
 
 <input class="boton" name="modenvioan" type="submit" value="Enviar">  
 <input class="boton" name="volver" type="button" value="Volver Atras" onclick="redirec('../controlador/altaAnalitos.php')">  
</form>