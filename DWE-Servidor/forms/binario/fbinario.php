

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej 2 Formularios</title>
</head>
<body>

    <h1>Conversor Binario</h1>

    <form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='POST'>
        <p>Numero Decimal:  <input name="num" type="text" required></p>
        
        <input type="submit" value="Enviar" /> <input type="reset" value="Borrar" />
    </form>

    <?php
      include '../funciones_formularios.php'; // incluye función limpiar_campos()

      function main(){
        $num = limpiar_campos($_POST['num']);

        echo "<h1>Conversor Binario</h1>";

        print("Numero Decimal: ".$num);
        printf("<br><br>Numero Binario: %b",$num);
      }

      if ($_SERVER["REQUEST_METHOD"] == "POST") {      
        main();
      }

      
      verTabla(array(1,2,3,4,5,":D"),false);
    ?>
    
</body>
</html>