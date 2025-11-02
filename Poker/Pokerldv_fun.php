<?php    
    function limpiar_campos($data) { // Evita la inyeccion de código
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /* TRUNCAR */
    function truncar($num,$decimal = 0){
        return ((int) ($num*(pow(10,$decimal))))/(pow(10,$decimal));
    }

    function generar_cartas(){
        
        $baraja[0] = "1C1";
        $baraja[1] = "1C2";
        $baraja[2] = "1T1";
        $baraja[3] = "1T2";
        $baraja[4] = "1D1";
        $baraja[5] = "1D2";
        $baraja[6] = "1P1";
        $baraja[7] = "1P2";

        $baraja[8] = "JC1";
        $baraja[9] = "JC2";
        $baraja[10] = "JT1";
        $baraja[11] = "JT2";
        $baraja[12] = "JD1";
        $baraja[13] = "JD2";
        $baraja[14] = "JP1";
        $baraja[15] = "JP2";

        $baraja[16] = "QC1";
        $baraja[17] = "QC2";
        $baraja[18] = "QT1";
        $baraja[19] = "QT2";
        $baraja[20] = "QD1";
        $baraja[21] = "QD2";
        $baraja[22] = "QP1";
        $baraja[23] = "QP2";

        $baraja[24] = "KC1";
        $baraja[25] = "KC2";
        $baraja[26] = "KT1";
        $baraja[27] = "KT2";
        $baraja[28] = "KD1";
        $baraja[29] = "KD2";
        $baraja[30] = "KP1";
        $baraja[31] = "KP2";

        shuffle($baraja); // remueve y desordena la baraja
        return $baraja;
    }

    function calcular_puntuacion($jugador){
        $baraja["1"] = 0;
        $baraja["J"] = 0;
        $baraja["Q"] = 0;
        $baraja["K"] = 0;

        $cadena[0] = substr($jugador[0],0,1); // saca la carta
        $cadena[1] = substr($jugador[1],0,1); // saca la carta
        $cadena[2] = substr($jugador[2],0,1); // saca la carta
        $cadena[3] = substr($jugador[3],0,1); // saca la carta

        foreach ($cadena as $key => $value) {
            $baraja[$value] = $baraja[$value] + 1;    
        }

        if(max($baraja)== 4){
            $cadena = 4;
        }else if(max($baraja)== 3){
            $cadena = 3;
        }else if(max($baraja)== 2){
            $n2 = 0;
            foreach ($baraja as $key => $value) {  
                if($value == 2){
                    $n2 ++;
                }  
            }
            if ($n2 > 1) {
                $cadena = 2;
            } else {
                $cadena = 1;
            }
        }else{
            $cadena = 0;
        }
        return $cadena;
    }



?>