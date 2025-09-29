<HTML>
<HEAD><TITLE> EJ2-Direccion Red – Broadcast y Rango</TITLE></HEAD>
<BODY>

<?php
    $ip="192.168.16.100/21";

    function imprimir($ip,$mas,$red,$broad,$rang)
    {
        print("<h1> Ip ".$ip."<br> Máscara ".$mas."<br> Direccion Red: ".$red."<br> Direccion Broadcast: ".$broad."<br> Rango: ".$rang."</h1>");
    }
    
    $mascara = substr($ip,strpos($ip,"/")+1);
    $a = 0; $b = 0; $c = 0; $d = 0;
    
  
    function red ($ip,$mas,$tipo){ 
        $a = 0; $b = 0; $c = 0; $d = 0;
        $a2 = ""; $b2 = ""; $c2 = ""; $d2 = "";

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

        $a = str_pad(sprintf("%b",$a),8,"0",STR_PAD_LEFT);
        $b = str_pad(sprintf("%b",$b),8,"0",STR_PAD_LEFT);
        $c = str_pad(sprintf("%b",$c),8,"0",STR_PAD_LEFT);
        $d = str_pad(sprintf("%b",$d),8,"0",STR_PAD_LEFT);

        $n2 = 0;
        if ($mas <= 8) { // Porfin, tengo la MASCARA en binario
            while ($n2 < $mas) {
                $n2 ++;
                $a2 = $a2."1";
            }
            $a2 = str_pad($a2,8,"0",STR_PAD_LEFT);
            $b2 = "00000000";  $c2 = "00000000";  $d2 = "00000000";
        }
        elseif ($mas > 8 && $mas <= 16) {
            while ($n2 < ($mas-8)) {
                $n2 ++;
                $b2 = $b2."1";
            }
            $b2 = str_pad($b2,8,"0",STR_PAD_LEFT);
            $a2 = "11111111";  $c2 = "00000000";  $d2 = "00000000";
        }
        elseif ($mas > 16 && $mas <= 24) {
            while ($n2 < ($mas-16)) {
                $n2 ++;
                $c2 = $c2."1";
            }
            $c2 = str_pad($c2,8,"0",STR_PAD_LEFT);
            $b2 = "11111111";  $a2 = "11111111";  $d2 = "00000000";
        }
        else {
            while ($n2 < ($mas-24)) {
                $n2 ++;
                $d2 = $d2."1";
            }
            $d2 = str_pad($d2,8,"0",STR_PAD_LEFT);
            $b2 = "11111111";  $a2 = "11111111";  $c2 = "11111111";
        }

        $a3 = red2($a,$a2);
        $b3 = red2($b,$b2);
        $c3 = red2($c,$c2);
        $d3 = red2($d,$d2);

        $a5 = ""; $b5 = ""; $c5 = ""; $d5 = ""; // Dirección Broadcast
            $n2 = 0;
            if ($mas <= 8) { // Mascara en Binario "Invertida"
                while ($n2 < $mas) {
                    $n2 ++;
                    $a5 = "0".$a5;
                }
                $a5 = str_pad($a5,8,"1",STR_PAD_RIGHT);
                $b5 = "11111111";  $c5 = "11111111";  $d5 = "11111111";
            }
            elseif ($mas > 8 && $mas <= 16) {
                while ($n2 < ($mas-8)) {
                    $n2 ++;
                    $b5 = "0".$b5;
                }
                $b5 = str_pad($b5,8,"0",STR_PAD_RIGHT);
                $a5 = "00000000";  $c5 = "11111111";  $d5 = "11111111";
            }
            elseif ($mas > 16 && $mas <= 24) {
                while ($n2 < ($mas-16)) {
                    $n2 ++;
                    $c5 = "0".$c5;
                }
                $c5 = str_pad($c5,8,"1",STR_PAD_RIGHT);
                $b5 = "00000000";  $a5 = "00000000";  $d5 = "11111111";
            }
            else {
                while ($n2 < ($mas-24)) {
                    $n2 ++;
                    $d5 = "0".$d5;
                }
                $d5 = str_pad($d5,8,"0",STR_PAD_RIGHTT);
                $b5 = "00000000";  $a5 = "00000000";  $c5 = "00000000";
            }

            $a5 = red3(str_pad(base_convert($a3,10,2),8,"0",STR_PAD_LEFT),$a5);                      
            $b5 = red3(str_pad(base_convert($b3,10,2),8,"0",STR_PAD_LEFT),$b5);                      
            $c5 = red3(str_pad(base_convert($c3,10,2),8,"0",STR_PAD_LEFT),$c5);                      
            $d5 = red3(str_pad(base_convert($d3,10,2),8,"0",STR_PAD_LEFT),$d5);  


        $respuesta = "";
        switch ($tipo) {
            case 1:
               $respuesta = ($a3.".".$b3.".".$c3.".".$d3); // Dirección Red
                break;
            case 2:
               $respuesta = ($a5.".".$b5.".".$c5.".".$d5); // Dirección Broadcast
                break;

            case 3:
               $respuesta = ($a3.".".$b3.".".$c3.".".($d3+1))." a ".($a5.".".$b5.".".$c5.".".($d5-1)); // Rango de IPs
                break;
            
            default:
                echo "ERROR EN EL RETURN DE LA FUNCION \"RED\"";
                break;
        }
        return $respuesta;
    }

    function red2($a,$a2){ // para la dirección red
            $a3 = "";
            for ($i=0; $i < 8; $i++) { 
                if (((substr_compare(substr($a,$i,1),"1",0,1))==0) && ((substr_compare(substr($a2,$i,1),"1",0,1))==0)) {
                    $a3 = $a3."1";
                }
                else{
                    $a3 = $a3."0";
                }
            }
            return base_convert($a3,2,10);
    }  

        function red3($a,$a2){ // para la dirección broadcast
            $a3 = "";
            for ($i=0; $i < 8; $i++) { 
                if (((substr_compare(substr($a,$i,1),"1",0,1))==0) || ((substr_compare(substr($a2,$i,1),"1",0,1))==0)) {
                    $a3 = $a3."1";
                }
                else{
                    $a3 = $a3."0";
                }
            }
            
            return base_convert($a3,2,10);
        }

    imprimir($ip,$mascara,red($ip,$mascara,1),red($ip,$mascara,2),red($ip,$mascara,3));


?>

</BODY>
</HTML>