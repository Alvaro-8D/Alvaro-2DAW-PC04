<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php
    $ip="192.18.16.204";

    $a = 192;
    $b = 18;
    $c = 16;
    $d = 204;

    $a2 = substr($ip,0,3);
    print ("------------------->".$a2."<br><br>");
    $b2;
    $c2;
    $d2;
    
    function transforma (&$dec)
    {
        $bin = "";
        while ($dec >= 1) {
            print ($dec."  > ".($dec%2)."<br>");
            $bin = ($dec%2).$bin;
            $dec = (int)($dec/2);

            
        }
        print("<br>");

        while (8 > strlen($bin)) { // añade "0" hasta que sean 8 bit
            $bin = "0".$bin;
        }

        return $bin;
    }
    
    print(transforma($a).".".transforma($b).".".transforma($c).".".transforma($d));
    

?>
</BODY>
</HTML>