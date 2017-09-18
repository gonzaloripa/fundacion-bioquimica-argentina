<form name="modTablas" method="post" autocomplete="off" action="modificarTablas.php"> 
  <h3>- Ingrese los nuevos datos </h3>
  <input type="hidden" name="codviejo" value="{{codviejo}}"> 
  <input type="hidden" name="nomviejo" value="{{nombre}}">
  <input type="hidden"  name="idanalito" value="{{idan}}">
  <input type="hidden" name="secambio" value="{{cambio}}">
  <div ><h3>Codigo Analito:<input type="text" name="analito" value="{{codigoan}}" readonly="readonly" ></h3> </div>
  <div > <h3>Codigo:<input type="text" name="codigo"  value="{{codigo}}" required='required'></h3> </div> 
  <div > <h3>Nombre:<input type="text" name="nombre"  value="{{nombre}}" required='required'></h3> </div> 
  
 <input class="boton" name="modenvio" type="submit"  value="Enviar"> 
  <input class="boton" name="volver" type="button" value="Volver Atras" onclick="redirec('../controlador/altaTablas.php?agregartablas={{idan|trim}}')">
</form>