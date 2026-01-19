<?php include 'funci\fun_comunes.php'; impide_acceso_sesion_cerrada();?><html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>RESERVAS VUELOS</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
 </head>
   
 <body>
   

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Reservar Vuelos</div>
		<div class="card-body">
	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
	
		<B>Email Cliente:</B> <?php extraerEmail();?> <BR>
		<B>Nombre Cliente:</B>  <?php extraerNombre();?>  <BR>
		<B>Fecha:</B>  <?php extraerFecha();?>  <BR><BR>
		
		<B>Vuelos</B><select name="vuelos" class="form-control">
				
			</select>	
		<BR> 
		<B>Número Asientos</B><input type="number" name="asientos" size="3" min="1" max="100" value="1" class="form-control">
		<BR><BR><BR><BR><BR>
		<div>
			<input type="submit" value="Agregar a Cesta" name="agregar" class="btn btn-warning disabled">
			<input type="submit" value="Comprar" name="comprar" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
			<br><br><input type="submit" value="Cerrar Sesión" name="cerrar_sesion" class="btn btn-warning disabled">
		</div>		
	</form>
	
<?php

	if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        
		if(isset($_POST['volver'])){
			header("Location: vinicio.php");
		}else{
			cerrar_sesion();
		
		
		
		
		}

    }  
?>
  </body>
   
</html>

