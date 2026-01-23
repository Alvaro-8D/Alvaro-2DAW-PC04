<?php include 'funci\fun_comunes.php'; if(impide_acceso_sesion_cerrada()){session_start();ob_start();} include 'funci\fun_vreservas.php';
if(!isset($_COOKIE["carrito"])){setcookie("carrito",serialize(array()), time() + (86400 * 30), "/");}?><html>
   
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
	
		<B>Email Cliente:</B> <?php echo $_SESSION["email"];?> <BR>
		<B>Nombre Cliente:</B>  <?php echo $_SESSION["nombre"];?>  <BR>
		<B>Fecha:</B>  <?php extraerFecha();?>  <BR><BR>
		
		<B>Vuelos</B><select name="vuelos" class="form-control">
			<?php extraerVuelos(); ?>	
			</select>	
			
		<BR> 
		<B>Número Asientos</B><input type="number" name="cantidad" size="3" min="1" max="100" value="1" class="form-control">
		<BR><BR><BR><BR><BR>
		<div>
			<input type="submit" value="Agregar a Cesta" name="carrito" class="btn btn-warning disabled">

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
		}
		if(isset($_POST['vaciar'])){
			setcookie("carrito",serialize(array()), time() + (86400 * 30), "/");
			header("Location: vreservas.php");
		}
		//carga el carrito en una variable
		if(isset($_COOKIE["carrito"])){$carrito = unserialize($_COOKIE["carrito"]);}
		
		cerrar_sesion();

		if(array_key_exists("carrito",$_POST)){$boton_carrito = $_POST["carrito"];}else{$boton_carrito = null;}
		//comprueba que hayas pulsado el boton "Comprar"
		if(array_key_exists("comprar",$_POST)){$boton_comprar = $_POST["comprar"];}else{$boton_comprar = null;}
	
		boton_carrito($boton_carrito,$carrito); // añade productos al carrito
		boton_comprar($boton_comprar,$carrito); // compra los productos del carrito (solo si hay stock)

    }  
	//var_dump(date("y-m-d H:i:s"));
	verCarrito(); // Muestra por pantalla el carrito
	
?>
  </body>
   
</html>

