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
    <script>
        function verificar() {
            var cod;
            cod=document.formulario.cod.value;
            if (cod=="") {
                alert ("Tienes que introducir un código de piso a moodificar");
                return false;
            }else{
                return true;
            }
        }
    </script>
    <form name="formulario" action="changepiso.php" method="get" onsubmit="return(verificar());">
    <h1>Modificar piso de la base de datos</h1>
        <p>Introduce el código de piso a modificar <input type="text" name="cod"></p>
        <p><input type="submit" value="Modificar" name="modificar"></p>
    </form>
    <br>
        <a id='volver' href='inicio.html'>Volver al inicio</a>
    <br>
    <?php
        if (isset($_REQUEST["modificar"])) {
            $cod=strip_tags(trim($_REQUEST["cod"]));
            #abrimos conexión al servidor
            $conexion=mysqli_connect("localhost","root","rootroot");
            #seleccionamos la base de datos
            mysqli_select_db($conexion,"inmobiliaria");
            #realizamos la consulta
            $query="select * from pisos where codigo_piso like '$cod'";
            $consulta=mysqli_query($conexion,$query);
            $lineas=mysqli_num_rows($consulta);
            #comprobamos si hay coincidencias
            if ($lineas > 0) {
                header("Location:modpiso.php?cod=$cod");
            }else{
                print "<br>";
                print "<table><tr><td><b>No hay coincidencias en la base de datos.</b></td></tr></table>";
            }
        }

        mysqli_close($conexion);
    ?>
</body>
</html>