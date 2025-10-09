<?php
$op1 = limpiar_campos($_POST['op1']);
$op2 = limpiar_campos($_POST['op2']);
$operacion = limpiar_campos($_POST['operacion']);

echo "<h1>Calculadora</h1>";

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

function limpiar_campos($data) { //Evita la Injección de Código
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>