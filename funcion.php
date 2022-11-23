<?php
    define(TAM,4);
    function potencia($var1,$var2)
    {
        $elevado=pow($var1,$var2);
        return $elevado;
    }

    print "<table border=1px>\n";
    for ($n1=1; $n1<=TAM; $n1++)
    {
     echo "<tr>";
     for ($n2=1; $n2<=TAM; $n2++)
     echo "<td>". potencia($n1,$n2). "</td>";
     echo "</tr>";
   
    }
    
    print "</table>\n";
?>