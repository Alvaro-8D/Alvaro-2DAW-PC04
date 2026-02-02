<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>RESERVAS VUELOS</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
 </head>

<h1>Pago FALLIDO o DENEGADO ❌</h1>

<form action="../vreservas.php" method="post">
<!-- value="1" >> True     |      value="0" >> False  -->
    <input type="hidden" value="1" name="resultado_operacion" class="btn btn-warning disabled">	
    <input type="submit" value="Volver" class="btn btn-warning disabled">	
</form>
