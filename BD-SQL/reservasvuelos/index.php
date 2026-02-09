<?php include 'funci\fun_index.php'; include 'funci\fun_comunes.php'; redirigir_sesion_abierta(); ?>
<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Informacion para Integrar Login Google -->
    <script src="https://accounts.google.com/gsi/client" async></script>

    <script>
      function decodeJWT(token) {

        let base64Url = token.split(".")[1];
        let base64 = base64Url.replace(/-/g, "+").replace(/_/g, "/");
        let jsonPayload = decodeURIComponent(
          atob(base64)
            .split("")
            .map(function (c) {
              return "%" + ("00" + c.charCodeAt(0).toString(16)).slice(-2);
            })
            .join("")
        );
        return JSON.parse(jsonPayload);
      }

      function handleCredentialResponse(response) {

        console.log("Encoded JWT ID token: " + response.credential);

        const responsePayload = decodeJWT(response.credential);

        console.log("Decoded JWT ID token fields:");
        console.log("  Full Name: " + responsePayload.name);
        console.log("  Given Name: " + responsePayload.given_name);
        console.log("  Family Name: " + responsePayload.family_name);
        console.log("  Unique ID: " + responsePayload.sub);
        console.log("  Profile image URL: " + responsePayload.picture);
        console.log("  Email: " + responsePayload.email);

        // Creo una cookie con el ID de usuario
        const nombre = "id_cliente";
        const valor = substr(responsePayload.sub,0,9);
        const segundosEnUnMes = 86400 * 30;

        // En JS usamos 'max-age' (en segundos) que es el equivalente moderno a time() + segundos de PHP
        document.cookie = `${nombre}=${valor}; max-age=${segundosEnUnMes}; path=/; SameSite=Lax`;
      }
    </script>
    <!-- INFO  -->
    <title>Login Page - PORTAL RESERVAS</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
 </head>
      
<body>
    

    <div class="container ">  <!--Div Padre -->
    <!--Aplicacion-->
    <div class="card border-success mb-3" style="max-width: 30rem;"> <!-- Div 1 -->
    <div class="card-header">Acceso Reserva Vuelos</div> <!-- Div 2 -->
    <div class="card-body"> <!-- Div 3 -->
    
        <form id="" name="" action="" method="post" class="card-body">
        
        <div class="form-group">
            Usuario <input type="text" name="usuario" placeholder="usuario" class="form-control">
        </div>
        <div class="form-group">
            Password <input type="password" name="password" placeholder="password" class="form-control">
        </div>				
        
        <input type="submit" name="submit" value="Login" class="btn btn-warning disabled">
        </form>

        <!-- Google -->
         <!-- g_id_onload contains Google Identity Services settings -->
        <div
        id="g_id_onload"
        data-auto_prompt="false"
        data-callback="handleCredentialResponse"
        data-client_id="217268208772-k5ob3ac3kmqe0822er3hn7o46coa3lo6.apps.googleusercontent.com"
        ></div>
        <!-- g_id_signin places the button on a page and supports customization -->
        <div class="g_id_signin" data-theme="filled_blue" data-text="signup_with"></div>
        <!-- Google -->

    </div><!-- Div 3 -->
    </div><!-- Div 2 -->
    </div> <!-- Div 1 -->
    </div> <!--Div Padre -->

    

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {  
        $nombre = limpiar_campos($_POST['usuario']);
        $password = limpiar_campos($_POST['password']);

        iniciar_sesion($nombre,$password); //realiza todo el programa de Introducir Categorías
    }
    
?>


</body>
</html>