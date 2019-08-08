<?php
    require_once "config.php";
    require "functions.php";

    $conexion = conexion_db($bd_config);

    $nombre = limpiarTexto($_POST['nombre']);
    $apellido = limpiarTexto($_POST['apellido']);
	$correo = limpiarCorreo($_POST['email']);
    $clave = $_POST['clave'];
    $clave_cifrada = password_hash($clave, PASSWORD_DEFAULT);
    $conf_clave = $_POST['clave2'];
    $conf_clave_cifrada = password_hash($conf_clave, PASSWORD_DEFAULT);

    validar_clave($clave,$error_clave);

    if ($nombre === '' || $apellido === '' || $correo === '' || $clave === '' || $conf_clave === '') {
        echo json_encode("Error: debes completar todos los campos");
    } elseif ($clave != $conf_clave) {
        echo json_encode("Error: Las claves no coinciden");
    } elseif ($error_clave) {
      echo json_encode("Error: " . $error_clave);  
    } else {
        echo json_encode($nombre . " te haz registrado con éxito");
        
        insertarUsuario($conexion, $nombre, $apellido, $correo, $clave_cifrada);
    }
