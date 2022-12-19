<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar usuario</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <form action="modusr.php">
        <h2>Modificar usuario</h2>
        <p>¿Qué usuario quieres modificar? <input type="text" name="modusr"></p>
        <p><input type="submit" value="Modificar" name="buscar"></p>
    </form>
    <br>
    <a id='volver' href='inicio.html'>Volver al inicio</a>
    <br>
    <?php
        if (isset($_REQUEST["buscar"])) {
            $modusr=$_REQUEST["modusr"];
            //abrimos la conexión al servidor
            $conexion=mysqli_connect("localhost","root","rootroot") or die ("Imposible conectar al servidor");
            //seleccionamos nuestra base de datos
            mysqli_select_db($conexion,"inmobiliaria") or die ("Imposible acceder a la base de datos");
            //escribrimos la consulta
            $query="select * from usuario where nombres like '$modusr'";
            //declaramos la consulta
            $consulta=mysqli_query($conexion,$query);
            //obtenemos el numero de lineas
            $lineas=mysqli_num_rows($consulta);
            //si hay resultados, damos al usuario la opción de modificar
            if ($lineas>0) {
                header("Location:changeusr.php");
                $archivo_usuario=fopen("usuario.txt","w");
                fwrite($archivo_usuario,"$modusr");
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