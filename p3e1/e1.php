<?php
    $ancho=$_REQUEST["ancho"];
    $alto=$_REQUEST["alto"];

    for ($i=0; $i < $alto; $i++) { 
        print "*\n";
        for ($j=1; $j < $ancho; $j++) { 
                print "*\n";
            }
        print "<br>\n";
    }

?>