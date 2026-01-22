<?php include 'funci\fun_comunes.php'; impide_acceso_sesion_cerrada();
		session_start();
		extraerNombre(); // genera Sesión para el Nombre
        extraerEmail(); // genera Sesión para el Email?>
<html>
   
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
		<div class="card-header">Menú Usuario </div>
		<div class="card-body">

		<B>Email Cliente:</B> <?php echo $_SESSION["email"];?> <BR>
		<B>Nombre Cliente:</B>  <?php echo $_SESSION["nombre"];?>  <BR>
		<B>Fecha:</B>  <?php extraerFecha();?>  <BR><BR>
	  
		<!--Formulario con enlaces -->
		<div>
			<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
				<input type="submit" value="Reservar Vuelos" name="reservar" class="btn btn-warning disabled">
				<input type="submit" value="Consultar Reserva" name="consultar" class="btn btn-warning disabled">
				<input type="submit" value="Salir" name="cerrar_sesion" class="btn btn-warning disabled">
			</form>
		</div>	
       
	</div>  
<?php

	if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        
		if(isset($_POST['reservar'])){
			header("Location: vreservas.php");

		}elseif(isset($_POST['consultar'])){

			header("Location: vconsultas.php");
		}else{cerrar_sesion();}

    }  
?>
	    
   </body>
   
</html>


