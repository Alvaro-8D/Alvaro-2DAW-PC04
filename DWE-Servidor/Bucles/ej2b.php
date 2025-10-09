<HTML>
<HEAD><TITLE> EJ2B – Conversor Decimal a base n </TITLE></HEAD>
<BODY>
<?php

function transforma ($dec,$b)
{
    $bin = "";
    while ($dec >= 1) { 
        $bin = ($dec%$b).$bin;
        $dec = (int)($dec/$b);   
    }
    return $bin;
}

$num = 48;
$base = 6;

echo "Numero ",$num," en base ",$base," = ",transforma($num,$base);
?>

</BODY>
</HTML>