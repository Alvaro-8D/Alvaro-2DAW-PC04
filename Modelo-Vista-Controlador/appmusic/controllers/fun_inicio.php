<?php
// Conexión base de datos
    require_once '..\db\conexion_bd.php'; 
// Funciones Comunes
    require_once 'fun_comunes.php';
    impide_acceso_sesion_cerrada();
// Página Orquestadora (Pagina Inicio)
    require_once '..\views\inicio.php';

    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {  
        cerrar_sesion();
        
        
        if(isset($_POST['historial_pagos'])){
            require_once '..\models\bd_histfacturas.php';
            $GLOBALS['historial_completo'] = recuperar_hist($_COOKIE['id_cliente']);
            require_once '..\views\histfacturas.php';
        }
        if(isset($_POST['downmusic'])){
            require_once 'fun_downmusic.php';
        }
        if(isset($_POST['facturas'])){
            require_once '..\views\facturas.php';
        }
        if(isset($_POST['ranking'])){
            require_once '..\views\ranking.php';
        }
        
        
    }
    
    
?>