<?php
    include 'dadosfunc.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $j1 = limpiar_campos($_POST["jug1"]);
        $j2 = limpiar_campos($_POST["jug2"]);
        $j3 = limpiar_campos($_POST["jug3"]);
        $j4 = limpiar_campos($_POST["jug4"]);
        $numDados = limpiar_campos($_POST["numdados"]);

        if ($numDados >= 2 && $numDados <= 10) {
            /* Inicializar Jugadores/Banca */
            $Ajugadores = array($j1 => array("dados" => array(),"puntos" => 0),
                                $j2 => array("dados" => array(),"puntos" => 0),
                                $j3 => array("dados" => array(),"puntos" => 0),
                                $j4 => array("dados" => array(),"puntos" => 0),
                            "banca" => array("dados" => array(),"puntos" => 0));

            /* Generar Dados */
            foreach ($Ajugadores as $key => $value) {
                $Ajugadores[$key]["dados"] = generarDados($numDados);
            }
            /* Sumar Dados */
            foreach ($Ajugadores as $key => $value) {
                if ($key == "banca") {
                    $Ajugadores[$key]["puntos"] = sumarDados($Ajugadores[$key]["dados"],true);
                }else {
                    $Ajugadores[$key]["puntos"] = sumarDados($Ajugadores[$key]["dados"]);
                }
            }

            /* Sacar Ganadores */
            $ganadores = detectarGanador($Ajugadores);
            
            /* Formatear Resultado para Imprimirlo por pantalla */
            $listaJugadores = formatearJugadores($Ajugadores);

            /* Visualizar Datos por Pantalla en una Tabla */
            verTabla($listaJugadores);

            /* Guardar en un Fichero de forma Ordenada*/
            $cadena2 = ordenarJugadores($Ajugadores);
            guardarEnArchivo($cadena2);

        }else{
            echo "cantidad NO valida de Dados";
        }
        
    }

?>
