<?php
$fichero="mi_fich.txt";
$mi_fich=fopen($fichero,r);
fputs($mi_fich,"Esto es la primera linea de prueba\n");
fputs($mi_fich,"Esto es la segunda linea de prueba");
while (!feof($mi_fich)) {
    $linea=fgets($mi_fich);
    print"$linea <br>";
}
fclose($mi_fich);
?>