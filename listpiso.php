<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pisos</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
<?php
    #abrimos la conexión SQL
    $conexion=mysqli_connect("localhost","root","rootroot") or die ("Fallo en la conexión al servidor");

    #seleccionamos la BD
    mysqli_select_db($conexion,"inmobiliaria") or die ("Fallo en la conexión a la base de datos");

    #realizamos la consulta que muestre los pisos
    $query_pisos="select codigo_piso,calle,numero,piso,puerta,cp,metros,zona,precio,imagen,usuario_id from pisos";
    $consulta_pisos=mysqli_query($conexion,$query_pisos);
    $lineas_pisos=mysqli_num_rows($consulta_pisos);

    #buscamos la información de los propietarios
    
    #comprobamos si hay datos
    if ($lineas_pisos==0) {
        print "<table><tr><td>En este momento no hay datos de pisos registrados</td></tr></table>";
        print "<br>";
        print "<a id='volver' href='inicio.html'>Volver al inicio</a>";
    }else {
        
        
        for ($i=0; $i < $lineas_pisos; $i++) {
            
            print "<table>";
            $array_pisos=mysqli_fetch_array($consulta_pisos);
            print "<hr";
            print "<tr><td><b>ID</b></td><td>". $array_pisos["codigo_piso"] ."</td></tr>";
            print "<tr><td><b>Calle</b></td><td>". $array_pisos["calle"] ."</td></tr>";
            print "<tr><td><b>Número</b></td><td>". $array_pisos["numero"] ."</td></tr>";
            print "<tr><td><b>Planta</b></td><td>". $array_pisos["piso"] ."º</td></tr>";
            print "<tr><td><b>Puerta</b></td><td>". $array_pisos["puerta"] ."</td></tr>";
            print "<tr><td><b>Código Postal</b></td><td>". $array_pisos["cp"] ."</td></tr>";
            print "<tr><td><b>Metros</b></td><td>". $array_pisos["metros"] ."</td></tr>";
            print "<tr><td><b>Zona</b></td><td>". $array_pisos["zona"] ."</td></tr>";
            print "<tr><td><b>Precio</b></td><td>". $array_pisos["precio"] ."</td></tr>";
            print "<tr><td><b>Imagen</b></td><td><img src='". $array_pisos["imagen"] ."' width='400px'></td></tr>";
            print "<tr><td><b>Propietario</b></td><td>". $array_pisos["usuario_id"] ."</td></tr>";
            
            $query_propietarios="select nombres from usuario where usuario_id like ".$array_pisos["usuario_id"].";";
            $consulta_propietario=mysqli_query($conexion,$query_propietarios);
            $array_propietario=mysqli_fetch_array($consulta_propietario);
            
            print "<tr><td><b>Nombre del propietario</b></td><td>". $array_propietario["nombres"] ."</td></tr>";
            print "</table>";

        }
        print "<br>";
        print "<a id='volver' href='inicio.html'>Volver al inicio</a>";

    }
?>
</body>
</html>