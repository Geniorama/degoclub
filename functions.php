<?php 

function conexion_db($bd_config){
	try{
		$conexion_db = new PDO("mysql:host=localhost;dbname=" . $bd_config['basedatos'], $bd_config['usuario'], $bd_config['pass']);
		return $conexion_db;
	} catch (PDOException $e){
		return false;
	}
}


function comprobar_sesion(){
	if (isset($_SESSION['usuario'])) {
		header('Location: login.php');
	}
}

function limpiarTexto($dato)
{
	$dato = filter_var($dato, FILTER_SANITIZE_STRING);

	return $dato;
}

function limpiarCorreo($correo)
{

	$correo = filter_var($correo, FILTER_SANITIZE_EMAIL);

	return $correo;
}


function portafolio_por_id($conexion, $id){
	$resultado = $conexion->query("SELECT * FROM portafolio WHERE idportafolio = $id LIMIT 1");
	$resultado = $resultado->fetchall();
	return ($resultado) ? $resultado : false;
}

function validar_clave($clave,&$error_clave){
    if(strlen($clave) < 6){
       $error_clave = "La clave debe tener al menos 6 caracteres";
       return false;
    }
    if(strlen($clave) > 16){
       $error_clave = "La clave no puede tener más de 16 caracteres";
       return false;
    }
    if (!preg_match('`[a-z]`',$clave)){
       $error_clave = "La clave debe tener al menos una letra minúscula";
       return false;
    }
    if (!preg_match('`[A-Z]`',$clave)){
       $error_clave = "La clave debe tener al menos una letra mayúscula";
       return false;
    }
    if (!preg_match('`[0-9]`',$clave)){
       $error_clave = "La clave debe tener al menos un caracter numérico";
       return false;
    }
    $error_clave = "";
    return true;
 }

 function consultarCorreo($conexion, $usuario)
	{		
			$consultar = 'SELECT * FROM users WHERE (correo = :correo)';
			$comprobacion = $conexion->prepare($consultar);
			$comprobacion->execute(array(':correo' => $usuario));
			$resultadoConsulta = $comprobacion->fetch();

			return ($resultadoConsulta) ? $resultadoConsulta : false;
    }
    


 function consultarUsuario($conexion, $usuario_consulta, $clave_consulta)
	{		
			$consultar = 'SELECT * FROM users WHERE (correo = :correo) AND (clave = :clave)';
			$comprobacion = $conexion->prepare($consultar);
			$comprobacion->execute(array(':correo' => $usuario_consulta, ':clave' => $clave_consulta));
			$resultadoConsulta = $comprobacion->fetch();

			return ($resultadoConsulta) ? $resultadoConsulta : false;
    }


function insertarUsuario($conexion, $nombre, $apellido, $correo, $clave)
	{		
			$insertar = 'INSERT INTO users (nombre, apellido, correo, clave) VALUES (:nombre, :apellido, :correo, :clave)';
			$agregar = $conexion->prepare($insertar);
			$agregar->execute(array(
				':nombre' => $nombre,
				':apellido' => $apellido,
				':correo' => $correo,
				':clave' => $clave
 			));
	}
?>