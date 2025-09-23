<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php
    $ip="192.18.16.204";
    $ip2="10.33.161.2";

    function binario ($ip) {
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

        print("<h2>".$ip." traducido a binario es ..... </h2>");
        print("<h3>".transforma($a).".".transforma($b).".".transforma($c).".".transforma($d)."</h3>");
    }
    
    function transforma (&$dec)
    {
        $bin = "";
        while ($dec >= 1) { // transforma de decimal a binario
            $bin = ($dec%2).$bin;
            $dec = (int)($dec/2);   
        }

        while (8 > strlen($bin)) { // añade "0" hasta que sean 8 bit
            $bin = "0".$bin;
        }

        return $bin;
    }

    binario($ip);
    binario($ip2);

?>
</BODY>
</HTML>
