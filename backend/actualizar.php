<?php
    header('Content-type:application/json');
    header("Access-Control-Allow-Origin:*");

    $json=file_get_contents('php://input'); 
    $str = trim($json,"[]");
    $info = json_decode($str,true);
    
    $array1 = json_decode($json,true);
    $estado = $array1[0]["estado"];
    echo $estado;

    switch($estado){
        case 1:
            $jsonData=file_get_contents("iniciado.json");
            if(empty($jsonData)==1){
                $archivo = fopen("iniciado.json", "w");
                fwrite($archivo,$json);
                break;
            }else{
                $arrayData=json_decode($jsonData);
                array_push($arrayData,$info);
                $jsonData = json_encode($arrayData);
              
                $archivo = fopen("iniciado.json", "w");
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
                array_push($arrayData,$info);
                $jsonData = json_encode($arrayData);

                $archivo = fopen("enProceso.json", "w");
                fwrite($archivo,$jsonData); 
                break;
            }
            
           
        case 3:
            $jsonData=file_get_contents("terminado.json");
            if(empty($jsonData)==1){
                $archivo = fopen("terminado.json","w");
                fwrite($archivo,$json);
                break;
            }else{
                $arrayData=json_decode($jsonData);
                array_push($arrayData,$info);
                $jsonData = json_encode($arrayData);

                $archivo = fopen("terminado.json", "w");
                fwrite($archivo,$jsonData); 
                break;
            }
        
        default:
            break;
            
    }
?>