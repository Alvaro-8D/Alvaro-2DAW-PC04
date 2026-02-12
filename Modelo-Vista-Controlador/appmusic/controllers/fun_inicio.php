<?php
// Conexión base de datos
    require_once '..\db\conexion_bd.php'; 
// Funciones Comunes
    require_once 'fun_comunes.php';
    impide_acceso_sesion_cerrada();
// Página Orquestadora (Pagina Inicio)
    require_once '..\views\inicio.php';
    require_once '..\models\bd_inicio.php';
// Sub-Páginas de la Web
    // Historial Facturas COMPLETO
    require_once '..\models\bd_histfacturas.php';
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {  
        cerrar_sesion();


        if(isset($_POST['historial_pagos'])){
            $GLOBALS['historial_completo'] = recuperar_hist($_COOKIE['id_cliente']);
            require_once '..\views\histfacturas.php';
        }
        if(isset($_POST['hola'])){
            require_once '..\views\hola.php';
        }
        
        
    }
    
    
?>