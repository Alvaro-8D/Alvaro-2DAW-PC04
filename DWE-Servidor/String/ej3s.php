<HTML>
<HEAD><TITLE> EJ2-Direccion Red – Broadcast y Rango</TITLE></HEAD>
<BODY>

<?php
    $ip="192.168.16.100/29";

    function imprimir($ip,$ip2,$mas,$red,$broad,$rang){
        echo "<h1>",$ip,"</h1>";
        print("<h2> Ip ".$ip2."<br> Máscara ".$mas."<br> Direccion Red: ".$red."<br> Direccion Broadcast: ".$broad."<br> Rango: ".$rang."</h2>");
    }
    
    $mas = substr($ip,strpos($ip,"/")+1); $red1 = ""; $broad = ""; $rango = "";

    $a = substr($ip,0,strpos($ip,"."));
    $b = substr($ip,strpos($ip,".")+1,strpos($ip,".",strpos($ip,".")+1)-(strpos($ip,".")+1));
    $c = substr($ip,strpos($ip,".",strpos($ip,".")+1)+1,strrpos($ip,".")-(strpos($ip,".",strpos($ip,".")+1)+1));
    $d = substr($ip,strpos($ip,".",strpos($ip,".",strpos($ip,".")+1)+1)+1,strpos($ip,"/")-(strpos($ip,".",strpos($ip,".",strpos($ip,".")+1)+1)+1));
    
    $a2 = $a;   $b2 = $b;   $c2 = $c;   $d2 = $d;
    
    $a2 = str_pad(sprintf("%b",$a),8,"0",STR_PAD_LEFT);
    $b2 = str_pad(sprintf("%b",$b),8,"0",STR_PAD_LEFT);
    $c2 = str_pad(sprintf("%b",$c),8,"0",STR_PAD_LEFT);
    $d2 = str_pad(sprintf("%b",$d),8,"0",STR_PAD_LEFT);

    
    $n2 = 0;
    if ($mas <= 8) { 
        $a2 = str_pad(substr_replace($a2,"",($mas)),8,"0",STR_PAD_RIGHT);
        $b2 = "0";  $c2 = "0";  $d2 = "0"; 
        $red1 = (base_convert($a2,2,10).".".$b2.".".$c2.".".$d2);

        $rango = (base_convert($a2,2,10).".".$b2.".".$c2.".".($d2+1));

        $a2 = str_pad(substr_replace($a2,"",($mas)),8,"1",STR_PAD_RIGHT);
        $b2 = "255";  $c2 = "255";  $d2 = "255";
        $broad = (base_convert($a2,2,10).".".$b2.".".$c2.".".$d2);

        $rango = $rango." a ".(base_convert($a2,2,10).".".$b2.".".$c2.".".($d2-1));
    }
    elseif ($mas > 8 && $mas <= 16) {
        $b2 = str_pad(substr_replace($b2,"",($mas-8)),8,"0",STR_PAD_RIGHT);
        $c2 = "0";  $d2 = "0"; 
        $red1 = base_convert($a2,2,10).".".(base_convert($b2,2,10).".".$c2.".".$d2);

        $rango =  base_convert($a2,2,10).".".(base_convert($b2,2,10).".".$c2.".".($d2+1));

        $b2 = str_pad(substr_replace($b2,"",($mas-8)),8,"1",STR_PAD_RIGHT);
        $c2 = "255";  $d2 = "255";
        $broad =  base_convert($a2,2,10).".".(base_convert($b2,2,10).".".$c2.".".$d2);

        $rango = $rango." a ". base_convert($a2,2,10).".".(base_convert($b2,2,10).".".$c2.".".($d2-1));
    }
    elseif ($mas > 16 && $mas <= 24) {
        $c2 = str_pad(substr_replace($c2,"",($mas-16)),8,"0",STR_PAD_RIGHT);
        $d2 = "0"; 
        $red1 = base_convert($a2,2,10).".".(base_convert($b2,2,10)).".".(base_convert($c2,2,10)).".".$d2;

        $rango =  base_convert($a2,2,10).".".(base_convert($b2,2,10)).".".(base_convert($c2,2,10)).".".($d2+1);

        $c2 = str_pad(substr_replace($c2,"",($mas-16)),8,"1",STR_PAD_RIGHT);
        $d2 = "255";
        $broad =  base_convert($a2,2,10).".".(base_convert($b2,2,10)).".".(base_convert($c2,2,10)).".".$d2;

        $rango = $rango." a ". base_convert($a2,2,10).".".(base_convert($b2,2,10)).".".(base_convert($c2,2,10)).".".($d2-1);
    }
    else {
        $d2 = str_pad(substr_replace($d2,"",($mas-24)),8,"0",STR_PAD_RIGHT); 
        $red1 = base_convert($a2,2,10).".".(base_convert($b2,2,10)).".".(base_convert($c2,2,10)).".".(base_convert($d2,2,10));
        
        $rango =  base_convert($a2,2,10).".".(base_convert($b2,2,10)).".".(base_convert($c2,2,10)).".".((base_convert($d2,2,10))+1);

        $d2 = str_pad(substr_replace($d2,"",($mas-24)),8,"1",STR_PAD_RIGHT);
        $broad =  base_convert($a2,2,10).".".(base_convert($b2,2,10)).".".(base_convert($c2,2,10)).".".(base_convert($d2,2,10));

        $rango = $rango." a ". base_convert($a2,2,10).".".(base_convert($b2,2,10)).".".(base_convert($c2,2,10)).".".((base_convert($d2,2,10))-1);
    } 

    $ip2 = ($a.".".$b.".".$c.".".$d);

    imprimir($ip,$ip2,$mas,$red1,$broad,$rango);
?>

</BODY>
</HTML>