<?php
    header('Content-type:application/json');
    header("Access-Control-Allow-Origin:*");
    
    $json=file_get_contents('php://input'); 
    $dato = json_decode($json,true);

    $estado = $dato[1]["estado"]; 
    $nuevo = $dato[0]["estado"];

    $jAbierto=file_get_contents("abierto.json");
    $jCerrado = file_get_contents("cerrado.json");
    $jProceso = file_get_contents("enProceso.json");

    $abierto= json_decode($jAbierto,true);
    $proceso = json_decode($jProceso,true);
    $cerrado = json_decode($jCerrado,true);
   
    switch($estado){
        case 1:
            for($index=0;$index<count($abierto);$index++){
                if($abierto[$index]["titulo"]==$dato[1]["titulo"]){
                    if($abierto[$index]["descripcion"]==$dato[1]["descripcion"]){
                        switch($nuevo){
                            case 1:
                                $abierto[$index] = $dato[0];
                                $aux = json_encode($abierto);
                                $archivo = fopen("abierto.json", "w");
                                fwrite($archivo,$aux);
                                break;
                            case 2:
                                array_splice($abierto,$index,1);
                                array_push($proceso,$dato[0]);
                                $auxP = json_encode($proceso);
                                $auxI = json_encode($abierto);

                                $archivoP = fopen("enProceso.json","w");
                                fwrite($archivoP,$auxP);

                                $archivoI = fopen("abierto.json","w");
                                fwrite($archivoI,$auxI);

                                break;
                            case 3:
                                array_splice($abierto,$index,1);
                                array_push($cerrado,$dato[0]);
                                var_dump($cerrado);

                                $auxT = json_encode($cerrado);
                                $auxI = json_encode($abierto);

                                $archivoT = fopen("cerrado.json","w");
                                fwrite($archivoT,$auxT);

                                $archivoI = fopen("abierto.json","w");
                                fwrite($archivoI,$auxI);
                                break;
                        }
                    }
                        
                }
            }

        case 2:

            for($index=0;$index<count($proceso);$index++){
                if($proceso[$index]["titulo"]==$dato[1]["titulo"]){
                    if($proceso[$index]["descripcion"]==$dato[1]["descripcion"]){
                        switch($nuevo){
                            case 1:
                                array_splice($proceso,$index,1);
                                array_push($abierto,$dato[0]);
                                $auxP = json_encode($proceso);
                                $auxI = json_encode($abierto);

                                $archivoP = fopen("enProceso.json","w");
                                fwrite($archivoP,$auxP);

                                $archivoI = fopen("abierto.json","w");
                                fwrite($archivoI,$auxI);

                                break;
                            case 2:
                                $proceso[$index] = $dato[0];
                                $aux = json_encode($proceso);
                                $archivo = fopen("enProceso.json", "w");
                                fwrite($archivo,$aux);

                                break;
                            case 3:
                                array_splice($proceso,$index,1);
                                array_push($cerrado,$dato[0]);
                                $auxT = json_encode($cerrado);
                                $auxP = json_encode($proceso);
                                $archivoT = fopen("cerrado.json","w");
                                fwrite($archivoT,$auxT);
                                $archivoP = fopen("enProceso.json","w");
                                fwrite($archivoP,$auxP);
                                break;
                        }
                    }
                        
                }
            }
        default:
            break;

    }
?>