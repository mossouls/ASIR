<?php
    $base=rand(0,10);
    $altura=rand(0,10);
    print"<p>Base: <input type='text' value='$base'/></p>\n";
    print"<p>Altura: <input type='text' value='$altura'/></p>\n";
    
    for ($i=0; $i < $altura; $i++) { 
        print"*\n";
        for ($j=0; $j < $base-1; $j++) { 
            print"*\n";
        }
        print"<br>\n";
    }