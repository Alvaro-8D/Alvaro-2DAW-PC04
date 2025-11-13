<?php
/*SELECTs - mysql PDO*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleados1n";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT cod_dpto, nombre_dpto FROM departamento where cod_dpto=:cod");// ":cod" es una variable que podemos cambiar

    $stmt->bindParam(':cod',$codigo);// variar parte de la consulta SQL
    $codigo = "D002";// asignar valor a la variable SQL

    $stmt->execute();// ejecuta la sentencia

    // set the resulting array to associative
     $stmt->setFetchMode(PDO::FETCH_ASSOC); // modo de recuperar los datos de la select
	 $resultado=$stmt->fetchAll(); // guardar la lasida de la select en un Array Asociativo
	 foreach($resultado as $row) {
        echo "Codigo dpto: " . $row["cod_dpto"]. " - Nombre: " . $row["nombre_dpto"]. "<br>";
     }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?>
