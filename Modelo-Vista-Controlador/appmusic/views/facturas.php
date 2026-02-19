<h1>Faturas (por fecha)</h1>

<form name='form_facturas' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <br><br> **************** Fecha ******************<br>
    <input name="fecha3" type="date">
    <input name="enviar" type="submit" value="enviar_fecha">
</form>
<?php var_dump($GLOBALS['facturas_fechas']); ?>


