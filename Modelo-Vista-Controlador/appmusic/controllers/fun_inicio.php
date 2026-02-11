<?php
    require_once '..\views\inicio.php';
    require_once '..\models\bd_inicio.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {  
        cerrar_sesion();
        
    }


    
    
?>