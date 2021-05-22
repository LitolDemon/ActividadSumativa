<?php
    header('Content-type:application/json');
    header("Access-Control-Allow-Origin:*");

    $json=file_get_contents('php://input'); 
    $str = trim($json,"[]");
    $dato = json_decode($str,true);
    $aux = json_decode($json,true);
    $estado = $aux[0]["estado"];
    echo $estado;

    switch($estado){
        case 1:
            $jsonData=file_get_contents("abierto.json");
            if(empty($jsonData)==1){
                $archivo = fopen("abierto.json", "w");
                fwrite($archivo,$json);
                break;
            }else{
                $arrayData=json_decode($jsonData);
                array_push($arrayData,$dato);
                $jsonData = json_encode($arrayData);
              
                $archivo = fopen("abierto.json", "w");
                fwrite($archivo,$jsonData); 
                break;
            }

        case 2:
            $jsonData=file_get_contents("enProceso.json");
            if(empty($jsonData)==1){
                $archivo = fopen("enProceso.json", "w");
                fwrite($archivo,$json);
                break;
            }else{
                $arrayData=json_decode($jsonData);
                array_push($arrayData,$dato);
                $jsonData = json_encode($arrayData);

                $archivo = fopen("enProceso.json", "w");
                fwrite($archivo,$jsonData); 
                break;
            }
            
           
        case 3:
            $jsonData=file_get_contents("cerrado.json");
            if(empty($jsonData)==1){
                $archivo = fopen("cerrado.json","w");
                fwrite($archivo,$json);
                break;
            }else{
                $arrayData=json_decode($jsonData);
                array_push($arrayData,$dato);
                $jsonData = json_encode($arrayData);

                $archivo = fopen("cerrado.json", "w");
                fwrite($archivo,$jsonData); 
                break;
            }
        
        default:
            break;
            
    }
?>