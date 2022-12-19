<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar piso</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <?php
        $cod_piso=$_GET["cod"];
        #conexion al servidor
        $conexion=mysqli_connect("localhost","root","rootroot");
        #seleccion de la base de datos
        mysqli_select_db($conexion,"inmobiliaria");
        #realizamos la consulta
        $query="delete from pisos where codigo_piso = $cod_piso";
        if ($eliminacion=mysqli_query($conexion,$query)) {
            print "<br>";
            print "<p class='msg'><b>El piso ha sido eliminado</b></p>";
            print "<a id='volver' href='inicio.html'>Volver al inicio</a>";
        }else{
            print "<br>";
            print "<p class='msg'><b>Error en la eliminación</b></p>";
            print "<a id='volver' href='inicio.html'>Volver al inicio</a>";
        }
        
    ?>
</body>
</html>