<HTML>
<HEAD><TITLE> EJ2-Direccion Red – Broadcast y Rango</TITLE></HEAD>
<BODY>

<?php
    $ip="192.168.16.100/16";

    function imprimir($ip,$mas,$red,$broad,$rang)
    {
        print("<h1> Ip ".$ip."<br> Máscara ".$mas."<br> Direccion Red: ".$red."<br> Direccion Broadcast: ".$broad."<br> Rango: ".$rang."</h1>");
    }
    function mascara ($ip){
        $mascara = substr($ip,strpos($ip,"/")+1);
        return $mascara;
    }
    // --------------------------> NOTA: USAR PAPEL Y BOLI
    // (TENGO QUE CAMBIAR ESTO PARA QUE SEA MAS SENCILLO Y ENTENDIENDO TODO)
    function red ($ip,$mas){ 
        $a = 0; $b = 0; $c = 0; $d = 0;
        $n = 0; // contador para el switch
        $num = strtok($ip,".");

        while ($num !== false) {
            $n++;
            switch ($n) {
                case 1:
                    $a = $num;
                    break;
                case 2:
                    $b = $num;
                    break;
                case 3:
                    $c = $num;
                    break;
                case 4:
                    $d = $num;
                    break;
                default:
                    print("<h1>ERROR</h1>");
                    break;
            }
            $num = strtok(".");
        }

        $a = base_convert($a,10,2);
        $b = base_convert($b,10,2);
        $c = base_convert($c,10,2);
        $d = base_convert($d,10,2);
        print($a.".".$b.".".$c.".".$d);

        
    }

    imprimir($ip,mascara($ip),red($ip,mascara($ip)),0,0);


?>

</BODY>
</HTML>
