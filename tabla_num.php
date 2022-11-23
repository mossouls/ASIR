<?php
// Tenemos que definir tres variables
// Una va a ser el numero que se muestra
// Otra va a ser la de la altura de la tabla (primer bucle)
// Otra la de la base de la tabla (segundo bucle)
    $n=1;
    print "<table border=1px>";
    for ($i=0; $i < 10; $i++) { 
            print "<tr>";
                for ($j=0; $j < 10; $j++) { 
                    print "<td>$n</td>";
                    $n=$n+1;
                }
            print "</tr>";
    }
    print "</table>";
?>