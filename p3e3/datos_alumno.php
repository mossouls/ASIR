<?php
    $nombre=trim(strip_tags($_REQUEST["nombre"]));
    $estudios=$_POST["estudios"];
    $telefono=trim(strip_tags($_REQUEST["tel"]));
    $matriculado=$_REQUEST["matriculado"];
    $mostrar=$_REQUEST["formato"];
    $nombre_archivo="datos.txt";

    if ($mostrar=="pantalla") {
        if ($estudios=="bach" & $matriculado=="on") {
            print "<p>El alumno $nombre, con teléfono $telefono, está matriculado en bachiller.</p>";
        }
            else if ($estudios=="sec" & $matriculado=="on") {
                print "<p>El alumno $nombre, con teléfono $telefono, está matriculado en secundaria.</p>";
            }
            else if ($estudios=="med" & $matriculado=="on") {
                print "<p>El alumno $nombre, con teléfono $telefono, está matriculado en ciclo medio.</p>";
            }    
            else if ($estudios=="sup" & $matriculado=="on") {
                print "<p>El alumno $nombre, con teléfono $telefono, está matriculado en ciclo superior.</p>";
            }
            else if ($matriculado=="off") {
                print "<p>El alumno $nombre, con teléfono $telefono, no está matriculado en nada.</p>";
            }        
    }
    if($mostrar=="guardar"){
            if ($estudios=="bach" & $matriculado=="on") {
                $datos=fopen($nombre_archivo,"w");
                $texto="El alumno $nombre, con teléfono $telefono, está matriculado en bachiller.";
                fputs($datos,$texto);
                fclose($datos);
            }
                else if ($estudios=="sec" & $matriculado=="on") {
                    $datos=fopen($nombre_archivo,"w");
                    $texto="El alumno $nombre, con teléfono $telefono, está matriculado en secundaria.";
                    fputs($datos,$texto);
                    fclose($datos);
                }
                else if ($estudios=="med" & $matriculado=="on") {
                    $datos=fopen($nombre_archivo,"w");
                    $texto="El alumno $nombre, con teléfono $telefono, está matriculado en ciclo medio.";
                    fputs($datos,$texto);
                    fclose($datos);
                }    
                else if ($estudios=="sup" & $matriculado=="on") {
                    $datos=fopen($nombre_archivo,"w");
                    $texto="El alumno $nombre, con teléfono $telefono, está matriculado en ciclo superior.";
                    fputs($datos,$texto);
                    fclose($datos);
                }
                else if ($matriculado=="off") {
                    $datos=fopen($nombre_archivo,"w");
                    $texto="El alumno $nombre, con teléfono $telefono, no está matriculado en nada.";
                    fputs($datos,$texto);
                    fclose($datos);
                }        
        
    }
?>