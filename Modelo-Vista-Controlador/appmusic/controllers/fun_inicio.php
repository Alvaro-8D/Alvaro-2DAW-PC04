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
            header("Location: fun_downmusic.php");;
        }
        if(isset($_POST['facturas'])){
            require_once '..\models\bd_facturas.php';
            $fecha1 = '2009-01-01 00:00:00';
            $fecha2 = '2025-01-01 00:00:00';//date("y-m-d H:i:s");
            $GLOBALS['facturas_fechas'] = recuperar_facturas($_COOKIE['id_cliente'],$fecha1,$fecha2);
            require_once '..\views\facturas.php';
        }
        if(isset($_POST['ranking'])){
            require_once '..\models\bd_ranking.php';
            $GLOBALS['ranking'] = hacer_ranking($_COOKIE['id_cliente']);
            require_once '..\views\ranking.php';
        }
        
        
    }
    
    
?>