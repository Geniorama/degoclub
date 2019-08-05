<?php


    $nombre = limpiarTexto($_POST['nombre']);
    $apellido = limpiarTexto($_POST['apellido']);
	$correo = limpiarCorreo($_POST['email']);
    $clave = $_POST['clave'];
    $clave_cifrada = password_hash($clave, PASSWORD_DEFAULT);
    $conf_clave = $_POST['clave2'];
    $conf_clave_cifrada = password_hash($conf_clave, PASSWORD_DEFAULT);

    if ($nombre === '') {

        $msje_error = "Error al enviar";
        echo json_encode($msje_error);
    } else {

        $msje_exito = "Error al enviar";
        echo json_encode($msje_exito);
    }
