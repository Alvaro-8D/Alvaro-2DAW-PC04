<?php
$num = limpiar_campos($_POST['num']);

echo "<h1>Conversor Binario</h1>";

print("Numero Decimal: ".$num);
printf("<br><br>Numero Binario: %b",$num);

function limpiar_campos($data) { //Evita la Injección de Código
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>