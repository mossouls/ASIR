<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir piso</title>
    <link rel="stylesheet" href="css.css">
</head>

    <?php
    #establecemos la conexión con la base de datos
    $conexion=mysqli_connect("localhost","root","rootroot");

    #seleccionamos nuestra BD
    mysqli_select_db($conexion,"inmobiliaria");

    #seleccionamos los propietarios posibles
    $query="select nombres from usuario";
    $real_query=mysqli_query($conexion,$query);

    #extraemos los datos de la query
    $lineas=mysqli_num_rows($real_query);

        for ($i=0; $i < $lineas; $i++) { 
           $array=mysqli_fetch_array($real_query);
            $array_nombres[$i]=$array["nombres"];
        }

    ?>

<body>
    <script>
        //realizamos la validación de inserción de datos NOT NULL con JavaScript
        function validar() {
            var codigo_piso,calle,numero,piso,puerta,cp,metros,precio,imagen;
            codigo_piso=document.formulario.cod_piso.value;
            calle=document.formulario.calle.value;
            numero=document.formulario.num.value;
            piso=document.formulario.piso.value;
            puerta=document.formulario.puerta.value;
            cp=document.formulario.cp.value;
            metros=document.formulario.metros.value;
            precio=document.formulario.precio.value;
            imagen=document.formulario.imagen.value;

            if (codigo_piso == "" || calle == "" || numero == "" || piso == "" || puerta == "" || cp == "" || metros == "" || precio == "" || imagen == "") {
                alert ("Faltan datos necesarios");
                return false;
            }else{
                return true;
            }
            
        };
    </script>

    <form name="formulario" action="addpiso.php" method="post" enctype="multipart/form-data" onsubmit="return (validar())">

            <h2>Introducir piso en la base de datos</h2>
            <p>Código del piso: <input type="text" name="cod_piso"></p>
            <p>Calle: <input type="text" name="calle" id=""></p>
            <p>Número: <input type="number" name="num" id=""></p>
            <p>Piso: <input type="text" name="piso"></p>
            <p>Puerta: <input type="text" name="puerta"></p>
            <p>Código Postal: <input type="text" name="cp" maxlength="5" minlength="5"></p>
            <p>Metros: <input type="number" name="metros" id=""></p>
            <p>Zona: <input type="text" name="zona" id=""></p>
            <p>Precio: <input type="number" name="precio"></p>
            <p>Imagen: <input type="file" name="imagen"></p>
            <p>Propietario: <select name="propietario">
                <?php
                for ($i=0; $i < count($array_nombres); $i++) { 
                    print "<option>$array_nombres[$i]</option>";
                }
                ?>
            </select></p>
            <p><input type="submit" value="Registrar" name="registrar">
            <input type="reset" value="Borrar"></p>
        
    </form>

    <a id='volver' href='inicio.html'>Volver al inicio</a>

    <br>
    
    <?php
    
            if (isset($_REQUEST["registrar"])) 
            
            { #si se pulsa el boton, se inicia el proceso de adción
                $cod_piso=trim(strip_tags($_REQUEST["cod_piso"]));
                $calle=trim(strip_tags($_REQUEST["calle"]));
                $num=$_REQUEST["num"];
                $piso=trim(strip_tags($_REQUEST["piso"]));
                $puerta=trim(strip_tags($_REQUEST["puerta"]));
                $cp=$_REQUEST["cp"];
                $metros=$_REQUEST["metros"];
                $zona=trim(strip_tags($_REQUEST["zona"]));
                $precio=$_REQUEST["precio"];
                $imagen=trim(strip_tags($_REQUEST["imagen"]));
                $propietario=$_REQUEST["propietario"];
                //comprobación de imágen del piso
                $copiarFichero=false;

                #sacamos el ID del usuario que ha introducido
                if (!empty($propietario)) {
                    $usu=mysqli_query($conexion,"select usuario_id from usuario where nombre like '$nombre'");
                    $dato=mysqli_fetch_array($usu);
                    print $dato['id_usuario'];
                }
                //subida de imagen del piso
                if (is_uploaded_file($_FILES['imagen']['tmp_name'])) { //si hay un archivo con el nombre temporal en el fichero tmp
                    $nombre_directorio="C:/AppServ/www/pphp/"; //establecemos el nombre de directorio donde se guardará la imagen
                    $nombre_fichero=$_FILES['imagen']['name']; //establecemos el nombre ya fuera de la carpeta temporal de la imagen
                    $copiarFichero=true; //cambiamos el valor de archivo copiado a true. Si se ha subido el archivo, es una comprobacion
                    
                    //si existe un fichero con el mismo nombre, renombrar el fichero
                    $nombreCompleto=$nombre_directorio.$nombre_fichero;  //este es el nombre resultante del fichero en el apartado anterior (directorio + fichero concreto)

                    if (is_file($nombreCompleto)) { //si ya existe ese nombre
                        $id_unico=time(); //esta funcion genera un valor de tiempo que nunca se puede repetir (minutos transcurridos desde Epoch)
                        $nombre_fichero=$id_unico .'-'. $nombre_fichero; //cambiamos el nombre del fichero añadiendole el valor de tiempo, que siempre será único
                    }
                }
                //el tamaño del fichero supera el límite permitido

                elseif ($_FILES['imagen']['error'] == UPLOAD_ERR_FORM_SIZE) { //si da un error de imagen quivalente al error de tamaño predefinido
                    $max_size=$_REQUEST['MAX_FILE_SIZE']; //igualamos una variable de error al tamaño máximo definido en el archivo de configuración PHP
                    $errores=$errores . "<tr><td><b>El tamaño del fichero subido supera el límite permitido ($max_size bytes)</b></td></tr>\n"; //mostramos mensaje de error
                    $nombre_fichero=''; //borramos el nombre del fichero que no se debe subir a causa del error
                }

                //no se han introducido ficheros
                elseif ($_FILES['imagen']['name'] == "") {
                    $nombre_fichero='';

                }
                else {
                    $errores=$errores . "<tr><td><b>No se ha podido subir el fichero</b></td></tr>\n";
                    $nombre_fichero='';
                }

                if ($errores != "") {
                    print "<tr><td><b>No se ha podido realizar la inserción debido a los siguientes errores:</b></td></tr>";
                    print "<ul>";
                    print "$errores";
                    print "</ul>";
                }

                //insercion del archivo en la base de datos
                if ($copiarFichero) {
                    move_uploaded_file($_FILES['imagen']['tmp_name'],$nombre_directorio.$nombre_fichero);
                }
                
                #la inserción de datos en la BD solo se debe ejecutar si se han introducido todos los datos que no pueden ser NULL

                #comprobamos si el codigo existe en la base de datos:
                $comprobar=mysqli_query($conexion, "select * from pisos where codigo_piso like '$cod_piso'");
                $lineas_comprobar=mysqli_num_rows($comprobar);

                if ($lineas_comprobar == 0) {
                        mysqli_query ($conexion,"insert into pisos (codigo_piso) values ('$cod_piso')");
                        mysqli_query ($conexion,"update pisos set calle = '$calle' where codigo_piso like '$cod_piso'");
                        mysqli_query ($conexion,"update pisos set numero = '$num' where codigo_piso like '$cod_piso'");
                        mysqli_query ($conexion,"update pisos set piso = '$piso' where codigo_piso like '$cod_piso'");
                        mysqli_query ($conexion,"update pisos set puerta = '$puerta' where codigo_piso like '$cod_piso'");
                        mysqli_query ($conexion,"update pisos set cp = '$cp' where codigo_piso like '$cod_piso'");
                        mysqli_query ($conexion,"update pisos set metros = '$metros' where codigo_piso like '$cod_piso'");
                        mysqli_query ($conexion,"update pisos set precio = '$precio' where codigo_piso like '$cod_piso'");
                        mysqli_query ($conexion,"update pisos set imagen = '$nombre_fichero' where codigo_piso like '$cod_piso'");
                        mysqli_query ($conexion,"update pisos set zona = '$zona' where codigo_piso like '$cod_piso'");
                        mysqli_query ($conexion,"update pisos set usuario_id = (select usuario_id from usuario where nombres like '$propietario') where codigo_piso like '$cod_piso'");
                        print "<br>";
                        print "<tr><td><b>Piso registrado con éxito.</b></td></tr>";
                        
                }else {
                    print "<br>";
                    print "<tr><td><b>Ese piso ya está registrado en la base de datos. No se añadirá.</b></td></tr>";
                }
                           
            }

    mysqli_close($conexion);

    ?>
</body>
</html>