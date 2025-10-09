<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php
    $ip="192.18.16.204";
    $ip2="10.33.161.2";

    function binario($ip){
        $a = substr($ip,0,strpos($ip,"."));
        $b = substr($ip,strpos($ip,".")+1,strpos($ip,".",strpos($ip,".")+1)-(strpos($ip,".")+1));
        $c = substr($ip,strpos($ip,".",strpos($ip,".")+1)+1,strrpos($ip,".")-(strpos($ip,".",strpos($ip,".")+1)+1));
        $d = substr($ip,strpos($ip,".",strpos($ip,".",strpos($ip,".")+1)+1)+1,strpos($ip,".",strpos($ip,".")+1));
        
        $a = str_pad(sprintf("%b",$a),8,"0",STR_PAD_LEFT);
        $b = str_pad(sprintf("%b",$b),8,"0",STR_PAD_LEFT);
        $c = str_pad(sprintf("%b",$c),8,"0",STR_PAD_LEFT);
        $d = str_pad(sprintf("%b",$d),8,"0",STR_PAD_LEFT);

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