<?php
    function limpiar_campos($data) { //Evita la Injección de Código
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function conexionBD() { // Conectarse a la BD
        $servername = "localhost";
        $username = "root";
        $password = "rootroot";
        $dbname = "empleados";

        $consulta = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $consulta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $consulta;
    }

?>