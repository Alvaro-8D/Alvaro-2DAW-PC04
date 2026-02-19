<h1>Faturas (por fecha)</h1>

<form name='form_facturas' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <br><br> **************** Fecha ******************<br>
    Desde:<input name="fecha1" type="date" required><br><br>
    Hasta:<input name="fecha2" type="date" required><br><br>
    <input name="enviar_facturas" type="submit" value="Mostrar Facturas">
</form>
<?php 
    if(isset($_POST['enviar_facturas'])){
        var_dump($GLOBALS['facturas_fechas']);
    } 
?>


