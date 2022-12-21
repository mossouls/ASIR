<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Piso</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <?php
            $cod_piso=$_GET["cod"];
            //conectamos a la base de datos
            $conexion=mysqli_connect("localhost","root","rootroot") or die ("Imposible conectar al servidor.");
            //seleccionamos la base de datos
            mysqli_select_db($conexion,"inmobiliaria") or die ("Imposible acceder a la base de datos.");
            $query="select nombres from usuario";
            $real_query=mysqli_query($conexion,$query);
        
            #extraemos los datos de la query
            $lineas=mysqli_num_rows($real_query);
        
                for ($i=0; $i < $lineas; $i++) { 
                   $array=mysqli_fetch_array($real_query);
                    $array_nombres[$i]=$array["nombres"];
                }

    ?>
    <form action="modpiso.php" method="post" enctype="multipart/form-data">
        <h1>Modificar datos</h1>
        <input type="hidden" name="cod_piso" value=<?php print "$cod_piso" ?>
        <p>Introduce una nueva calle  <input type="text" name="nueva_calle"></p>
        <p>Introduce un nuevo número <input type="number" name="nuevo_numero"></p>
        <p>Introduce un nuevo piso <input type="text" name="nuevo_piso"></p>
        <p>Introduce una nueva puerta <input type="text" name="nueva_puerta"></p>
        <p>Introduce un nuevo código postal <input type="number" maxlength="5" name="nuevo_cp"></p>
        <p>Introduce un nuevas dimensiones (metros cuadrados) <input type="number" name="nuevo_metros"></p>
        <p>Introduce una nueva zona <input type="text" name="nueva_zona"></p>
        <p>Introduce un nuevo precio <input type="number" name="nuevo_precio"></p>
        <p>Introduce un nuevo imagen <input type="file" name="nueva_imagen"></p> 
        <p>Propietario: <select name="nuevo_propietario">
            <option></option>
            <?php
                for ($i=0; $i < count($array_nombres); $i++) { 
                    print "<option>$array_nombres[$i]</option>";
                }
            ?>
        </select></p>
        <p><input type="submit" value="Modificar" name="modificar"></p>
    </form>
    <br>
        <a id='volver' href='inicio.html'>Volver al inicio</a>
    <br>
    <?php
        if (isset($_REQUEST["modificar"])) {
            #definimos las variables
            $cod_piso=$_REQUEST["cod_piso"];
            $nueva_calle=strip_tags(trim($_REQUEST["nueva_calle"]));
            $nuevo_numero=$_REQUEST["nuevo_numero"];
            $nuevo_piso=strip_tags(trim($_REQUEST["nuevo_piso"]));
            $nueva_puerta=strip_tags(trim($_REQUEST["nueva_puerta"]));
            $nuevo_metros=$_REQUEST["nuevo_metros"];
            $nuevo_cp=$_REQUEST["nuevo_cp"];
            $nueva_zona=strip_tags(trim($_REQUEST["nueva_zona"]));
            $nueva_imagen=$_FILES["nueva_imagen"];
            $nuevo_precio=$_REQUEST["nuevo_precio"];
            $nuevo_propietario=strip_tags(trim($_REQUEST["nuevo_propietario"]));
            $copiar_fichero=false;



            //adicion de nueva imagen
            if (is_uploaded_file($_FILES["nueva_imagen"]["tmp_name"])) { #si el archivo está subido en el fichero temporal
                $dir_fichero="C:/AppServ/www/pphp/";
                $nombre_fichero=$_FILES["nueva_imagen"]["name"]; #establecemos un nombre para el archivo temporal
                $copiar_fichero=true;

                //si el fichero existe le cambiamos el nombre
                $nombre_completo=$dir_fichero.$nombre_fichero;
                if (is_file($nombre_completo)) {
                    $id_unico=time();
                    $nombre_fichero=$id_unico ."-". $nombre_fichero;
                }
            }

            //si el fichero excede el tamaño debido
            elseif ($_FILES["nueva_imagen"]["error"]==UPLOAD_ERR_FORM_SIZE) {
                $maxsize=$_REQUEST["MAX_FILE_SIZE"];
                $errores=$errores . "<p class='msg'><b>El tamaño del fichero subido supera el límite permitido ($maxsize bytes)</b></td></tr></table>\n"; //mostramos mensaje de error
                $nombre_fichero=''; //borramos el nombre del fichero que no se debe subir a causa del error
            }

            //si no se han introducido ficheros
            
            elseif ($nueva_imagen=="") {
                $nombre_fichero="";
            }
            //si no se ha subido ningún fichero
            else {
                $errores=$errores . "<p class='msg'><b>No se ha podido subir el fichero</b></p>>\n";
                $nombre_fichero='';
            }

            //mostramos los errores si los hay
            if ($errores != "") {
                print "<p class='msg'><b>No se ha podido realizar la inserción debido a los siguientes errores:</b></p>";
                print "<ul>";
                print "$errores";
                print "</ul>";
            }

            if ($copiar_fichero==true) {
                move_uploaded_file($_FILES["nueva_imagen"]["tmp_name"],$dir_fichero.$nombre_fichero);
                mysqli_query($conexion,"update pisos set imagen = '$nombre_fichero' where codigo_piso like $cod_piso");
                print "<br>";
                print "<p class='msg'><b>Imagen modificada</b></p>";
            }

            if (!empty($nueva_calle)) {
                mysqli_query($conexion,"update pisos set calle = '$nueva_calle' where codigo_piso like $cod_piso");
                print "<br>";
                print "<p class='msg'><b>Calle modificada</b></p>";
            }

            if (!empty($nuevo_numero)) {
                mysqli_query($conexion,"update pisos set numero = '$nuevo_numero' where codigo_piso like $cod_piso");
                print "<br>";
                print "<p class='msg'><b>Número modificada</b></p>";
            }

            if (!empty($nuevo_piso)) {
                mysqli_query($conexion,"update pisos set piso = '$nuevo_piso' where codigo_piso like $cod_piso");
                print "<br>";
                print "<p class='msg'><b>Planta modificada</b></p>";
            }

            if (!empty($nueva_puerta)) {
                mysqli_query($conexion,"update pisos set puerta = '$nueva_puerta' where codigo_piso like $cod_piso");
                print "<br>";
                print "<p class='msg'><b>Puerta modificada</b></p>";
            }

            if (!empty($nuevo_cp)) {
                mysqli_query($conexion,"update pisos set cp = '$nuevo_cp' where codigo_piso like $cod_piso");
                print "<br>";
                print "<p class='msg'><b>Código postal modificado</b></p>";
            }

            if (!empty($nuevo_metros)) {
                mysqli_query($conexion,"update pisos set metros = '$nuevo_metros' where codigo_piso like $cod_piso");
                print "<br>";
                print "<p class='msg'><b>Dimensiones modificadas</b></p>";
            }

            if (!empty($nueva_zona)) {
                mysqli_query($conexion,"update pisos set zona = '$nueva_zona' where codigo_piso like $cod_piso");
                print "<br>";
                print "<p class='msg'><b>Zona modificada</b></p>";
            }

            if (!empty($nuevo_precio)) {
                mysqli_query($conexion,"update pisos set precio = '$nuevo_precio' where codigo_piso like $cod_piso");
                print "<br>";
                print "<p class='msg'><b>Precio modificado</b></p>";
            }

            if (!empty($nuevo_propietario)) {
                mysqli_query ($conexion,"update pisos set usuario_id = (select usuario_id from usuario where nombres like '$nuevo_propietario') where codigo_piso like $cod_piso");
                print "<br>";
                print "<p class='msg'><b>Propietario modificado</b></p>";
            }
            mysqli_close($conexion);
        }
        

    ?>
</body>
</html>