<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar usuario</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
<form action="delusr.php">
        <h2>Borrar usuario</h2>
        <p>¿Qué usuario quieres borrar? <input type="text" name="delusr"></p>
        <p><input type="submit" value="Borrar" name="buscar"></p>
    </form>
    <br>
    <a id='volver' href='inicio.html'>Volver al inicio</a>
    <br>
    <?php
        if (isset($_REQUEST["buscar"])) {
            $delusr=$_REQUEST["delusr"];
            //abrimos la conexión al servidor
            $conexion=mysqli_connect("localhost","root","rootroot") or die ("Imposible conectar al servidor");
            //seleccionamos nuestra base de datos
            mysqli_select_db($conexion,"inmobiliaria") or die ("Imposible acceder a la base de datos");
            //escribrimos la consulta
            $query="select * from usuario where nombres like '$delusr'";
            //declaramos la consulta
            $consulta=mysqli_query($conexion,$query);
            //obtenemos el numero de lineas
            $lineas=mysqli_num_rows($consulta);
            //si hay resultados, damos al usuario la opción de modificar
            if ($lineas>0) {
                header("Location:rmusr.php");
                $archivo_usuario=fopen("usuario_del.txt","w");
                fwrite($archivo_usuario,"$delusr");
            }else{
                print "<br>";
                print "<table>";
                print "<tr><td><b>No se encontraron coincidencias</b></td></tr>";
                print "</table>";
            }
            fclose($archivo_usuario);
            mysqli_close($conexion);
        }
    ?>
</body>
</html>