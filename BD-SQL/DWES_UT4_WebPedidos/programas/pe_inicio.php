<?php require '../funciones/fun_comunes.php'; impide_acceso_sesion_cerrada(); ?>
<h1>Formulario: Inicio Cliente</h1>

<form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post'>
    <?php detecta_sesion_iniciada(); ?>
</form>

<?php
    cerrar_sesion();
    //detecta_sesion_iniciada();

    $productos = [
        // Fila 0
        [
            "nombre" => "Teclado Mecánico",
            "precio" => 50.00,
            "stock"  => 15
        ],
        // Fila 1
        [
            "nombre" => "Ratón Gaming",
            "precio" => 25.50,
            "stock"  => 30
        ],
        // Fila 2
        [
            "nombre" => "Monitor 24 pulgadas",
            "precio" => 180.00,
            "stock"  => 5
        ]
    ];

    //var_dump(serialize($productos));
     setcookie("nico_array", serialize($productos), time() + (86400 * 30), "/");
     var_dump("*********** Serializado **************",$_COOKIE["nico_array"]);
     
     var_dump("*********** Array **************", unserialize($_COOKIE["nico_array"]));
    
?>

<br><br>***********************************************
<br><a href="pe_altaped.php"><button>Alta Pedidos</button></a>