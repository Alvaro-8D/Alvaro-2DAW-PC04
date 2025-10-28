

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej 5 Formularios</title>
</head>
<body>

    <h1>IPs</h1>

    <form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='POST'>
        <p>IP Notación Decimal:  <input name="num" type="text" required></p>
        
        <input type="submit" value="Notación Binaria" /> <input type="reset" value="Borrar" />
    </form>

    <?php
      include '../funciones_formularios.php'; // incluye función limpiar_campos()

      if ($_SERVER["REQUEST_METHOD"] == "POST") {      
        $num = limpiar_campos($_POST['num']);

        $num2 = explode(".",$num);
        $num2 = sprintf("%b",$num2[0]).".".sprintf("%b",$num2[1]).".".sprintf("%b",$num2[2]).".".sprintf("%b",$num2[3]);
        
        /* Visual */
        echo "<h3>Resluado: </h3>";
        print("IP en Decimal: ".$num);
        print("<br><br>Ip en Binario: ".$num2);
      }
    ?>
    
</body>
</html>