<HTML>
<HEAD><TITLE> EJ3B – Conversor Decimal a base 16</TITLE></HEAD>
<BODY>
<?php

$num="48";
$base="16";

function transforma ($dec,$b)
{
    $bin = "";
    while ($dec >= 1) { 
        $bin = ($dec%$b).$bin;
        $dec = (int)($dec/$b);   
    }
    return $bin;
}

echo "Numero ",$num," en base ",$base," = ",transforma($num,$base);


?>
</BODY>
</HTML>