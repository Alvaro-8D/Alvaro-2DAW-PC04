<?php
// Conexión base de datos
    require_once '..\db\conexion_bd.php'; 
// Funciones Comunes
    require_once 'fun_comunes.php';
    impide_acceso_sesion_cerrada();
// Página Orquestadora (Pagina Inicio)
    require_once '..\views\inicio.php';

    
    //var_dump($GLOBALS);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {  
        cerrar_sesion();
        
        
        if(isset($_POST['historial_pagos'])){
            require_once '..\models\bd_histfacturas.php';
            $historial_completo = recuperar_hist($_COOKIE['id_cliente']);
            require_once '..\views\histfacturas.php';
        }
        if(isset($_POST['downmusic'])){
            header("Location: fun_downmusic.php");;
        }
        if(isset($_POST['facturas'])||isset($_POST['fecha1'])||isset($_POST['fecha2'])){
            /*
            HACER QUE ESTO FUNCIONE:
             hay que conseguir enviar una fecha "desde" y otra fecha "hasta" 
             y mostrar las facturas entre esas dos fechas.
            */
            require_once '..\models\bd_facturas.php';
            require_once '..\views\facturas.php';
            if(isset($_POST['fecha1'])){
                $fecha1 = limpiar_campos($_POST['fecha1']);
            }else{$fecha1 = null;} 
            
            if(isset($_POST['fecha2'])){
                $fecha2 = limpiar_campos($_POST['fecha2']);
            }else{$fecha2 = null;} 
            
            $GLOBALS['facturas_fechas'] = recuperar_facturas($_COOKIE['id_cliente'],$fecha1,$fecha2);
            var_dump( $GLOBALS['facturas_fechas']);
            require_once '..\views\facturas.php';
            
             
        }
        if(isset($_POST['ranking'])){
            require_once '..\models\bd_ranking.php';
            $GLOBALS['ranking'] = hacer_ranking($_COOKIE['id_cliente']);
            require_once '..\views\ranking.php';
        }
        
        
    }
    
    
?>