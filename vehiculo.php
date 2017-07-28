<?php

//Llamamos la clase nusoap con require_once, ya que solo llama al archivo una sola vez
require_once 'lib/nusoap.php';

function getVehiculos($tipo,$format){
  if (strtoupper($tipo) == "CAMIONETA") {
    if(strtoupper($format) == 'JSON') {
         return json_encode(array('getVehiculosResponse'=>array("Toyota","Ford","Nissan")));
       }else{
         return join(",", array(
             "Toyota",
             "Ford",
             "Nissan"));
           }
   }
   else {
       echo "No hay vehiculos para el tipo de auto";
   }

}
$server = new soap_server();
$server->soap_defencoding = 'UTF-8';
$server->decode_utf8 = false;
$server->encode_utf8 = true;
$server->configureWSDL("vehiculo", "urn:vehiculo");

/**

*    El primer array nos permite definir el argumento de entrada y su tipo de datos
*    El segundo define la función de retorno y su tipo de datos
*    urn:producto es la definición del namespace
*    urn:producto#getProd es donde definimos la acción SOAP
*    Luego viene el tipo de llamada,que puede ser rpc, como en el ejemplo, o document
*    Tras esto definimos el valor del atribute use, que puede ser encoded o literal
*    Finalmente viene una descripción de qué hace el método al que llamamos

*/
$server->register("getVehiculos",
        array("tipo" => "xsd:string","format" => "xsd:string"),
        array("return" => "xsd:string"),
        "urn:vehiculo",
        "urn:vehiculo#getVehiculos",
        "rpc",
        "encoded",
        "Nos da una lista de vehiculos por tipo");

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA :'';
$server->service($HTTP_RAW_POST_DATA);
 ?>
