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
    <h1 class="text-center"> 7 Y MEDIA</h1>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">JUGADORES</div>
		<div class="card-body">
            <form id="product-form" name="media7" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="card-body">
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
                    Cartas a repartir <input type="text" name="numcartas" placeholder="cartas" class="form-control">
                </div>
                <div class="form-group">
                    Cantidad Apostada <input type="text" name="apuesta" placeholder="apuesta €" class="form-control">
                </div>
                <input type="submit" name="submit" value="Jugar" class="btn btn-warning disabled"> 
            </form>
            <?php 
                include 'media7fun.php';

                function main($j1,$j2,$j3,$j4,$numcartas,$cantApostada){ // funcion principal del programa
                    $numjugadores = 4;
                    $baraja = generar_cartas(); // Baraja de cartas desordenadas
                    for ($i=0; $i < $numcartas; $i++) { // Reparte las cartas a cada jugador
                        $cartas1[$i] = $baraja[$i];
                        $cartas2[$i] = $baraja[($i+($numcartas))];
                        $cartas3[$i] = $baraja[($i+($numcartas*2))];
                        $cartas4[$i] = $baraja[($i+($numcartas*3))];
                    }
                    echo "<h2>",$j1["nombre"],":</h2>";verTabla($cartas1,true);
                    echo "<h2>",$j2["nombre"],":</h2>";verTabla($cartas2,true);
                    echo "<h2>",$j3["nombre"],":</h2>";verTabla($cartas3,true);
                    echo "<h2>",$j4["nombre"],":</h2>";verTabla($cartas4,true);

                    $j1["puntos"] = sumar_puntos($cartas1);
                    $j2["puntos"] = sumar_puntos($cartas2);
                    $j3["puntos"] = sumar_puntos($cartas3);
                    $j4["puntos"] = sumar_puntos($cartas4);

                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $j1["nombre"] = limpiar_campos($_POST['nombre1']);
                    $j2["nombre"] = limpiar_campos($_POST['nombre2']);
                    $j3["nombre"] = limpiar_campos($_POST['nombre3']);
                    $j4["nombre"] = limpiar_campos($_POST['nombre4']);
                    $numcartas = limpiar_campos($_POST['numcartas']);
                    $cantApostada = limpiar_campos($_POST['apuesta']);
                    
                    if ($numcartas < 1) {
                        echo "<h1> Para poder jugar necesitas AL MENOS 1 CARTA PARA CADA JUGADOR </h1>";
                    } 
                    elseif ($numcartas > 10) {
                        echo "<h1> No hay suficiente cartas para todos los jugadores, USA MENOS CARTAS </h1>";
                    }
                    else {
                         main($j1,$j2,$j3,$j4,$numcartas,$cantApostada);
                    }  
                }
            ?>
	    </div>
        </div>
        </div>
        <br>
    </div>



</body>

</html>