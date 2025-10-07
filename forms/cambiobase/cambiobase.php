<?php
$num = limpiar_campos($_POST['num']);
$operacion = limpiar_campos($_POST['operacion']);

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

function limpiar_campos($data) { //Evita la Injección de Código
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>