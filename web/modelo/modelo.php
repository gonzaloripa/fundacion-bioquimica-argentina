<?php


function conectarBD(){
	$db_host="us-cdbr-iron-east-05.cleardb.net";  
	$db_user="b1af2a304e1c89"; 
	$db_pass="82fa88df";
	$db_base="heroku_628730ed0e1616a";    
	$cn = new PDO("mysql:dbname=$db_base;host=$db_host",
	$db_user,$db_pass);
	return $cn;
}


function devolverRol($usuario) {
    $cn = conectarBD();
    $query = 'Select * from usuarios where usuario= :usuario';
    $result = $cn->prepare($query);
    $result->execute(array(":usuario" => $usuario));
    $cn = null;
    $result = $result->fetch(PDO::FETCH_OBJ);
    return $result->rol;
}

function obtenerTiposPruebas() {
    $cn = conectarBD();
    $query2 = 'Select * from analito';
    $result = $cn->query($query2);
    $cn = null;
    return $result;
}

function devolverEncuestas() {
    $cn = conectarBD();
    $query2 = 'Select * from encuesta';
    $result = $cn->query($query2);
    $cn = null;
    return $result;
}

function insertarLaboratorio($codigo, $institucion, $sector, $responsable, $domicilio, $domiciliocorresp, $ciudad, $pais, $codigopostal, $tipoPrueba, $email, $telfax, $fechaingreso, $tipolab, $empresa, $estado) {
    $cn = conectarBD();
    $query = "INSERT INTO laboratorio (codigo,institucion,sector,responsable,domicilio,domicilio_correspondencia,ciudad,pais,codigopostal,email,telefono_fax,fechaingreso,tipolaboratorio,empresa,estado) VALUES (:codigo,:institucion,:sector,:responsable,:domicilio,:domicilio_correspondencia,:ciudad,:pais,:codigopostal,:email,:telefono_fax,:fechaingreso,:tipolaboratorio,:empresa,:estado)";
    $result = $cn->prepare($query);
    $result->execute(array(":codigo" => $codigo, ":institucion" => $institucion, ":sector" => $sector, ":responsable" => $responsable, ":domicilio" => $domicilio, ":domicilio_correspondencia" => $domiciliocorresp, ":ciudad" => $ciudad, ":pais" => $pais, ":codigopostal" => $codigopostal, ":email" => $email, ":telefono_fax" => $telfax, ":tipolaboratorio" => $tipolab, ":fechaingreso" => $fechaingreso, ":empresa" => $empresa, ":estado" => $estado));


    $query2 = "SELECT * FROM laboratorio where codigo = :codigo";
    $result2 = $cn->prepare($query2);
    $result2->execute(array(":codigo" => $codigo));
    $result2 = $result2->fetch(PDO::FETCH_OBJ);
    $idlaboratorio = $result2->idlaboratorio;
    if (!$result2) {
        print "Error 2";
    }
    //print $idlab->fetchAll();

    foreach ($tipoPrueba as $tp) {
        $query3 = 'INSERT INTO analitosinscriptos (idlaboratorio,idanalito) VALUES (:idlaboratorio ,:tipoPrueba)';
        $result3 = $cn->prepare($query3);
        //print $tp;
        $result3->execute(array("idlaboratorio" => $idlaboratorio, ":tipoPrueba" => $tp));
        if (!$result3) {
            print "Error 3";
        }
    }
    $cn = null;
}

function obtenerLaboratorios() {
    $cn = conectarBD();
    $query = 'SELECT * FROM laboratorio';
    $result = $cn->query($query);
    $cn = null;
    return $result;
}

function obtenerInfoLab($idlaboratorio) {
    $cn = conectarBD();
    $query = 'Select * from laboratorio where idlaboratorio= :idlaboratorio';
    $result = $cn->prepare($query);

    $result->execute(array(":idlaboratorio" => $idlaboratorio));
    $result = $result->fetch();
    $cn = null;
    return $result;
}

function modificarLaboratorio($codigo, $institucion, $sector, $responsable, $domicilio, $domiciliocorresp, $ciudad, $pais, $codigopostal, $email, $telfax, $empresa, $tipolab, $tipoPrueba) {
    echo $codigo;
    $cn = conectarBD();
    $query2 = "SELECT * FROM laboratorio where codigo = :codigo";
    $result2 = $cn->prepare($query2);
    $result2->execute(array(":codigo" => $codigo));
    $result2 = $result2->fetch(PDO::FETCH_OBJ);
    $idlaboratorio = $result2->idlaboratorio;
    if (!$result2) {
        print "Error 2";
    }



    $query = "UPDATE laboratorio SET codigo=:codigo,institucion=:institucion,sector=:sector,responsable=:responsable,domicilio=:domicilio,domicilio_correspondencia=:domicilio_correspondencia,ciudad=:ciudad,pais=:pais,codigopostal=:codigopostal,email=:email,telefono_fax=:telefono_fax,empresa=:empresa,tipolaboratorio=:tipolaboratorio where idlaboratorio=:idlaboratorio";
    $result = $cn->prepare($query);
    $result->execute(array(":codigo" => $codigo, ":institucion" => $institucion, ":sector" => $sector, ":responsable" => $responsable, ":domicilio" => $domicilio, ":domicilio_correspondencia" => $domiciliocorresp, ":ciudad" => $ciudad, ":pais" => $pais, ":codigopostal" => $codigopostal, ":email" => $email, ":telefono_fax" => $telfax, ":empresa" => $empresa, ":tipolaboratorio" => $tipolab, ":idlaboratorio" => $idlaboratorio));
    if (!$result) {
        print "Error 2";
    }

    $query3 = "DELETE FROM analitosinscriptos where idlaboratorio = :idlaboratorio";
    $result3 = $cn->prepare($query3);
    $result3->execute(array(":idlaboratorio" => $idlaboratorio));

    echo $tipoPrueba;
    foreach ($tipoPrueba as $tp) {

        $query4 = 'INSERT INTO analitosinscriptos (idlaboratorio,idanalito) VALUES (:idlaboratorio ,:tipoPrueba)';
        $result4 = $cn->prepare($query4);
        echo $idlaboratorio;
        $result4->execute(array("idlaboratorio" => $idlaboratorio, ":tipoPrueba" => $tp));
        if (!$result3) {
            print "Error 3";
        }
    }

    $cn = null;
}

function obteneridLaboratorio($usuario) {
    $cn = conectarBD();
    $query = 'Select * from usuarios where usuario= :usuario';
    $result = $cn->prepare($query);
    $result->execute(array(":usuario" => $usuario));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result->idlaboratorio;
}

function IDLaboratorio($codigo) {
    $cn = conectarBD();
    $query = 'Select * from laboratorio where codigo= :codigo';
    $result = $cn->prepare($query);
    $result->execute(array(":codigo" => $codigo));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result->idlaboratorio;
}

function bajaLab($lab) {
    $cn = conectarBD();
    $query = 'UPDATE laboratorio SET estado="inactivo" where idlaboratorio=:lab';
    $result = $cn->prepare($query);
    $result->execute(array(":lab" => $lab));
    $cn = null;
}

function obtenerEstado($lab) {
    $cn = conectarBD();
    $query = 'Select * from laboratorio where idlaboratorio= :lab';
    $result = $cn->prepare($query);
    $result->execute(array(":lab" => $lab));
    $result = $result->fetch(PDO::FETCH_OBJ);
    if (!$result) {
        print "Error 2";
    }
    $cn = null;
    //print $result->idlaboratorio;	
    return $result->estado;
}

/* function obtenerFechamax($lab){
  $cn= conectarBD();
  $query= 'Select MAX(fecha_inscripcion) as fecha_maxima from inscripcion where idlaboratorio= :lab ';
  $result = $cn->prepare($query);
  $result->execute(array(":lab" => $lab));
  $result=$result->fetch(PDO::FETCH_OBJ);
  $cn=null;
  return $result->fecha_maxima;

  }
 */

function obtenerIdencuesta($fecha_max) {
    $cn = conectarBD();
    $query = 'Select * from inscripcion where fecha_inscripcion= :fecha_max';
    $result = $cn->prepare($query);
    $result->execute(array(":fecha_max" => $fecha_max));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result->idencuesta;
}

function almacenarhistorial($lab, $idultimaencuesta, $fecha_actual, $accion) {
    $cn = conectarBD();
    $query = 'INSERT INTO historiallaboratorio (idlaboratorio,accion,fecha,idencuesta) VALUES (:idlab,:accion,:fecha_ingreso,:idulti)';
    $result = $cn->prepare($query);
    $result->execute(array(":idlab" => $lab, ":accion" => $accion, "fecha_ingreso" => $fecha_actual, "idulti" => $idultimaencuesta));
    $cn = null;
}
// depecrado
/*
function almacenarhistorialAlta($lab, $fecha_actual, $accion, $fi) {
    $cn = conectarBD();
    $query = 'INSERT INTO historiallaboratorio (idlaboratorio,accion,fecha) VALUES (:idlab,:accion,:fecha_ingreso,:)';
    $result = $cn->prepare($query);
    $result->execute(array(":idlab" => $lab, ":accion" => $accion, "fecha_ingreso" => $fecha_actual, "fecha_ingreso" => $fi));
    $cn = null;
}
*/
function devolverIDrol($usuario) {
    $cn = conectarBD();
    $query = 'Select * from usuarios where usuario= :usuario';
    $result = $cn->prepare($query);
    $result->execute(array(":usuario" => $usuario));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result->idrol;
}

function retornarRol($idrol) {
    $cn = conectarBD();
    $query = 'Select * from roles where idrol= :idrol';
    $result = $cn->prepare($query);
    $result->execute(array(":idrol" => $idrol));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result->rol;
}

function fechaIngresoLab($lab) {
    $cn = conectarBD();
    $query = 'Select * from laboratorio where idlaboratorio=:lab';
    $result = $cn->prepare($query);
    $result->execute(array(":lab" => $lab));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result->fechaingreso;
}

function ultimaEncuesta() {
    $cn = conectarBD();

    $query = 'select idencuesta from encuesta where fecha_inicio = (Select MAX(fecha_inicio) from encuesta)';
    $result = $cn->query($query);
    $result = $result->fetch();
    $cn = null;
    return $result;
}

function existeLab($codigo) {
    $cn = conectarBD();
    $query = 'Select * from laboratorio where codigo=:codigo';
    $result = $cn->prepare($query);
    $result->execute(array(":codigo" => $codigo));
    $result = $result->fetch(PDO::FETCH_OBJ);
    return ($result->idlaboratorio != '');
}

function reinscribirLab($lab) {
    $cn = conectarBD();
    $query = "UPDATE laboratorio SET estado='activo' where idlaboratorio=:lab";
    $result = $cn->prepare($query);
    $result->execute(array(":lab" => $lab));
    $cn = null;
}

function ObtenerLabsInactivos() {
    $cn = conectarBD();
    $query = "SELECT * FROM laboratorio where estado='inactivo'";
    $result = $cn->query($query);
    $cn = null;
    return $result;
}

function TiposPruebasSelec($pLab) {
    $cn = conectarBD();
    $query = "SELECT * FROM analitosinscriptos ai inner join analito a on (ai.idanalito=a.idanalito) where idlaboratorio=:lab";
    $result = $cn->prepare($query);
    $result->execute(array(":lab" => $pLab));
    $cn = null;
    //print $result;
    return $result;
}

/** Rodri */
function traerDatosUsuarios() {
    $con = ConectarBD();
    $consulta = "select * from usuarios";
    $datos = $con->query($consulta);
    $cn = null;
    return $datos;
}

/** Modelo Login * */
function validarDatos($userIngresado, $passIngresado) {

    $cn = ConectarBD();
    $result = $cn->prepare("SELECT * FROM usuarios WHERE usuario = :usuario AND contrasena = :pass ");
    $result->execute(array(":usuario" => $userIngresado, ":pass" => $passIngresado));
    $result = $result->fetch();
    $cn = null;
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function asignaDatosSesion($userIngresado, $passIngresado) {
    $cn = ConectarBD();
    $query = $cn->prepare("SELECT * FROM usuarios WHERE usuario = '" . $userIngresado . "' AND contrasena = '" . $passIngresado . "' ");
    $query->execute();
    $result = $query->fetch();
    if ($result) {
        $iduser = $result['idusuario'];
        $user = $result['usuario'];
        $pass = $result['contrasena'];
        $rol = $result['idrol'];
        $email = $result['email'];
        $nombre = $result['nombre'];
        $apellido = $result['apellido'];
        $idlaboratorio = $result['idlaboratorio'];
        $nuevaSession = array('idusuario' => $iduser, 'usuario' => $user, 'contrasena' => $pass, 'rol' => $rol, 'email' => $email, 'nombre' => $nombre, 'apellido' => $apellido, 'idlaboratorio' => $idlaboratorio);
    }
    return $nuevaSession;
}

/*
  function logueadoConRol($ses,$rol){
  if (isset($ses)){
  if ($ses['rol']==$rol){
  return true;
  }else{
  return false;
  }
  }else{
  return false;
  }
  }
 */

function nombreRol($idrol) {
    $cn = ConectarBD();
    $query = "SELECT * FROM roles WHERE idrol = :idrol ";
    $result = $cn->prepare($query);
    $result->execute(array(":idrol" => $idrol));
    $result = $result->fetch(PDO::FETCH_OBJ);
    return $result->rol;
}

/* * * rol */

function validarRol($rolIngresado) {
    if (!$rolIngresado) {//No escribi� nada
        $msj = "Ingrese el nombre del rol que desa agregar";
    } else {
        $cn = ConectarBD();
        $query = $cn->prepare("SELECT * FROM roles WHERE rol = '" . $rolIngresado . "'");
        $query->execute();
        $result = $query->fetch();
        if ($result) {
            $msj = "Ya existe el un rol con ese nombre!";
        } else {//No existe ningun rol igual en la base
            insertarRol($rolIngresado);
            $msj = "Se ha ingresado el nuevo Rol con exito";
        }
    }
    return $msj;
    $cn = null;
}

function traeRoles() {
    $cn2 = ConectarBD();
    $query2 = "SELECT * FROM roles";
    $result2 = $cn2->query($query2);
    $cn2 = null;
    return $result2;
}

function InsertarRol($rolIngresado) {
    $cn = ConectarBD();
    $query = $cn->prepare("INSERT INTO roles(rol) VALUES ('" . $rolIngresado . "')");
    $query->execute();
    $cn = null;
}

function traeLabs() {
    $cn = ConectarBD();
    $query = "SELECT * FROM laboratorio";
    $result = $cn->query($query);
    $cn = null;
    return $result;
}

function traerUsuario($buscado) {
    $cn = ConectarBD();
    $query = $cn->prepare("SELECT * FROM usuarios WHERE usuario = '" . $buscado . "'");
    $query->execute();
    $result = $query->fetch();
    if ($result) {
        $devuelve = false;
    } else {
        $devuelve = true;
    }
    return $devuelve;
}

function insertarUsuario($usuario, $contrasena, $idRol, $nombre, $apellido, $email, $idLab) {
    $cn = ConectarBD();
    $query = $cn->prepare("INSERT INTO usuarios(usuario, contrasena, idrol, apellido, nombre, idlaboratorio, email) VALUES (:usuario,:contrasena,:idrol,:apellido,:nombre,:idlab,:email)");
    $query->execute(Array(":usuario"=>$usuario,":contrasena"=>$contrasena, ":idrol"=>$idRol, ":apellido"=>$apellido, ":nombre"=>$nombre,":idlab"=>$idLab, ":email"=>$email,));
    $cn = null;
}

/* * * Ripa */

/*** Ripa */
  function obtenerEncuestasLab($idLab){
    $cn = conectarBD();
    
    $query = 'Select distinct(encuesta.idencuesta),encuesta.* from encuesta  inner join resultadodeprueba on (encuesta.idencuesta = resultadodeprueba.idencuesta) where resultadodeprueba.idlaboratorio= :idLab';
    $result = $cn->prepare($query);
    $result->execute(array(":idLab" => $idLab));
    $cn = null;
    return $result;
}
function obtenerIdAnalito($codigo){
    $cn= conectarBD();
	$query= 'Select * from analito where codigo= :codigo';
	$result = $cn->prepare($query);
	$result->execute(array(":codigo" => $codigo));
	$result=$result->fetch(PDO::FETCH_OBJ);
	$cn=null;	
	return $result->idanalito;
}

function obtenerCodigoAnalito($idanalito){
	$cn= conectarBD();
	$query= 'Select * from analito where idanalito= :idanalito';
	$result = $cn->prepare($query);
	$result->execute(array(":idanalito" => $idanalito));
	$result=$result->fetch(PDO::FETCH_OBJ);
	$cn=null;	
	return $result->codigo;
}

function obtenerAnalitos(){
	$cn= conectarBD();
	$query2='Select * from analito';
	$result= $cn->query($query2);
	$cn=null;
	return $result;	
}

function existeAnalito($codigo){
        
	$cn= conectarBD();
	$query= 'Select * from analito where codigo=:codigo';
	$result = $cn->prepare($query);
	$result->execute(array(":codigo"=> $codigo));
	$result=$result->fetch(PDO::FETCH_OBJ);
	$cn=null;
	return ($result->idanalito!= '');
}
function existeMetodo($codigo,$idanalito){
	$cn= conectarBD();
	$query= 'Select * from metodo where codigo=:codigo and idanalito = :idanalito';
	$result = $cn->prepare($query);
	$result->execute(array(":codigo"=> $codigo,":idanalito"=>$idanalito));
	$result=$result->fetch(PDO::FETCH_OBJ);
	return ($result->idmetodo!= '');
}
function existeReactivo($codigo,$idanalito){
	$cn= conectarBD();
	$query= 'Select * from reactivo where codigo=:codigo and idanalito = :idanalito';
	$result = $cn->prepare($query);
	$result->execute(array(":codigo"=> $codigo,":idanalito"=>$idanalito));
	$result=$result->fetch(PDO::FETCH_OBJ);
	return ($result->idreactivo!= '');
}
function existeCalibrador($codigo,$idanalito){
	$cn= conectarBD();
	$query= 'Select * from calibrador where codigo=:codigo and idanalito = :idanalito';
	$result = $cn->prepare($query);
	$result->execute(array(":codigo"=> $codigo,":idanalito"=>$idanalito));
	$result=$result->fetch(PDO::FETCH_OBJ);
	return ($result->idcalibrador!= '');
}
function existePapelFiltro($codigo,$idanalito){
	$cn= conectarBD();
	$query= 'Select * from papelfiltro where codigo=:codigo and idanalito = :idanalito';
	$result = $cn->prepare($query);
	$result->execute(array(":codigo"=> $codigo,":idanalito"=>$idanalito));
	$result=$result->fetch(PDO::FETCH_OBJ);
	return ($result->idpapelfiltro!= '');
}
function existeInterpretacion($codigo,$idanalito){
	$cn= conectarBD();
	$query= 'Select * from interpretacion where codigo=:codigo and idanalito = :idanalito';
	$result = $cn->prepare($query);
	$result->execute(array(":codigo"=> $codigo,":idanalito"=>$idanalito));
	$result=$result->fetch(PDO::FETCH_OBJ);
	return ($result->idinterpretacion!= '');
}
function existeDecision($codigo,$idanalito){
	$cn= conectarBD();
	$query= 'Select * from decision where codigo=:codigo and idanalito = :idanalito';
	$result = $cn->prepare($query);
	$result->execute(array(":codigo"=> $codigo,":idanalito"=>$idanalito));
	$result=$result->fetch(PDO::FETCH_OBJ);
	return ($result->iddecision!= '');
}


function altaAnalito($nombre,$codigo){
 $cn=ConectarBD();
 $query="INSERT INTO analito(nombre,codigo) VALUES(:nombre,:codigo)";
 $result=$cn->prepare($query);
 $result->execute(array(":nombre"=>$nombre,":codigo"=>$codigo));
 if (!$result) {
    	print "Error 1";
 	}
 $cn=null;
}
function altaMetodo($nombre,$codigo,$idanalito){
 $cn=ConectarBD();
 $query="INSERT INTO metodo(nombre,codigo,idanalito) VALUES(:nombre,:codigo,:idanalito)";
 $result=$cn->prepare($query);
 $result->execute(array(":nombre"=>$nombre,":codigo"=>$codigo,":idanalito"=>$idanalito));
 if (!$result) {
    	print "Error 1";
 	}
 $cn=null;
}

function altaReactivo($nombre,$codigo,$idanalito){
 $cn=ConectarBD();
 $query="INSERT INTO reactivo(nombre,codigo,idanalito) VALUES(:nombre,:codigo,:idanalito)";
 $result=$cn->prepare($query); 
 $result->execute(array(":nombre"=>$nombre,":codigo"=>$codigo,":idanalito"=>$idanalito));
 if (!$result) {
    	print "Error 1";
 	}
 $cn=null;
}
function altaCalibrador($nombre,$codigo,$idanalito){
 $cn=ConectarBD();
 $query="INSERT INTO calibrador(nombre,codigo,idanalito) VALUES(:nombre,:codigo,:idanalito)";
 $result=$cn->prepare($query); 
 $result->execute(array(":nombre"=>$nombre,":codigo"=>$codigo,":idanalito"=>$idanalito));
 if (!$result) {
    	print "Error 1";
 	}
 $cn=null;
}
function altaPapelFiltro($nombre,$codigo,$idanalito){
 $cn=ConectarBD();
 $query="INSERT INTO papelfiltro(nombre,codigo,idanalito) VALUES(:nombre,:codigo,:idanalito)";
 $result=$cn->prepare($query);
 $result->execute(array(":nombre"=>$nombre,":codigo"=>$codigo,":idanalito"=>$idanalito));
 if (!$result) {
    	print "Error 1";
 	}
 $cn=null;
}
function altaValorCorte($nombre,$codigo,$idanalito){
 $cn=ConectarBD();
 $query="INSERT INTO valorcorte(nombre,codigo,idanalito) VALUES(:nombre,:codigo,:idanalito)";
 $result=$cn->prepare($query); 
 $result->execute(array(":nombre"=>$nombre,":codigo"=>$codigo,":idanalito"=>$idanalito));
 if (!$result) {
    	print "Error 1";
 	}
 $cn=null;
}
function altaInterpretacion($nombre,$codigo,$idanalito){
 $cn=ConectarBD();
 $query="INSERT INTO interpretacion(nombre,codigo,idanalito) VALUES(:nombre,:codigo,:idanalito)";
 $result=$cn->prepare($query);
 $result->execute(array(":nombre"=>$nombre,":codigo"=>$codigo,":idanalito"=>$idanalito));
 if (!$result) {
    	print "Error 1";
 	}
 $cn=null;
}
function altaDecision($nombre,$codigo,$idanalito){
 $cn=ConectarBD();
 $query="INSERT INTO decision(nombre,codigo,idanalito) VALUES(:nombre,:codigo,:idanalito)";
 $result=$cn->prepare($query);
 $result->execute(array(":nombre"=>$nombre,":codigo"=>$codigo,":idanalito"=>$idanalito));
 if (!$result) {
    	print "Error 1";
 	}
 $cn=null;
}


function bajaAnalito($idanalito){
	$cn= conectarBD();
	$query= 'DELETE a,m,r,c,pf,i,d FROM analito AS a LEFT JOIN metodo AS m on (a.idanalito = m.idanalito)LEFT JOIN reactivo AS r on (a.idanalito = r.idanalito)LEFT JOIN calibrador AS c on (a.idanalito = c.idanalito)LEFT JOIN papelfiltro AS pf on (a.idanalito = pf.idanalito)LEFT JOIN interpretacion AS i on (a.idanalito = i.idanalito)LEFT JOIN decision AS d on (a.idanalito = d.idanalito) WHERE a.idanalito=:analito';
	$result= $cn->prepare($query);
	$result->execute(array(":analito" => $idanalito));
	$cn=null;

}
function bajaMetodo($idmetodo){
	$cn= conectarBD();
	$query= 'DELETE FROM metodo where idmetodo=:metodo';
	$result= $cn->prepare($query);
	$result->execute(array(":metodo" => $idmetodo));
	$cn=null;
}
function bajaReactivo($idreactivo){
	$cn= conectarBD();
	$query= 'DELETE FROM reactivo where idreactivo=:reactivo';
	$result= $cn->prepare($query);
	$result->execute(array(":reactivo" => $idreactivo));
	$cn=null;
}
function bajaCalibrador($idcalibrador){
	$cn= conectarBD();
	$query= 'DELETE FROM calibrador where idcalibrador=:calibrador';
	$result= $cn->prepare($query);
	$result->execute(array(":calibrador" => $idcalibrador));
	$cn=null;
}
function bajaPapelFiltro($idpapelfiltro){
	$cn= conectarBD();
	$query= 'DELETE FROM papelfiltro where idpapelfiltro=:papelfiltro';
	$result= $cn->prepare($query);
	$result->execute(array(":papelfiltro" => $idpapelfiltro));
	$cn=null;
}
function bajaInterpretacion($idinterpretacion){
	$cn= conectarBD();
	$query= 'DELETE FROM interpretacion where idinterpretacion=:interpretacion';
	$result= $cn->prepare($query);
	$result->execute(array(":interpretacion" => $idinterpretacion));
	$cn=null;
}
function bajaDecision($iddecision){
	$cn= conectarBD();
	$query= 'DELETE FROM decision where iddecision=:decision';
	$result= $cn->prepare($query);
	$result->execute(array(":decision" => $iddecision));
	$cn=null;
}


 function modificarAnalito($nombrenue,$codigonue,$codigo){
	$cn= conectarBD();
	
	$query2= "SELECT * FROM analito where codigo = :codigo";
	$idan = $cn->prepare($query2);
	$idan->execute(array(":codigo" => $codigo));
	$idan=$idan->fetch(PDO::FETCH_OBJ);
	$idanalito=$idan->idanalito;

	$query= "UPDATE analito SET codigo=:codigonue, nombre=:nombrenue where idanalito=:idanalito" ;
	$result = $cn->prepare($query);		
	$result->execute(array(":codigonue" => $codigonue,":nombrenue" => $nombrenue,":idanalito"=>$idanalito));
	
	$cn=null;
}

 function modificarMetodo($nombrenue,$codigonue,$codigoant,$idan){
	$cn= conectarBD();
	
	$query2= "SELECT * FROM metodo where codigo = :codigo and idanalito = :idanalito ";
	$idmet = $cn->prepare($query2);
	$idmet->execute(array(":codigo" => $codigoant, ":idanalito" => $idan));
	$idmet=$idmet->fetch(PDO::FETCH_OBJ);
	$idmetodo=$idmet->idmetodo;

	$query= "UPDATE metodo SET codigo=:codigo, nombre=:nombre where idmetodo=:idmetodo" ;
	$result = $cn->prepare($query);		
	$result->execute(array(":codigo" => $codigonue,":nombre" => $nombrenue,":idmetodo"=>$idmetodo));
	
	$cn=null;
}

 function modificarReactivo($nombrenue,$codigonue,$codigoant,$idan){
	$cn= conectarBD();
	
	$query2= "SELECT * FROM reactivo where codigo = :codigo and idanalito = :idanalito ";
	$idre = $cn->prepare($query2);
	$idre->execute(array(":codigo" => $codigoant,":idanalito" => $idan));
	$idre=$idre->fetch(PDO::FETCH_OBJ);
	$idreactivo=$idre->idreactivo;

	$query= "UPDATE reactivo SET codigo=:codigo, nombre=:nombre where idreactivo=:idreactivo" ;
	$result = $cn->prepare($query);		
	$result->execute(array(":codigo" => $codigonue,":nombre" => $nombrenue,":idreactivo"=>$idreactivo));
	
	$cn=null;
}

 function modificarCalibrador($nombrenue,$codigonue,$codigoant,$idan){
	$cn= conectarBD();
	
	$query2= "SELECT * FROM calibrador where codigo = :codigo and idanalito = :idanalito ";
	$idca = $cn->prepare($query2);
	$idca->execute(array(":codigo" => $codigoant,":idanalito" => $idan));
	$idca=$idca->fetch(PDO::FETCH_OBJ);
	$idcalibrador=$idca->idcalibrador;

	$query= "UPDATE calibrador SET codigo=:codigo, nombre=:nombre where idcalibrador=:idcalibrador" ;
	$result = $cn->prepare($query);		
	$result->execute(array(":codigo" => $codigonue,":nombre" => $nombrenue,":idcalibrador"=>$idcalibrador));
	
	$cn=null;
}

 function modificarPapelFiltro($nombrenue,$codigonue,$codigoant,$idan){
	$cn= conectarBD();
	
	$query2= "SELECT * FROM papelfiltro where codigo = :codigo and idanalito = :idanalito ";
	$idpf = $cn->prepare($query2);
	$idpf->execute(array(":codigo" => $codigoant, ":idanalito" => $idan));
	$idpf=$idpf->fetch(PDO::FETCH_OBJ);
	$idpapelfiltro=$idpf->idpapelfiltro;

	$query= "UPDATE papelfiltro SET codigo=:codigo, nombre=:nombre where idpapelfiltro=:idpapelfiltro" ;
	$result = $cn->prepare($query);		
	$result->execute(array(":codigo" => $codigonue,":nombre" => $nombrenue,":idpapelfiltro"=>$idpapelfiltro));
	
	$cn=null;
}
 function modificarInterpretacion($nombrenue,$codigonue,$codigoant,$idan){
	$cn= conectarBD();
	
	$query2= "SELECT * FROM interpretacion where codigo = :codigo and idanalito = :idanalito ";
	$idint = $cn->prepare($query2);
	$idint->execute(array(":codigo" => $codigoant, ":idanalito" => $idan));
	$idint=$idint->fetch(PDO::FETCH_OBJ);
	$idinterpretacion=$idint->idinterpretacion;

	$query= "UPDATE interpretacion SET codigo=:codigo, nombre=:nombre where idinterpretacion=:idinterpretacion" ;
	$result = $cn->prepare($query);		
	$result->execute(array(":codigo" => $codigonue,":nombre" => $nombrenue,":idinterpretacion"=>$idinterpretacion));
	
	$cn=null;
}

 function modificarDecision($nombrenue,$codigonue,$codigoant,$idan){
	$cn= conectarBD();
	
	$query2= "SELECT * FROM decision where codigo = :codigo and idanalito = :idanalito ";
	$iddec = $cn->prepare($query2);
	$iddec->execute(array(":codigo" => $codigoant, ":idanalito" => $idan));
	$iddec=$iddec->fetch(PDO::FETCH_OBJ);
	$iddecision=$iddec->iddecision;

	$query= "UPDATE decision SET codigo=:codigo, nombre=:nombre where iddecision=:iddecision" ;
	$result = $cn->prepare($query);		
	$result->execute(array(":codigo" => $codigonue,":nombre" => $nombrenue,":iddecision"=>$iddecision));
	
	$cn=null;
}




//ultimoRodri



function obtenerUsuarios() {
    $cn = conectarBD();
    $query = 'SELECT u.idusuario,u.email, u.nombre,u.apellido,u.usuario,u.contrasena,la.institucion,r.rol FROM usuarios u inner join roles r on (u.idrol=r.idrol) left join laboratorio la on (u.idlaboratorio=la.idlaboratorio)';
    $result = $cn->prepare($query);
    $result->execute();
    //$result=$result->fetch();
    $cn = null;
    return $result->fetchAll();
}

function obtenerUsuario($idusuario) {
    $cn = conectarBD();
    $query = 'Select * from usuarios u inner join roles r on (u.idrol=r.idrol) where idusuario= :idusuario';
    $result = $cn->prepare($query);
    $result->execute(array(":idusuario" => $idusuario));
    $cn = null;
    return $result->fetch();
}



function modificarUsuario($usuarioold,$usuario,$contrasena,$idRol,$nombre,$apellido,$email,$idLab) {
    $cn = conectarBD();
    $query = "UPDATE usuarios SET usuario=:usuario, nombre=:nombre, contrasena=:contrasena, idlaboratorio=:idLab , email=:email, apellido=:apellido, idrol=:idRol  where usuario=:id";
    $result = $cn->prepare($query);
    $result->execute(array(":usuario" => $usuario, ":nombre" => $nombre, ":contrasena" => $contrasena, ":idLab" => $idLab, ":email" => $email, ":apellido" => $apellido, ":idRol" => $idRol, ":id" => $usuarioold));

    $cn = null;
}

function borrarUsuario($idusuario){
    $cn = conectarBD();
    $query = 'DELETE FROM usuarios where idusuario=:idusuario';
    $result = $cn->prepare($query);
    $result->execute(array(":idusuario" => $idusuario));
    $cn = null;
}
function obtenerLaboratoriosActivos(){
    $cn = conectarBD();
    $query = "SELECT * FROM laboratorio where estado='activo'";
    $result = $cn->query($query);
    $cn = null;
    return $result;
}
function obtenerHistorial(){
     $cn = conectarBD();
    $query = "SELECT * FROM historiallaboratorio hl inner join laboratorio l on (hl.idlaboratorio=l.idlaboratorio) left join encuesta e on (hl.idencuesta=e.idencuesta)";
    $result = $cn->query($query);
    $cn = null;
    return $result;
}
function obtenerIdMuestras($idencuesta){
    $cn = conectarBD();
    $query = 'Select * From muestra where idencuesta=:idencuesta ';
    $result = $cn->prepare($query);
    $result->execute(array(":idencuesta" => $idencuesta));
    $cn = null;
    return $result->fetchAll();
}
function insertarResultadoPrueba($idlab,$idencuesta,$idanalito,$metodo,$calibrador,$reactivo,$papeldefiltro,$valorcorte,$comentario,$fecharecepcion,$fechaanalisis,$fecharesultados){
    $cn = ConectarBD();
    $query = $cn->prepare("INSERT INTO resultadodeprueba(idlaboratorio,idencuesta,idanalito,idmetodo,idcalibrador,idreactivo,idpapelfiltro,valorcorte,comentario,fecharecepcion,fechaanalisis,fechaingreso) VALUES (:idlab,:idencuesta,:idanalito,:metodo,:calibrador,:reactivo,:papeldefiltro,:valorcorte,:comentario,:fecharecepcion,:fechaanalisis,:fecharesultados)"); 
    $query->execute(Array(":idlab"=>$idlab,":idencuesta"=>$idencuesta, ":idanalito"=>$idanalito, ":metodo"=>$metodo, ":calibrador"=>$calibrador,":reactivo"=>$reactivo, ":papeldefiltro"=>$papeldefiltro,":valorcorte"=>$valorcorte,":comentario"=>$comentario,":fecharecepcion"=>$fecharecepcion,":fechaanalisis"=>$fechaanalisis,":fecharesultados"=>$fecharesultados));
    $cn = null;
    
}
function insertarResultadoMuestra($idmuestra,$idResP,$resultadom1,$decisionm1,$interpretacionm1){
    $cn = ConectarBD();
    $query = $cn->prepare("INSERT INTO resultadodemuestra(idmuestra,idprueba,resultadocontrol,iddecision,idinterpretacion) VALUES (:idmuestra,:idprueba,:idresultadocontrol,:iddecision,:idinterpretacion) ");
    $query->execute(Array(":idmuestra"=>$idmuestra,":idprueba"=>$idResP,":idresultadocontrol"=>$resultadom1,":iddecision"=>$decisionm1,":idinterpretacion"=>$interpretacionm1));
    $cn = null;
    
}  
function obtenerResultadoPrueba($idlab,$idencuesta,$idanalito){
    $cn = conectarBD();
    $query = 'Select * from resultadodeprueba where idlaboratorio=:idlaboratorio and idencuesta=:idencuesta and idanalito=:idanalito';
    $result = $cn->prepare($query);
    $result->execute(array(":idlaboratorio" => $idlab,":idencuesta" => $idencuesta,":idanalito" => $idanalito));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result->idprueba;
}

function existeResultado($idlab,$idencuesta){
    $cn = conectarBD();
    $query = 'Select * from resultadodeprueba where idlaboratorio=:idlaboratorio and idencuesta=:idencuesta';
    $result = $cn->prepare($query);
    $result->execute(array(":idlaboratorio" => $idlab,":idencuesta" => $idencuesta));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return ($result->idlaboratorio != '');
}


function encuestaActivas($fa) {
    $cn = conectarBD();
    $query = 'Select * from encuesta where fecha_fin > :fa';
    $result = $cn->prepare($query);
    $result->execute(array(":fa" => $fa));
    //$result = $result->fetch();
    $cn = null;
    return $result;
}
function insertarMuestra($muestra1,$descripcionm1,$idencuesta){
    $cn = ConectarBD();
    $query = $cn->prepare("INSERT INTO muestra(idmuestra,descripcion,idencuesta) VALUES (:idmuestra,:descripcionm1,:idencuesta) ");
    $query->execute(Array(":idmuestra"=>$muestra1,":descripcionm1"=>$descripcionm1,":idencuesta"=>$idencuesta));
    $cn = null;
}
function insertarEncuesta($fechainicio,$fechafin){
    $cn = ConectarBD();
    $query = $cn->prepare("INSERT INTO encuesta(fecha_inicio,fecha_fin) VALUES (:fechainicio,:fechafin) ");
    $query->execute(Array(":fechainicio"=>$fechainicio,":fechafin"=>$fechafin));
    $cn = null;
}
function obtenerEncuesta($fechainicio,$fechafin){
    $cn = conectarBD();
    $query2 = "SELECT * FROM encuesta where fecha_inicio=:fechainicio and fecha_fin=:fechafin";
    $result = $cn->prepare($query2);
    $result->execute(array(":fechainicio" => $fechainicio,":fechafin" => $fechafin));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result->idencuesta;
}
function existeEncuesta($fechainicio,$fechafin){
    $cn = conectarBD();
    $query = 'Select * from encuesta where fecha_inicio=:fechainicio and fecha_fin=:fechafin';
    $result = $cn->prepare($query);
    $result->execute(array(":fechainicio" => $fechainicio,":fechafin" => $fechafin));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn=null;
    return($result->idencuesta != '');
}
function obtenerEncuestas(){
    $cn = conectarBD();
    $query = 'Select * from encuesta';
    $result = $cn->query($query);
    $cn = null;
    return $result;
}

function obtenerResultado($ide,$idl){
    $cn = conectarBD();
    $query = 'Select * from resultadodeprueba where idencuesta=:ide and idlaboratorio=:idl';
    $result = $cn->prepare($query);
    $result->execute(array(":ide" => $ide, ":idl" => $idl));
    $cn = null;
    return $result;
}

function obtenerResultadosEncuestas($idencuesta){
    $cn= conectarBD();
    $query= 'SELECT * FROM resultadodeprueba r left join laboratorio l on (r.idlaboratorio=l.idlaboratorio) GROUP BY idencuesta, r.idlaboratorio HAVING r.idencuesta = :idencuesta';
    $result = $cn->prepare($query);
    $result->execute(array(":idencuesta" => $idencuesta));
    $cn = null;
    return $result;
}
function obtenerIDAnalitos($idencuesta,$idlaboratorio){
    $cn= conectarBD();
    $query= 'SELECT r.* , a.nombre AS nombreanalito, m.nombre AS nombremetodo, re.nombre AS nombrereactivo, c.nombre AS nombrecalibrador, pf.nombre AS nombrepapelfiltro, rm.*, mues.*, d.nombre AS nombredecision, i.nombre as nombreinterpretacion 
           FROM resultadodeprueba r 
           INNER JOIN analito a ON ( r.idanalito = a.idanalito ) 
           INNER JOIN metodo m ON ( r.idmetodo = m.idmetodo ) 
           INNER JOIN reactivo re ON ( r.idreactivo = re.idreactivo ) 
           INNER JOIN calibrador c ON ( r.idcalibrador = c.idcalibrador ) 
           INNER JOIN papelfiltro pf ON ( r.idpapelfiltro = pf.idpapelfiltro ) 
           INNER JOIN resultadodemuestra rm ON ( r.idprueba = rm.idprueba ) 
           inner join muestra mues on (mues.idmuestra = rm.idmuestra) 
           inner join decision d on (rm.iddecision=d.iddecision) 
           inner join interpretacion i on (rm.idinterpretacion=i.idinterpretacion) 
           where r.idencuesta=:idencuesta and idlaboratorio=:idlaboratorio ';
    $result = $cn->prepare($query);
    $result->execute(array(":idencuesta" => $idencuesta,":idlaboratorio" => $idlaboratorio));
    $cn = null;
    return $result;
}
function ObtenerAnalitosNull($idencuesta){
    $cn= conectarBD();
    $query= 'SELECT r.* , a.nombre AS nombreanalito, m.nombre AS nombremetodo, re.nombre AS nombrereactivo, c.nombre AS nombrecalibrador, pf.nombre AS nombrepapelfiltro, rm.*, mues.*, d.nombre AS nombredecision, i.nombre as nombreinterpretacion 
           FROM resultadodeprueba AS r 
           INNER JOIN analito a ON ( r.idanalito = a.idanalito ) 
           INNER JOIN metodo m ON ( r.idmetodo = m.idmetodo ) 
           INNER JOIN reactivo re ON ( r.idreactivo = re.idreactivo ) 
           INNER JOIN calibrador c ON ( r.idcalibrador = c.idcalibrador ) 
           INNER JOIN papelfiltro pf ON ( r.idpapelfiltro = pf.idpapelfiltro ) 
           INNER JOIN resultadodemuestra rm ON ( r.idprueba = rm.idprueba ) 
           inner join muestra mues on (mues.idmuestra = rm.idmuestra) 
           inner join decision d on (rm.iddecision=d.iddecision) 
           inner join interpretacion i on (rm.idinterpretacion=i.idinterpretacion) 
           where r.idencuesta=:idencuesta and idlaboratorio is null ';
    $result = $cn->prepare($query);
    $result->execute(array(":idencuesta" => $idencuesta));
    $cn = null;
    return $result;
}

function validarLabInactivo($user){
    $cn = conectarBD();
    $query = "Select * from usuarios u inner join laboratorio l on (u.idlaboratorio=l.idlaboratorio) where usuario=:user and estado='inactivo'";
    $result = $cn->prepare($query);
    $result->execute(array(":user"=>$user));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result->idusuario!='';   
}
function obtenerAnalitosPar($idlab){
	$cn= conectarBD();
	$query2= "SELECT * FROM analitosinscriptos ai INNER JOIN analito a on (ai.idanalito=a.idanalito) where idlaboratorio=:idlab";
	$result = $cn->prepare($query2);
	$result->execute(array(":idlab"=>$idlab));	
	$cn=null;
	return $result;
	
}
function obtenerMetodosid($idanalito){
	$cn= conectarBD();
	$query= 'Select * from metodo where idanalito=:idanalito';
	$result = $cn->prepare($query);
	$result->execute(array(":idanalito" => $idanalito));
	$cn=null;
	return $result;
}
function obtenerReactivosid($idanalito){
	$cn= conectarBD();
	$query= 'Select * from reactivo where idanalito=:idanalito';
	$result = $cn->prepare($query);
	$result->execute(array(":idanalito" => $idanalito));
	$cn=null;
	return $result;
}
function obtenerCalibradoresid($idanalito){
	$cn= conectarBD();
	$query= 'Select * from calibrador where idanalito=:idanalito';
	$result = $cn->prepare($query);
	$result->execute(array(":idanalito" => $idanalito));
	$cn=null;
	return $result;
}
function obtenerPapelesdeFiltro($idanalito){
	$cn= conectarBD();
	$query= 'Select * from papelfiltro where idanalito=:idanalito';
	$result = $cn->prepare($query);
	$result->execute(array(":idanalito" => $idanalito));
	$cn=null;
	return $result;
}
function obtenerValoresdeCorte($idanalito){
	$cn= conectarBD();
	$query= 'Select * from valorcorte where idanalito=:idanalito';
	$result = $cn->prepare($query);
	$result->execute(array(":idanalito" => $idanalito));
	$cn=null;
	return $result;
}
function obtenerDecisionesControl($idanalito){
	$cn= conectarBD();
	$query= 'Select * from decision where idanalito=:idanalito';
	$result = $cn->prepare($query);
	$result->execute(array(":idanalito" => $idanalito));
	$cn=null;
	return $result;
}
function obtenerInterpretacionesControl($idanalito){
	$cn= conectarBD();
	$query= 'Select * from interpretacion where idanalito=:idanalito';
	$result = $cn->prepare($query);
	$result->execute(array(":idanalito" => $idanalito));
	$cn=null;
	return $result;
	}
  function obtenerResultadoPruebaNull($idencuesta,$idanalito){
     $cn = conectarBD();
    $query = 'Select * from resultadodeprueba where idlaboratorio is NULL and idencuesta=:idencuesta and idanalito=:idanalito';
    $result = $cn->prepare($query);
    $result->execute(array(":idencuesta" => $idencuesta,":idanalito" => $idanalito));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result->idprueba;
}
 function validarfecha($dia, $mes){
    $ok=true;
        if($mes== "04" or $mes== "06" or $mes== "09" or $mes=="11"){
            if($dia== "31"){
                $ok=false;
            }else{
                $ok=true;
                }
        }else{
            if($mes== "02"){
                if($dia > "28"){
                    $ok=false;
                }else{$ok=true;}
            }
        }
        return $ok;
  }
  function comparafechas($diai,$mesi,$anoi,$diaf,$mesf,$anof){
    $ok=true;
    if($anof < $anoi){
        $ok=false;
        }else{
            if($anoi==$anof){
                if($mesi > $mesf){
                    $ok=false;
                }else{
                    if($mesi==$mesf){
                        if($diai > $diaf){
                            $ok=false;
                        }
                    }
                }    
            }
        }
        return $ok;
  }
  

  function obtenerAnalitoFBA($analitosFBA,$idan){
      $cn = conectarBD();
      $query = 'Select * from :analitosFBA where idanalito=:idan';
      $result = $cn->prepare($query);
       $result->execute(array(":analitosFBA" => $analitosFBA, ":idan" => $idan));
      $result = $result->fetch(PDO::FETCH_OBJ);
      $cn = null;
      return $result;
  }

function obtenerEncuestasid($idlab){
    $cn = conectarBD();
    $query = 'Select * from encuesta where idlaboratorio=:idlab';
    $result = $cn->prepare($query);
    $result->execute(array(":idlab" => $idlab));
    $cn = null;
    return $result;
}

function obtenerFechaEnvio($idencuesta){
    $cn = conectarBD();
    $query = 'Select * from encuesta where idencuesta=:idencuesta';
    $result = $cn->prepare($query);
    $result->execute(array(":idencuesta" => $idencuesta));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result->fecha_inicio;
}

function obtenerResultadosPruebas($idlab,$idencuesta){
    $cn = conectarBD();
    $query = 'Select  * from resultadodeprueba where idlaboratorio=:idlaboratorio and idencuesta=:idencuesta';
    $result = $cn->prepare($query);
    $result->execute(array(":idlaboratorio" => $idlab,":idencuesta" => $idencuesta));
    $cn = null;
    return $result->fetchAll();
}
function contarTotalLab(){
    $cn = conectarBD();
    $query = 'select count * from laboratorio';
    $result = $cn->prepare($query);
    $result->execute();
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result;
}

function fueraDeTermino($idencuesta){
    $cn = conectarBD();
    $query = 'select count * from resultadodeprueba r inner join encuesta e on(r.idencuesta=e.idencuesta) where e.idencuesta=:idencuesta and r.fechaingreso > e.fecha_fin';
    $result = $cn->prepare($query);
    $result->execute(array(":idencuesta"=>$idencuesta));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result;    
}

function fechaini($idencuesta){
    $cn = conectarBD();
    $query = "select fecha_inicio from encuesta where idencuesta=:idencuesta";
    $result = $cn->prepare($query);
    $result->execute(array(":idencuesta" => $idencuesta));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result;
}

function fechafin($idencuesta){
    $cn = conectarBD();
    $query = "select fecha_fin from encuesta where idencuesta=:idencuesta";
    $result = $cn->prepare($query);
    $result->execute(array(":idencuesta" => $idencuesta));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result;
}

function obtenerParticipantes($idencuesta){
     $fi=fechaini($idencuesta);
    $ff=fechafin($idencuesta);
     $cn = conectarBD();
    $query = "select count * from laboratorio as l inner join historiallaboratorio as hl on (l.idlaboratorio = hl.idlaboratorio) where hl.accion='baja' and hl.fecha is between :fi and :ff";
    $debaja = $cn->prepare($query);
    $debaja->execute(array(":idencuesta" => $idencuesta, ":fi"=> $fi, ":ff"=> $ff));
    $debaja = $debaja->fetch(PDO::FETCH_OBJ);
    $totalLab=contarTotalLab();

    return ($totalLab-$debaja);
}

////+Nuevo
function obtenerLaboratorios1(){
    $cn = conectarBD();
    $query = 'Select * from laboratorio l inner join analitosinscriptos an on(l.idlaboratorio=an.idlaboratorio) group by l.idlaboratorio having count(*)=1  ';
    $result = $cn->query($query);
    $cn = null;
    return $result;
}
function obtenerLaboratoriosvarios(){
    $cn = conectarBD();
    $query = 'Select * from laboratorio l inner join analitosinscriptos an on(l.idlaboratorio=an.idlaboratorio) group by l.idlaboratorio having count(*)>1  ';
    $result = $cn->query($query);
    $cn = null;
    return $result;
}
function obtenerLaboratoriosOrdenado() {
    $cn = conectarBD();
    $query = 'SELECT * FROM laboratorio order by codigo';
    $result = $cn->query($query);
    $cn = null;
    return $result;
}
function obtenerLaboratorioscant() {
    $cn = conectarBD();
    $query = 'SELECT count(*) as cant FROM laboratorio';
    $result = $cn->query($query);
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result->cant;
}
function obtenerLaboratoriosReinscriptos(){
    $cn = conectarBD();
    $query = 'SELECT DISTINCT (
l.idlaboratorio
), l . *
FROM laboratorio l
INNER JOIN historiallaboratorio hl ON ( l.idlaboratorio = hl.idlaboratorio )
WHERE (

SELECT count( * )
FROM historiallaboratorio h
WHERE h.idlaboratorio = l.idlaboratorio
) >1';
    $result = $cn->query($query);
    $cn = null;
    return $result;
}

function estaActivo($lab){
    $cn = conectarBD();
    $query = "SELECT * from laboratorio where idlaboratorio=:lab";
    $result = $cn->prepare($query);
    $result->execute(array(":lab" => $lab));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return ($result->estado=='activo');
}

function obtenerFechaFinEcuesta($idenc){
    $cn = conectarBD();
    $query = "Select * from encuesta where idencuesta =:idenc";
    $result = $cn->prepare($query);
    $result->execute(array(":idenc" => $idenc));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result->fecha_fin;
}
function obtenerCantidadEncuestas ($fechafin) {
    $cn = conectarBD();
    $query = 'SELECT count(*) as cant FROM laboratorio where fechaingreso <= :fechafin';
    $result = $cn->prepare($query);
    $result->execute(array(":fechafin" => $fechafin));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result->cant;
    
}
function obtenerCantidadContestadas ($fechafin) {
    $cn = conectarBD();
    $query = 'SELECT count(*) as cant FROM laboratorio l where fechaingreso <= :fechafin AND EXISTS (Select * from resultadodeprueba rp where rp.idlaboratorio = l.idlaboratorio)';
    $result = $cn->prepare($query);
    $result->execute(array(":fechafin" => $fechafin));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result->cant;
}


function obtenerCantidadContestadasA ($fechafin,$idanalito){
    $cn = conectarBD();
    $query = 'SELECT count(*) as cant FROM laboratorio l where fechaingreso <= :fechafin AND EXISTS (Select * from resultadodeprueba rp where rp.idlaboratorio = l.idlaboratorio and rp.idanalito=:idanalito)';
    $result = $cn->prepare($query);
    $result->execute(array(":fechafin" => $fechafin,":idanalito" => $idanalito));
    $result = $result->fetch(PDO::FETCH_OBJ);
    $cn = null;
    return $result->cant;
}

function insertarResultadoMuestra2($idmuestra1,$idmuestra2,$idResP,$resultadom1,$decisionm1,$interpretacionm1){
    $cn = ConectarBD();
    $query = $cn->prepare("INSERT INTO resultadodemuestra(idmuestra,idprueba,resultadocontrol,iddecision,idinterpretacion) VALUES (:idmuestra,:idprueba,:idresultadocontrol,:iddecision,:idinterpretacion) ");
    $query->execute(Array(":idmuestra"=>$idmuestra1,":idprueba"=>$idResP,":idresultadocontrol"=>$resultadom1,":iddecision"=>$decisionm1,":idinterpretacion"=>$interpretacionm1));
    $query2 = $cn->prepare("INSERT INTO resultadodemuestra(idmuestra,idprueba,resultadocontrol,iddecision,idinterpretacion) VALUES (:idmuestra,:idprueba,:idresultadocontrol,:iddecision,:idinterpretacion) ");
    $query2->execute(Array(":idmuestra"=>$idmuestra2,":idprueba"=>$idResP,":idresultadocontrol"=>$resultadom1,":iddecision"=>$decisionm1,":idinterpretacion"=>$interpretacionm1));
    
    $cn = null;
    
}  
?>