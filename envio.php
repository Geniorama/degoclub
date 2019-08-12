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
        $sql_usuario = 'SELECT * FROM users WHERE (correo = :correo)';
        $statement = $conexion->prepare($sql_usuario);
        $statement->execute(array(':correo' => $correo));
        $resultadoUsuario = $statement->fetch();
        
        if (!$resultadoUsuario) {
            insertarUsuario($conexion, $nombre, $apellido, $correo, $clave_cifrada);

            $destino = "info@degoclub.com";
            $contenido = "Nombre: " . $nombre . "\nApellido: " . $apellido . "\nCorreo: " . $correo;
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
            $headers .= "From: Dego Club <info@degoclub.com>\r\n";
        
            mail($destino, "Contacto web", $contenido, $headers);

            /*Mailchimp Integration*/

            $datetime=date("d-m-Y H:i:s");
            
            $server="us20";
            $listid="b7ebd6bb8b";
            $apikey="c89c52d30dd15f6a38efa4fe1dfd560e-us20";
            
            $auth = base64_encode( 'user:'.$apikey );
            
            $data = array(
                'apikey'        => $apikey,
                'email_address' => $correo,
                'status'        => 'subscribed',
                'merge_fields'  => array(
                    'FNAME' => utf8_encode( $nombre ),
                    'LNAME' => utf8_encode( $apellido )
                    )
                );
            
            $json_data = json_encode($data);
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://'.$server.'.api.mailchimp.com/3.0/lists/'.$listid.'/members/');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Basic '.$auth));
            curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
            
            $response = curl_exec($ch);

            
            /*end Mailchimp*/

            echo json_encode($nombre . " te haz registrado con éxito");
            
        } else{
            echo json_encode("Error: ya existe un usuario registrado con el correo " . "<strong>" . $correo . "</strong>. Prueba con otro correo ");
        }  
    }
