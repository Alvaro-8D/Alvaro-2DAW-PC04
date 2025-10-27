<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej 4 Formularios</title>
</head>
<body>

<h1>Cambio de Base</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="numero">Número</label>
    <input id="numero" name="num" type="text" required>
    <label for="base_num">Nueva Base</label>
    <input id="base_num" name="base" type="text" required>

    <input type="submit" value="Cambiar Base"> <input type="reset" value="Borrar">
</form>

<?php
    include '../../Otros/funciones.php'; // incluye función limpiar_campos()
    
    function ver($num,$base1,$base2){
        echo "<h3>Resultado:</h3>";
        echo "Número ",$num," en base ",$base1," = ",base_convert($num,$base1,$base2)," en base ",$base2;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num = limpiar_campos($_POST["num"]);
        echo "<h3>",$num,"</h3>";    
        $base1 = (int) substr($num,strpos($num,"/")+1);
        $num = (int) substr($num,0,strpos($num,"/"));
        $base2 = limpiar_campos($_POST["base"]);      
        ver($num,$base1,$base2);
    }
    
    
    
?>
    
</body>
</html>