<br>
  <h3>.Impresión de etiquetas para el envío de correspondencia</h3>
<br>
<form name="labsimpresion" action="controladorImpresionEtiquetas.php" method="POST" target= "_blank"> 
    
<h1>Seleccion de Laboratorios </h1>
<table>
<tr>
	<td>codigo:</td>
	<td>institucion:</td>
	<td>ciudad:</td>
	<td>pais:</td>
	<td></td>	

        <td><a onclick="elem=document.getElementsByName('laboratorios[]');for(i=0;i<elem.length;i++){elem[i].checked=1;}">[ Seleccionar Todos ]</a><br><a onclick="elem=document.getElementsByName('laboratorios[]');for(i=0;i<elem.length;i++){elem[i].checked=0;}">[ Desmarcar Todos ]</a></td>
</tr>
{% for laboratorio in laboratorios %} 
<tr>
	<td>{{ laboratorio.codigo}}</td>
	<td>{{ laboratorio.institucion}}</td>
	<td>{{ laboratorio.ciudad}}</td>
	<td>{{ laboratorio.pais}}</td>
	<td><a href="../controlador/consultadeLaboratorio.php?consulta={{ laboratorio.idlaboratorio}}"> + Informacion </a> </td>

        <td><input type="checkbox" name="laboratorios[]" value="{{ laboratorio.idlaboratorio}}" /> </td>
</tr>		
	{% endfor %}
</table>

<h1>Seleccion de Etiquetas </h1>
 <table> 
<tr>
    <td></td>
    <td><a onclick="elem=document.getElementsByName('etiquetas[]');for(i=0;i<elem.length;i++){elem[i].checked=1;}">[ Seleccionar Todos ]</a><br><a onclick="elem=document.getElementsByName('etiquetas[]');for(i=0;i<elem.length;i++){elem[i].checked=0;}">[ Desmarcar Todos ]</a></td>
</tr>
<tr>
    <td>codigo:</td>
    <td><input type="checkbox" name="etiquetas[]"  value="codigo" /></td>
</tr>
<tr>
<td>institucion:</td>
    <td><input type="checkbox" name="etiquetas[]"  value="institucion" /></td>
</tr>
<tr>
<td>sector:</td>
    <td><input type="checkbox" name="etiquetas[]"  value="sector" /></td>
</tr>
<tr>
<td>responsable:</td>
    <td><input type="checkbox" name="etiquetas[]"  value="responsable" /></td>
</tr>
<tr>
<td>domicilio:</td>
    <td><input type="checkbox" name="etiquetas[]"  value="domicilio" /></td>
</tr>
<tr>
<td>domicilio de correspondencia:</td>
    <td><input type="checkbox" name="etiquetas[]"  value="domicilio_correspondencia" /></td>
</tr>
<tr>
    <td>ciudad:</td>
    <td><input type="checkbox" name="etiquetas[]"  value="ciudad" /></td>
</tr>
<tr>	
<td>pais:</td>
<td><input type="checkbox" name="etiquetas[]"  value="pais" /></td>
</tr>
<tr>
<td>codigo postal:</td>
    <td><input type="checkbox" name="etiquetas[]"  value="codigopostal" /></td>
</tr>
<tr>
<td>Analito/s Inscripto/s:</td>
    <td><input type="checkbox" name="etiquetas[]"  value="analitos" /></td>
</tr>
<tr>
<td>email:</td>
    <td><input type="checkbox" name="etiquetas[]"  value="email" /></td>
</tr>
<tr>
<td>telefono/fax:</td>
    <td><input type="checkbox" name="etiquetas[]"  value="telefono_fax" /></td>
</tr>
<tr>
<td>tipo de laboratorio:</td>
    <td><input type="checkbox" name="etiquetas[]"  value="tipolaboratorio" /></td>
</tr>
<tr>
<td>empresa:</td>
    <td><input type="checkbox" name="etiquetas[]"  value="empresa" /></td>
</tr>   
 </table>

<input name="enviar" type="submit" value="Imprimir"   /> 
</form>