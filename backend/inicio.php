<?php
    header('Content-type:application/json');
    header("Access-Control-Allow-Origin:*");

    $jsonIniciado = file_get_contents("iniciado.json");
    $jsonProceso = file_get_contents("enProceso.json");
    $jsonTerminado = file_get_contents("terminado.json");


    $iniciado = json_decode($jsonIniciado,true);
    $proceso = json_decode($jsonProceso,true);
    $terminado = json_decode($jsonTerminado,true);
    $array1 = array();
    array_push($array1,$iniciado);
    array_push($array1,$proceso);
    array_push($array1,$terminado);
   
    $auxJson = json_encode($array1);
    echo $auxJson;

?>