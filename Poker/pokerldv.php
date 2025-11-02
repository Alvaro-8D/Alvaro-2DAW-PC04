<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Casino IES Leonardo Da Vinci</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
    <h1 class="text-center"> POKER LEONARDO</h1>

    <?php
    include 'Pokerldv_fun.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        /* ******************* INICIALIZAR JUGADORES Y DATOS ********************************************* */
        $numJugadores = 4;
        for ($i=1; $i <= $numJugadores; $i++) { 
            /* array de jugadores */
            $Ajugadores[$i]["nombre"] = limpiar_campos($_POST[('nombre'.$i)]);
            $Ajugadores[$i]["mano"] = array(); // Array de la Mano de Cartas de cada jugador
            $Ajugadores[$i]["puntuacion"] = 0; // 4. Poker / 3. Trio / 2. Dobre Pareja / 1. Pareja / 0. Nada
            $Ajugadores[$i]["dinero"] = 0; // premio
        }
        $cantApostada = limpiar_campos($_POST['bote']);

        /* ******************* PROGRAMA ********************************************* */
        $baraja = generar_cartas(); // Baraja de cartas desordenadas
        
        /* * * * * * Repartir Cartas * * * * * */
        $k = 0;
        foreach ($Ajugadores as $key => $value) {
            
            $value["mano"][0] = $baraja[$k];
            $value["mano"][1] = $baraja[$k+1];
            $value["mano"][2] = $baraja[$k+2];
            $value["mano"][3] = $baraja[$k+3];
            $k = $k + 4;
            $Ajugadores[$key] = $value;
        }
       
        /* * * * * * Calcular Puntuación * * * * * */
        for ($i=1; $i <= count($Ajugadores) ; $i++) { 
            $Ajugadores[$i]["puntuacion"] = calcular_puntuacion($Ajugadores[$i]["mano"]);
        }

        //var_dump($Ajugadores);
         /* * * * * * Sacar ganadores * * * * * */

        function detectar_ganadores($Ajugadores){
            $cadena = "";
            $Ajugadores2[]
            max($Ajugadores2[])

            return;
        }

        $ganadores = detectar_ganadores($Ajugadores);

    }
    

    ?>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">JUGADORES</div>
		<div class="card-body">
		<form id="product-form" name="poker" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="card-body">
						<div class="form-group">
                            Jugador 1 <input type="text" name="nombre1" placeholder="Nombre" class="form-control">
                        </div>
						<div class="form-group">
                            Jugador 2 <input type="text" name="nombre2" placeholder="Nombre" class="form-control">
                        </div>
						<div class="form-group">
                            Jugador 3 <input type="text" name="nombre3" placeholder="Nombre" class="form-control">
                        </div>
						<div class="form-group">
                            Jugador 4 <input type="text" name="nombre4" placeholder="Nombre" class="form-control">
                        </div>
												
						<div class="form-group">
                            Bote <input type="text" name="bote" placeholder="bote €" class="form-control">
                        </div>
                        
                        <input type="submit" name="submit" value="Jugar" class="btn btn-warning disabled">
                       
                    </form>
		
	</div>



            </div>

        </div>
        <br>


    </div>



</body>

</html>