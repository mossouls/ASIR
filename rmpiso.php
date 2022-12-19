<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Piso</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <form action="rmpiso.php">
        <h1>Borrar Piso de la Base de datos</h1>
        <p>Introduce el código del piso a eliminar <input type="text" name="cod_piso"></p>
        <p><input type="submit" value="Eliminar" name="eliminar"></p>
    </form>
    <?php
        if (isset($_REQUEST["eliminar"])) {
            $cod_piso=strip_tags(trim($_REQUEST["cod_piso"]));
            #conectamos al servidor
            $conexion=mysqli_connect("localhost","root","rootroot") or die ("Imposible conectar al servidor.");
            #seleccionamos la BD
            mysqli_select_db($conexion,"inmobiliaria") or die ("No se puede acceder a la base de datos");
            #realizamos la consulta sobre el código
            $query="select * from pisos where codigo_piso = $cod_piso";
            $consulta=mysqli_query($conexion,$query);
            #obtenemos las lineas
            $lineas=mysqli_num_rows($consulta);
            if ($lineas!=0) {
                header("Location:delpiso.php?cod=$cod_piso");
            }else{
                print "<br>";
                print "<table><tr><td><b>No se encontraron coincidencias</b></td></tr></table>";
            }
        }
    ?>
</body>
</html>