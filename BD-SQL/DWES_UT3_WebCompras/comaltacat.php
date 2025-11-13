<h1>Formulario: Alta de Categorías</h1>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <p>Número Decimal: <input name="num" type="text" required></p>
    <input type="submit" value="Enviar" />
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        $num = limpiar_campos($_POST['num']);
        $operacion = limpiar_campos($_POST['operacion']);

        
    }
?>