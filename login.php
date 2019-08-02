<?php

require 'config.php';
require 'functions.php';

$conexion = conexion_db($bd_config);

$error_clave = '';
$error_usuario = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$usuario = limpiarCorreo($_POST['usuario']);
    $clave = $_POST['clave'];

    $datos = consultarUsuario($conexion, $usuario, $clave);

    if (!$datos) {
        $error_usuario .= "El usuario o la clave son incorrectos";
    }

}

$clPag ="secondary";
$idPag ="login-nav";
include_once "header.php";
include "views/login.view.php";
include_once "footer.php";