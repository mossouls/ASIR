<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Virtual</title>
    <style>
        
    </style>
</head>
<body style="font-family:arial;">
    <form action="agenda.php">
        <h2>Agenda Virtual PHP</h2>
        <h1>Contactos</h1>
        Para guardar presione el botón                              <br>
        Nombre: <input type="text" name="nombre" id="">             <br>
        Trabajo: <input type="text" name="trabajo" id="">           <br>
        Telefono: <input type="tel" name="tel" id="">               <br>
        Dirección: <input type="text" name="direccion" id="">       <br>
        Otras: <input type="text" name="otras" id="">               <br>
        <input type="submit" value="Guardar" name="guardar">
        <input type="submit" value="Mostrar" name="mostrar">
        <input type="submit" value="Reset" name="reset">
    </form>
    <?php
        $nombre=strip_tags(trim($_REQUEST["nombre"]));
        $trabajo=strip_tags(trim($_REQUEST["trabajo"]));
        $tel=strip_tags(trim($_REQUEST["tel"]));
        $direccion=strip_tags(trim($_REQUEST["direccion"]));
        $otras=strip_tags(trim($_REQUEST["otras"]));
        $nombre_archivo="agenda.txt";
        $existe=false;

        
        if (isset($_REQUEST["guardar"])) {
            $c_contacto=fopen($nombre_archivo,"r");
            while (($linea=fgets($c_contacto))==true) {
                $datos=explode(",",$linea);
                if ($datos[2]==$tel) {
                    print "<p><font color='red'>Contacto existente. No se añadirá.</font></p>\n";
                    $existe=true;
                    break;
                }
            }
            fclose($c_contacto);

            if ($existe==false || file_exists($nombre_archivo)==false) {
            //si el contacto no existe (bucle anterior) O el archivo no existe
            // añadimos el contacto
                $g_contacto=fopen($nombre_archivo,"a");
                fwrite($g_contacto,"$nombre,$trabajo,$tel,$direccion,$otras\n");
                fclose($g_contacto);
            }
        }

        if (isset($_REQUEST["mostrar"])) {
            $c_contacto=fopen($nombre_archivo,"r");
            while (($linea=fgets($c_contacto))==true) {
                $datos=explode(",",$linea);
                $nombres=$datos[0];
                $trabajos=$datos[1];
                $telefonos=$datos[2];
                $direcciones=$datos[3];
                $otroras=$datos[4];
                print "<hr>";
                for ($i=0; $i < count($datos); $i++) { 
                    print "$datos[$i]";
                    print "<br>";
                    
                }
                print "<hr>";

            }
            if (empty($datos)) {
                print "<p><font>Nada que mostrar</font></p>";
            }
            fclose($c_contacto);
        }
    ?>
</body>
</html>