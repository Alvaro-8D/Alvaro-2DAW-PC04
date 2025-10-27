<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej 3 Formularios</title>
</head>
<body>

    <h1>Conversor Numérico</h1>

    <form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
        <p>Número Decimal: <input name="num" type="text" required></p>

        <label for="operacion" >Convertir a :</label>
        <div>
            <input name="operacion" type="radio" class="operacion" value="1" required>
                <label>Binario</label><br>
            <input name="operacion" type="radio" class="operacion" value="2" >
                <label>Octal</label><br>
            <input name="operacion" type="radio" class="operacion" value="3" >
                <label>Hexadecimal</label><br>
            <input name="operacion" type="radio" class="operacion" value="4" >
                <label>Todos los sistemas</label><br>
        </div>
        
        <input type="submit" value="Enviar" /> <input type="reset" value="Borrar" />
    </form>

    <?php
        function main($num,$operacion){
            echo "<h1>Calculadora</h1>"; 
            echo ("<table border=\"solid\"><tr><td>Decimal</td><td>".$num."</td></tr></table><br><br>");

            switch ($operacion) {
                case 1:
                    echo ("<table border=\"solid\"><tr><td>Binario</td><td>".sprintf("%b",$num)."</td></tr></table>");
                    break;
                case 2:
                    echo ("<table border=\"solid\"><tr><td>Octal</td><td>".sprintf("%o",$num)."</td></tr></table>");
                    break;
                case 3:
                    echo ("<table border=\"solid\"><tr><td>Hexadecimal</td><td>".sprintf("%x",$num)."</td></tr></table>");
                    break;
                case 4:
                    echo ("<table border=\"solid\"><tr><td>Binario</td><td>".sprintf("%b",$num)."</td></tr>");
                    echo ("<tr><td>Octal</td><td>".sprintf("%o",$num)."</td></tr>");
                    echo ("<tr><td>Hexadecimal</td><td>".sprintf("%x",$num)."</td></tr></table>");
                    break;      
                default:
                    echo "ERROR en el switich D:";
                    break;
            }
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {    
            $num = limpiar_campos($_POST['num']);
            $operacion = limpiar_campos($_POST['operacion']);

            main($num,$operacion);
        }

        function limpiar_campos($data) { //Evita la Injección de Código
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>
    
</body>
</html>

