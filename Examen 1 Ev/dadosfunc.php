<?php
    function generarDados($numDados){
        $dados = array();
        for ($i=1; $i <= $numDados; $i++) { 
            array_push($dados,  random_int(1,6));
        }
        //var_dump($dados);
        return $dados;
    }

    function sumarDados($dados,$banca = false){
        $suma = 0; 
        $igual = true; // sirve para detectar si todos los números son iguales
        foreach ($dados as $key => $value) {
            $suma += $value;
        }

        foreach ($dados as $key => $value) {
            if ($value != $dados[array_key_first($dados)]) {
                $igual = false;
            }
        }
        if ($igual && $banca) { // la banca
            $suma = 100;
        }elseif ($igual) { // un jugador
            $suma = $suma * count($dados);
        }

        return $suma;
    }

    function detectarGanador($Ajugadores){
        $dados = array();$ganadores = "Ganadores: "; $n = 0;
        foreach ($Ajugadores as $key => $value) {
            array_push($dados,$value["puntos"]);
        }
        $dados = max($dados); // maxima puntuacion de entre jugadores y banca
        foreach ($Ajugadores as $key => $value) {
            if ($value["puntos"] == $dados) {
                $ganadores = $ganadores.$key." ";
                $n ++;
            }
        }
        $ganadores = $ganadores."| Total de Ganadores: ".$n;

        return $ganadores;
    }
    function formatearJugadores($Ajugadores){
        $listaJugadores = array();
        foreach ($Ajugadores as $key => $value) {
            $lista = array();
            array_push($lista,$key);
            foreach ($value["dados"] as $key2 => $value2) {
                array_push($lista, $value2);
            }
            array_push($listaJugadores,$lista);
        }
        return $listaJugadores;
    }

    function ordenarJugadores($Ajugadores){
        foreach ($Ajugadores as $key => $value) {
            $listaDados = "";
            foreach ($value["dados"] as $key2 => $value2) {
                $listaDados = $listaDados.$value2."#";
            }
            $cadena = $key."#".$value["puntos"]."#".$listaDados;
            $cadena2[substr($cadena,strpos($cadena,"#")+1,strpos($cadena,"#",strpos($cadena,"#")+1)-(strpos($cadena,"#")+1))] = $cadena;
        }
        var_dump($cadena2);
        krsort($cadena2);
        var_dump($cadena2);
        $cadena3 = "";
        foreach ($cadena2 as $key => $value) {
            $cadena3 = $cadena3.$value."\n";
        }
        return $cadena3;
    }

    function guardarEnArchivo($cadena2){
        $archivo = fopen("resultados.txt", "a");
        fwrite($archivo,($cadena2."\n"));
        fclose($archivo); 
    }

    function verTabla($tabla,$matriz=true){ // Muestra Una Tabla (Matriz 2 dimensiones por defecto)
        $fila = ""; $columna = "";
        foreach ($tabla as $key1 => $seccion) {   
            if($matriz){ // Matriz (2 dimensiones)
                $columna = "";
                foreach ($seccion as $key2 => $value) {
                    if(is_numeric($value)){
                        $columna = $columna."<td style=\"padding: 5px;border-width: 2px;width:19px;\"> <img src=\"./images/".$value.".PNG\"></td>";
                    }else{
                        $columna = $columna."<td style=\"padding: 5px;border-width: 2px;width:19px;\">".$value."</td>";
                    }
                }  
                $fila = $fila."<tr style=\"padding: 5px;border-width: 2px;width:19px;\">".$columna."</tr>";     
            }else{ // Vector (1 dimension)
                $columna = $columna."<td style=\"padding: 5px;border-width: 2px;width:19px;\"> ".$seccion." </td>";
                $fila = "<tr style=\"padding: 5px;border-width: 2px;width:19px;\">".$columna."</tr>";
            }
            
        }
        $cmd = "<table border=\"1px\" style=\"border-collapse: collapse;\">".$fila." </table>";

        print($cmd);
    }

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
?>
