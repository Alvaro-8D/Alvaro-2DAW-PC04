<HTML>
<HEAD><TITLE> EJ3B – Conversor Decimal a base 16</TITLE></HEAD>
<BODY>
<?php

$num="316";
$base="16";

function letra($resto){
    switch ($resto) {
            case 10:
                $resto = "A";
                break;
            case 11:
                $resto = "B";
                break;
            case 12:
                $resto = "C";
                break;
            case 13:
                $resto = "D";
                break;
            case 14:
                $resto = "E";
                break;
            case 15:
                $resto = "F";
                break;
            default:
                $resto = $resto;
                break;
        } 

        return $resto;
}

function transforma ($dec,$base)
{
    $cociente = $dec;
    $resto = 0;
    $resul = "";

    
    if ($dec < 16) {
        $resul = letra($dec); 
    }
    else {

        if ($cociente >= 16) {

            do {
                
                $resto = $cociente%$base;
                $cociente = (int) ($cociente/$base);
                $resto = letra($resto); 
                $cociente = letra($cociente);

                if ($cociente >= 16) {
                    $resul = $resto.$resul;
                }
                
            } while ($cociente >= 16);

            $resul = $cociente.$resto.$resul;
            
        } 
        else {
            $resul = $cociente.$resto.$resul;
        }       

        
    }
    return $resul;
}

echo "Numero ",$num," en base ",$base," = ",transforma($num,$base);


?>

</BODY>
</HTML>