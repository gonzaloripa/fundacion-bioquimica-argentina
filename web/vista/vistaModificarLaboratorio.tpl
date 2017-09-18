<br>
  <h3>.Modifique los datos del laboratorio </h3>
<br>
<form name="altalab" action="modificarLaboratorio.php" method="post">
    
 <p>Codigo: <input name='codigo' type="text" value="{{ laboratorio.codigo }}" readonly="readonly" /> </p>
<p>Institucion: <input name='institucion' type="text" value="{{ laboratorio.institucion }}"  /> </p>
<p>Sector: <input name='sector' type="text" value="{{ laboratorio.sector }}"   /> </p>
<p>Responsable: <input name='responsable' type="text" value="{{ laboratorio.responsable }}"   /> </p>
<p>Domicilio: <input name='domicilio' type="text" value="{{ laboratorio.domicilio }}"   /> </p>
<p>Domicilio para correspondencia: <input name='domicilio_corresp' type="text" value="{{ laboratorio.domiciliocorresp }}"    /> </p>
<p>Ciudad: <input name='ciudad' type="text" value="{{ laboratorio.responsable }}"    /> </p>
<p>Pais: <input name='pais' type="text" value="{{ laboratorio.pais }}"    /> </p>
<p>Codigo Postal: <input name='codigopostal' type="text" value="{{ laboratorio.codigopostal }}"   /> </p>
<p>Prueba: </p>{% for var in tiposPruebas %}
<input type="checkbox" name='prueba[]' value="{{ var.idanalito }}"  /> {{var.codigo}} - {{var.nombre}}  <br>  {% endfor %}
<p> Email: <input name='email' type="text" value="{{ laboratorio.email }}"    />
<p>Telefono/Fax: <input name='telfax' type="text" value="{{ laboratorio.telefono_fax }}"    />
<p>Tipo de Laboratorio: <select name="tipolab" >
<option {% if laboratorio.tipolaboratorio=="Pesquisa Neonatal" %} selected {% endif %} value="Pesquisa Neonatal"> Pesquisa Neonatal  </option> 
<option {% if laboratorio.tipolaboratorio=="Confirmacion" %} selected {% endif %} value="Confirmacion"> Confirmacion  </option> 
<option {% if laboratorio.tipolaboratorio=="Distribuidor Reactivos" %} selected {% endif %} value="Distribuidor Reactivos"> Distribuidor de Reactivos </option> 
</select>
<p> Empresa: <input name='empresa' type="text"  value="{{ laboratorio.empresa }}"   />
<p> <input name="modificarenvio" type="submit" value="Enviar"  />  <input name="borrartodo" type="button" value="Borrar Todo" onClick="document.getElementsByName('altalab')[0].reset();" />
</form>