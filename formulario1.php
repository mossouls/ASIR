<html>
    <head></head>
    <body>
        <?php
            if (isset($_REQUEST["boton"])) {
                $nombre_archivo=$_REQUEST["archivo"];
                $archivo=fopen($nombre_archivo,"r");

                while (!feof($archivo)) {
                    $linea=fgets($archivo);
                    print "$linea <br>";
                }

                fclose($archivo);

            }else{
        ?>
        <form action="formulario1.php">
            Introduce el nombre del archivo que quieres leer: <input type="text" name="archivo" id="">
            <input type="submit" name="boton" value="Leer">
        </form>
        <?php
        }
        ?>
    </body>
</html>
