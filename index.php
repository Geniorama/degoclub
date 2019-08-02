<?php

require "config.php";
require "functions.php";

$conexion = conexion_db($bd_config);

$error_contacto='';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$destino = 'webmaster@univercity.com.co';
    $nombre = limpiarTexto($_POST['nombre']);
    $telefono = limpiarTexto($_POST['telefono']);
    $correo = limpiarCorreo($_POST['correo']);
    $mensaje = limpiarCorreo($_POST['mensaje']);
    
    $contenido = "Nombre: " . $nombre . "\nTeléfono: " . $telefono . "\nCorreo: " . $correo . "\nMensaje: " . $mensaje;
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "From: Pruebas - UniverCity <webmaster@univercity.com>\r\n";

    mail($destino, "Contacto web", $contenido, $headers);

    //Mailchimp Integration

    $datetime=date("d-m-Y H:i:s");
	 
    $server="us20";
    $listid="1e3817c93f";
    $apikey="c89c52d30dd15f6a38efa4fe1dfd560e-us20";
    
    $auth = base64_encode( 'user:'.$apikey );
    
    $data = array(
        'apikey'        => $apikey,
        'email_address' => $correo,
        'status'        => 'subscribed',
        'merge_fields'  => array(
            'FNAME' => utf8_encode( $nombre ),
            'PHONE' => utf8_encode( $telefono ),
            'MSJE' => utf8_encode( $mensaje )
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

    //end Mailchimp


    $error_contacto .= "Tu mensaje fue recibido, pronto nos pondremos en contacto contigo";

}

$clPag ="";
$idPag ="index";

include_once "header.php";
include "views/index.view.php";
include_once "footer.php";
?>