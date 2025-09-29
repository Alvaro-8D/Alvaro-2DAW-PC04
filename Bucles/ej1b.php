<HTML>
<HEAD><TITLE> EJ1B – Conversor decimal a binario</TITLE></HEAD>
<BODY>
<?php
$num="168";

function transforma ($dec)
{
    $bin = "";
    while ($dec >= 1) { // transforma de decimal a binario
        $bin = ($dec%2).$bin;
        $dec = (int)($dec/2);   
    }
    return $bin;
}

echo "Numero ",$num," en binario = ",transforma($num);

?>
</BODY>
</HTML>