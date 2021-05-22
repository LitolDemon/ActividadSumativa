<?php
    header('Content-type:application/json');
    header("Access-Control-Allow-Origin:*");
    
    $json=file_get_contents('php://input'); 
    $str = trim($json,"[]");
    $dato = json_decode($str,true);

    $estado = $dato["estado"];
    $jAbierto=file_get_contents("abierto.json");
    $jProceso = file_get_contents("enProceso.json");
    $jCerrado = file_get_contents("cerrado.json");

    $abierto= json_decode($jAbierto,true);
    $proceso = json_decode($jProceso,true);
    $cerrado = json_decode($jCerrado,true);

    switch($estado){
        case 1:
            for($index=0;$index<count($abierto);$index++){
                if($abierto[$index]["titulo"]==$dato["titulo"]){
                    if($abierto[$index]["descripcion"]==$dato["descripcion"]){
                        //var_dump($abierto);
                    
                        array_splice($abierto,$index,1);
                        //var_dump($abierto);
                    
                        $aux = json_encode($abierto);

                        $archivo = fopen("abierto.json","w");
                        fwrite($archivo,$aux);
                        break;
                    }
                }
            }
            break;
        
        case 2:
            for($index=0;$index<count($proceso);$index++){
                if($proceso[$index]["titulo"]==$dato["titulo"]){
                    if($proceso[$index]["descripcion"]==$dato["descripcion"]){
        
                        array_splice($proceso,$index,1);
                        var_dump($abierto);
                    
                        $aux = json_encode($proceso);

                        $archivo = fopen("enProceso.json","w");
                        fwrite($archivo,$aux);
                        break;
                    }
                }
            }
        case 3:
            for($index=0;$index<count($cerrado);$index++){
                if($cerrado[$index]["titulo"]==$dato["titulo"]){
                    if($cerrado[$index]["descripcion"]==$dato["descripcion"]){
                        array_splice($cerrado,$index,1);                 
                        $aux = json_encode($cerrado);

                        $archivo = fopen("cerrado.json","w");
                        fwrite($archivo,$aux);
                        break;
                    }
                }
            }
        default:
            break;
    }
?>