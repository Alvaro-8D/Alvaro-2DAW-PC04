<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DownMusic</title>
</head>
<body>
	<h1>Comprar y Descargar Música <a href="fun_inicio.php"><button>Volver</button></a></h1>

	<form name="descargarMusica" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
		
		<B>Canciones: </B><select name="track" class="form-control">
			<?php extraerMusica(); ?>	
			</select>	
		<BR> <br>
		<B>Unidades: </B><input type="number" name="cantidad" size="3" min="1" value="1">
		<BR><BR>
		<div>
			<input type="submit" value="Agregar a Cesta" name="carrito" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled"><br><br>
		</div>		
	</form>
</body>
</html>

	