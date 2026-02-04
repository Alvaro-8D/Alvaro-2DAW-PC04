<?php include 'funci\fun_index.php'; include 'funci\fun_comunes.php'; redirigir_sesion_abierta(); ?>
<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page - PORTAL RESERVAS</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
 </head>
      
<body>
    

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Acceso Reserva Vuelos</div>
		<div class="card-body">
		
		<form id="" name="" action="" method="post" class="card-body">
		
		<div class="form-group">
			Usuario <input type="text" name="usuario" placeholder="usuario" class="form-control">
        </div>
		<div class="form-group">
			Password <input type="password" name="password" placeholder="password" class="form-control">
        </div>				
        
		<input type="submit" name="submit" value="Login" class="btn btn-warning disabled">
        </form>
		
	    </div>
    </div>
    </div>
    </div>

<?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {  
        $nombre = limpiar_campos($_POST['usuario']);
        $password = limpiar_campos($_POST['password']);

        iniciar_sesion($nombre,$password); //realiza todo el programa de Introducir Categorías
    }
    
?>

</body>
</html>