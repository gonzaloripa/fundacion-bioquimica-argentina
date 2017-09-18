<p>Codigo de laboratorio: <input name='codigo' type='text' value="{{laboratorio.codigo}}" readonly="readonly"  /> </p>
<p>Institucion: <input name='institucion' type="text" value="{{laboratorio.institucion}}" readonly="readonly" /> </p>
<p>Sector: <input name='sector' type="text" value="{{laboratorio.sector}}"  readonly="readonly" /> </p>
<p>Responsable: <input name='responsable' type="text" value="{{laboratorio.responsable}}"  readonly="readonly" /> </p>
<p>Domicilio: <input name='domicilio' type="text" value="{{laboratorio.domicilio}}"  id="domicilio" readonly="readonly" /> </p>
<p>Ciudad: <input name='ciudad' type="text" value="{{laboratorio.ciudad}}" id="ciudad1" readonly="readonly" /> </p>
<p>Pais: <input name='pais' type="text" value="{{laboratorio.pais}}"  id="pais1" readonly="readonly" /> </p>
<div id="map_canvas" style="width: 300px; height: 200px;"></div>
<p>Codigo Postal: <input name='codigopostal' type="text" value="{{laboratorio.codigopostal}}"  readonly="readonly" /> </p>
<p>Prueba: </p><ul>{% for var in tiposPruebasSeleccionados %}
<li> {{var.codigo}} - {{var.nombre}}  <br> </li> {% endfor %}</ul>
<p> Email: <input name='email' type="text" value="{{laboratorio.email}}"   readonly="readonly" />
<p>Telefono/Fax: <input name='telfax' type="text" value="{{laboratorio.telefono_fax}}"   readonly="readonly" />
<p>Tipo de Laboratorio:
    <input name='tipolab' value="{{laboratorio.tipolaboratorio}}"  readonly="readonly"/>
<p> Empresa: <input name='empresa' type="text"  value="{{laboratorio.empresa}}"  readonly="readonly" />