<?php

    print "<h1>Jugador 1</h1>\n";

    $contador1=0;
    $contador2=0;

    for ($i=0; $i < 5; $i++) { 
        $dado1=rand(1,6);
        print "<img src='img/$dado1.jpg' width='90px'/>\n";
        $contador1=$contador1+$dado1;
    }
    print "<p>El jugador 1 ha sacado $contador1 puntos.</p>\n";
    print "<h1>Jugador 2</h1>\n";

    for ($i=0; $i < 5; $i++) { 
        $dado2=rand(1,6);
        print "<img src='img/$dado2.jpg' width='90px'/>\n";
        $contador2=$contador2+$dado2;
    }
    
    print "<p>El jugador 2 ha sacado $contador2 puntos.</p>\n";
    print "<h1>Resultado</h1>\n";

   
    
    if ($contador1 > $contador2) {
        print "<p>En conjunto, ha ganado el jugador <b>1</b>.</p>\n";
    }else if ($contador2 > $contador1) {
        print "<p>En conjunto, ha ganado el jugador <b>2</b>.</p>\n";
    }else {
        print "<p>Los jugadores han <b>empatado.</b></p>\n";
    }
?>