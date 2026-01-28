<?php include 'funci\fun_comunes.php'; if(impide_acceso_sesion_cerrada()){session_start();} include 'funci\fun_vconsultas.php'; ?><html>
   
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
		<div class="card-header">Consultar Reservas</div>
		<div class="card-body">
	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method="post">
	
		<B>Email Cliente:</B> <?php echo $_SESSION["email"];?> <BR>
		<B>Nombre Cliente:</B>  <?php echo $_SESSION["nombre"];?>  <BR>
		<B>Fecha:</B>  <?php extraerFecha();?>  <BR><BR>
		
		<B>Numero Reserva</B><select name="reserva" class="form-control">
				<?php extraerReservas();?>
			</select>	
		<BR><BR><BR><BR><BR><BR><BR>
		<div>
			<input type="submit" value="Consultar Reserva" name="consultar" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
			<input type="submit" value="Cerrar Sesión" name="cerrar_sesion" class="btn btn-warning disabled">
		</div>		
	</form>
	
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        
		if(isset($_POST['volver'])){
			header("Location: vinicio.php");
		}

		cerrar_sesion();
		
		$id_reserva = limpiar_campos($_POST["reserva"]);
		resultado($id_reserva);
    }  
?>
  </body>
   
</html>

