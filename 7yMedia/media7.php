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
                    $cartas1 = $cartas2 = $cartas3 = $cartas4 = ""; // son el array de cartas de cada jugador
                    $baraja = generar_cartas(); // baraja de cartas desordenadas
                    $n = 1;$n2 = 0;
                    foreach ($baraja as $key => $value) { //reparte las cartas barajeadas a los jugadores
                        ${"cartas".$n}[$key]=$value;
                        if($n<4){$n++;}else{$n = 1;$n2++}
                        

                    }

                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $j1 = limpiar_campos($_POST['nombre1']);
                    $j2 = limpiar_campos($_POST['nombre2']);
                    $j3 = limpiar_campos($_POST['nombre3']);
                    $j4 = limpiar_campos($_POST['nombre4']);
                    $numcartas = limpiar_campos($_POST['numcartas']);
                    $cantApostada = limpiar_campos($_POST['apuesta']);
                    

                    main($j1,$j2,$j3,$j4,$numcartas,$cantApostada);
                }
            ?>
	    </div>
        <!-- <img style="width: 70px;" src="images/1C.PNG"> -->
        </div>
        </div>
        <br>
    </div>



</body>

</html>