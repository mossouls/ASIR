<?php
    print"<p>Operaciones con números aleatorios</p>\n";
    $num1=rand(1,100);
    $num2=rand(1,100);
    print"<p><input type='text' value='$num1'/></p>\n";
    print"<p><input type='text' value='$num2'/></p>\n";
    $multiplicacion=$num1*$num2;
    $suma=$num1+$num2;
    $division=$num1/$num2;
    $resta=$num1-$num2;
    print"<p>La suma de $num1 y $num2 es $suma</p>\n";
    print"<p>La resta de $num1 y $num2 es $resta</p>\n";
    print"<p>La multiplicacion de $num1 y $num2 es $multiplicacion</p>\n";
    print"<p>La division de $num1 y $num2 es $division</p>\n";

    
?>