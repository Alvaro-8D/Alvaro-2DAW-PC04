<HTML>
<HEAD><TITLE> EJ6B – Factorial</TITLE></HEAD>
<BODY>
<?php
    $num= 5;
    $resul = $num;
    $frase = $num."";

    for ($i=$num-1; $i > 0; $i--) { 
        $frase = $frase." x ".($i);
        $resul = ($resul*$i);
    }

    print($frase." = ".$resul)
    
?>


</BODY>
</HTML>
