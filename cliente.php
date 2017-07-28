<?php
/**
*
* LLamamos a clase nusoap dentro de carpeta lib
*/
require_once 'lib/nusoap.php';

/**
*Se instancia una nueva clase, pasando como parametro la url del archivo WDSL
*/
$clienteSOAP = new nusoap_client("http://localhost/webServiceNuSoap/vehiculo.php?wsdl");
$clienteSOAP->soap_defencoding = 'UTF-8';
$clienteSOAP->decode_utf8 = false;


$error = $clienteSOAP->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
}
$format="json";
$result = $clienteSOAP->call("getVehiculos", array("tipo" => "CAMIONETA","format"=>$format));

if ($clienteSOAP->fault) {
    echo "<h2>Fault</h2><pre>";
    print_r($result);
    echo "</pre>";
}else {
    $error = $clienteSOAP->getError();
    if ($error) {
        echo "<h2>Error</h2><pre>" . $error . "</pre>";
    }else {
            echo $result;
         }
    }
?>
