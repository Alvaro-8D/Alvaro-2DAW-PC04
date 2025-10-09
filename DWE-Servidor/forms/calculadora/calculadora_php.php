<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej 1 Formularios</title>
</head>
<body>

    <h1>Calculadora</h1>

    <form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
        <p>Operando 1: <input name="op1" type="text" required></p>
        <p>Operando 2: <input name="op2" type="text" required></p>

        <label for="operacion" >Selecciona Operación</label>
        <div>
            <input name="operacion" type="radio" value="1" required>
                <label>Suma</label><br>
            <input name="operacion" type="radio" value="2" >
                <label>Resta</label><br>
            <input name="operacion" type="radio" value="3" >
                <label>Multiplicación</label><br>
            <input name="operacion" type="radio" value="4" >
                <label>División</label><br>
        </div>
        
        <input type="submit" value="Enviar" /> <input type="reset" value="Borrar" />
    </form>

    <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $op1 = limpiar_campos($_POST['op1']);
            $op2 = limpiar_campos($_POST['op2']);
            $operacion = limpiar_campos($_POST['operacion']);

            mostrarResultado($operacion,$op1,$op2);
        }

        function limpiar_campos($data) { //Evita la Injección de Código
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        } 

        function mostrarResultado($operacion,$op1,$op2){ // Separar la parte "logica" de la parte "visual" (la que muestra el resultado)
            echo "<h2>Resultado</h2>";
            switch ($operacion) {
                case 1:
                    echo ("Resultado de operación: ".$op1." + ".$op2." = ".($op1+$op2));
                    break;
                case 2:
                    echo("Resultado de operación: ".$op1." - ".$op2." = ".($op1-$op2));
                    break;
                case 3:
                    echo("Resultado de operación: ".$op1." * ".$op2." = ".($op1*$op2));
                    break;
                case 4:
                    echo("Resultado de operación: ".$op1." / ".$op2." = ".($op1/$op2));
                    break;
                
                default:
                    echo "ERROR en el switich D:";
                    break;
            }
        }
    ?>
    
</body>
</html>