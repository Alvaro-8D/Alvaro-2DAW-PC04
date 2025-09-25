<HTML>
<HEAD><TITLE> EJ2-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php
    $ip="192.18.16.204";
    $ip2="10.33.161.2";

    function transforma ($dec)
    {
        $bin = "";
        while ($dec >= 1) { // transforma de decimal a binario
            $bin = ($dec%2).$bin;
            $dec = (int)($dec/2);   
        }
        return $bin;
    }
    
    function binario($ip){
        $a = substr($ip,0,strpos($ip,"."));
        $b = substr($ip,strpos($ip,".")+1,strpos($ip,".",strpos($ip,".")+1)-(strpos($ip,".")+1));
        $c = substr($ip,strpos($ip,".",strpos($ip,".")+1)+1,strrpos($ip,".")-(strpos($ip,".",strpos($ip,".")+1)+1));
        $d = substr($ip,strpos($ip,".",strpos($ip,".",strpos($ip,".")+1)+1)+1,strpos($ip,".",strpos($ip,".")+1));
        
        $a = str_pad(transforma($a),8,"0",STR_PAD_LEFT);
        $b = str_pad(transforma($b),8,"0",STR_PAD_LEFT);
        $c = str_pad(transforma($c),8,"0",STR_PAD_LEFT);
        $d = str_pad(transforma($d),8,"0",STR_PAD_LEFT);

        echo "<h2>",$a,".",$b,".",$c,".",$d,"</h2>";
    }
    
    echo "<h2>",$ip,"<br></h2>";
    binario($ip);
    echo "<br><h4>------------------------------------------------------</h4>";
    echo "<h2>",$ip2,"<br></h2>";
    binario($ip2);

?>
</BODY>
</HTML>
