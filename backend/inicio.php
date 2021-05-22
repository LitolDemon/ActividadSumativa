<?php
    header('Content-type:application/json');
    header("Access-Control-Allow-Origin:*");

    $jAbierto = file_get_contents("abierto.json");
    $jProceso = file_get_contents("enProceso.json");
    $jCerrado = file_get_contents("cerrado.json");


    $abierto = json_decode($jAbierto,true);
    $proceso = json_decode($jProceso,true);
    $cerrado = json_decode($jCerrado,true);

    $aux = array();

    array_push($aux,$abierto);
    array_push($aux,$proceso);
    array_push($aux,$cerrado);
   
    $auxJson = json_encode($aux);
    echo $auxJson;

?>