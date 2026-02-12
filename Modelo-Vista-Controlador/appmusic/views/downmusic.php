<h1>Comprar y Descargar Música</h1>

<form name="descargarMusica" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
	
		<B>Vuelos</B><select name="vuelos" class="form-control">
			<?php extraerMusica(); ?>	
			</select>	
		<BR> <br>
		<B>Unidades que quieres Comprar/Descargar: </B><input type="number" name="cantidad" size="3" min="1" value="1">
		<BR><BR>
		<div>
			<input type="submit" value="Agregar a Cesta" name="carrito" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled"><br><br>
			<!-- PONER BOTOTN "Comprar" en Formulario de RedSys -->
			<!-- <input type="submit" value="Comprar" name="comprar" class="btn btn-warning disabled"> -->
		</div>		
	</form>