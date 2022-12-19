<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar piso</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <?php
        //conexion al servidor
        $conexion=mysqli_connect("localhost","root","rootroot");
        //seleccion de la BD
        mysqli_select_db($conexion,"inmobiliaria");
        //obtenemos los campos de la tabla pisos por los que buscaremos:
        $query_campos="show columns from pisos where Field like 'codigo_piso' or Field like 'zona' or Field like 'cp' or Field like 'calle'";
        $consulta_campos=mysqli_query($conexion,$query_campos);
        $lineas_consulta_campos=mysqli_num_rows($consulta_campos);
        for ($i=0; $i < $lineas_consulta_campos; $i++) { 
            $datos_campos=mysqli_fetch_array($consulta_campos);
            $campos[$i]=$datos_campos["Field"];
        }
    ?>
    <form action="findpiso.php">
        <h1>Búsqueda de pisos</h1>
        <select name="campo">
        <?php
            for ($i=0; $i < count($campos); $i++) { 
                print "<option>".$campos[$i]."</option>";
            }
        ?>
        </select>
        <input type="text" name="dato">
        <br>
        <input type="submit" value="Buscar" name="buscar">
    </form>
    <br>
    <a id='volver' href='inicio.html'>Volver al inicio</a>
    <br>
    
    <?php
        if (isset($_REQUEST["buscar"])) {

            $dato=strip_tags(trim($_REQUEST["dato"]));

            //seleccionamos los datos de la base, y los extraemos en arrays

            if ($_REQUEST["campo"] == "codigo_piso") {
                $query="select * from pisos where codigo_piso like '$dato'";
                $consulta=mysqli_query($conexion,$query);
                $filas_consulta=mysqli_num_rows($consulta);
                if ($filas_consulta != 0) {
                    for ($i=0; $i < $filas_consulta; $i++) { 
                        $datos_consulta=mysqli_fetch_array($consulta);
                        print "<br>";
                        print "<table>";
                        print "<tr><td><b>Código de piso</b></td><td>".$datos_consulta['codigo_piso']."</td></tr>";
                        print "<tr><td><b>Calle</b></td><td>".$datos_consulta['calle']."</td></tr>";
                        print "<tr><td><b>Número</b></td><td>".$datos_consulta['numero']."</td></tr>";
                        print "<tr><td><b>Piso</b></td><td>".$datos_consulta['piso']."</td></tr>";
                        print "<tr><td><b>Puerta</b></td><td>".$datos_consulta['puerta']."</td></tr>";
                        print "<tr><td><b>CP</b></td><td>".$datos_consulta['cp']."</td></tr>";
                        print "<tr><td><b>Metros</b></td><td>".$datos_consulta['metros']."</td></tr>";
                        print "<tr><td><b>Zona</b></td><td>".$datos_consulta['zona']."</td></tr>";
                        print "<tr><td><b>Precio</b></td><td>".$datos_consulta['precio']."</td></tr>";
                        print "<tr><td><b>Imagen</b></td><td><img src='".$datos_consulta['imagen']."'></td></tr>";
                        print "<tr><td><b>ID de usuario</b></td><td>".$datos_consulta['usuario_id']."</td></tr>";
    
                        $query_propietarios="select nombres from usuario where usuario_id like ".$datos_consulta["usuario_id"].";";
                        $consulta_propietario=mysqli_query($conexion,$query_propietarios);
                        $array_propietario=mysqli_fetch_array($consulta_propietario);
                
                        print "<tr><td><b>Nombre del propietario</b></td><td>". $array_propietario["nombres"] ."</td></tr>";
                        print "</table>";
                    }
                }else{
                    print "<br>";
                    print "<table><tr><td><b>No hay coincidencias en la base de datos.</b></td></tr></table>";
                }

            }

            if ($_REQUEST["campo"] == "calle") {
                $query="select * from pisos where calle like '$dato'";
                $consulta=mysqli_query($conexion,$query);
                $filas_consulta=mysqli_num_rows($consulta);
                if ($filas_consulta != 0) {
                    for ($i=0; $i < $filas_consulta; $i++) { 
                        $datos_consulta=mysqli_fetch_array($consulta);
                        print "<table>";
                        print "<tr><td><b>Código de piso</b></td><td>".$datos_consulta['codigo_piso']."</td></tr>";
                        print "<tr><td><b>Calle</b></td><td>".$datos_consulta['calle']."</td></tr>";
                        print "<tr><td><b>Número</b></td><td>".$datos_consulta['numero']."</td></tr>";
                        print "<tr><td><b>Piso</b></td><td>".$datos_consulta['piso']."</td></tr>";
                        print "<tr><td><b>Puerta</b></td><td>".$datos_consulta['puerta']."</td></tr>";
                        print "<tr><td><b>CP</b></td><td>".$datos_consulta['cp']."</td></tr>";
                        print "<tr><td><b>Metros</b></td><td>".$datos_consulta['metros']."</td></tr>";
                        print "<tr><td><b>Zona</b></td><td>".$datos_consulta['zona']."</td></tr>";
                        print "<tr><td><b>Precio</b></td><td>".$datos_consulta['precio']."</td></tr>";
                        print "<tr><td><b>Imagen</b></td><td><img src='".$datos_consulta['imagen']."'></td></tr>";
                        print "<tr><td><b>ID de usuario</b></td><td>".$datos_consulta['usuario_id']."</td></tr>";
    
                        $query_propietarios="select nombres from usuario where usuario_id like ".$datos_consulta["usuario_id"].";";
                        $consulta_propietario=mysqli_query($conexion,$query_propietarios);
                        $array_propietario=mysqli_fetch_array($consulta_propietario);
                
                        print "<tr><td><b>Nombre del propietario</b></td><td>". $array_propietario["nombres"] ."</td></tr>";
                        print "</table>";
                    }
                }else{
                    print "<table><tr><td><b>No hay coincidencias en la base de datos.</b></td></tr></table>";
                }

            }

            if ($_REQUEST["campo"] == "cp") {
                $query="select * from pisos where cp like '$dato'";
                $consulta=mysqli_query($conexion,$query);
                $filas_consulta=mysqli_num_rows($consulta);
                if ($filas_consulta != 0) {
                    for ($i=0; $i < $filas_consulta; $i++) { 
                        $datos_consulta=mysqli_fetch_array($consulta);
                        print "<table>";
                        print "<tr><td><b>Código de piso</b></td><td>".$datos_consulta['codigo_piso']."</td></tr>";
                        print "<tr><td><b>Calle</b></td><td>".$datos_consulta['calle']."</td></tr>";
                        print "<tr><td><b>Número</b></td><td>".$datos_consulta['numero']."</td></tr>";
                        print "<tr><td><b>Piso</b></td><td>".$datos_consulta['piso']."</td></tr>";
                        print "<tr><td><b>Puerta</b></td><td>".$datos_consulta['puerta']."</td></tr>";
                        print "<tr><td><b>CP</b></td><td>".$datos_consulta['cp']."</td></tr>";
                        print "<tr><td><b>Metros</b></td><td>".$datos_consulta['metros']."</td></tr>";
                        print "<tr><td><b>Zona</b></td><td>".$datos_consulta['zona']."</td></tr>";
                        print "<tr><td><b>Precio</b></td><td>".$datos_consulta['precio']."</td></tr>";
                        print "<tr><td><b>Imagen</b></td><td><img src='".$datos_consulta['imagen']."'></td></tr>";
                        print "<tr><td><b>ID de usuario</b></td><td>".$datos_consulta['usuario_id']."</td></tr>";
    
                        $query_propietarios="select nombres from usuario where usuario_id like ".$datos_consulta["usuario_id"].";";
                        $consulta_propietario=mysqli_query($conexion,$query_propietarios);
                        $array_propietario=mysqli_fetch_array($consulta_propietario);
                
                        print "<tr><td><b>Nombre del propietario</b></td><td>". $array_propietario["nombres"] ."</td></tr>";
                        print "</table>";
                    }
                }else{
                    print "<table><tr><td><b>No hay coincidencias en la base de datos.</b></td></tr></table>";
                }

            }

            if ($_REQUEST["campo"] == "zona") {
                $query="select * from pisos where zona like '$dato'";
                $consulta=mysqli_query($conexion,$query);
                $filas_consulta=mysqli_num_rows($consulta);
                if ($filas_consulta != 0) {
                    for ($i=0; $i < $filas_consulta; $i++) { 
                        $datos_consulta=mysqli_fetch_array($consulta);
                        print "<table>";
                        print "<tr><td><b>Código de piso</b></td><td>".$datos_consulta['codigo_piso']."</td></tr>";
                        print "<tr><td><b>Calle</b></td><td>".$datos_consulta['calle']."</td></tr>";
                        print "<tr><td><b>Número</b></td><td>".$datos_consulta['numero']."</td></tr>";
                        print "<tr><td><b>Piso</b></td><td>".$datos_consulta['piso']."</td></tr>";
                        print "<tr><td><b>Puerta</b></td><td>".$datos_consulta['puerta']."</td></tr>";
                        print "<tr><td><b>CP</b></td><td>".$datos_consulta['cp']."</td></tr>";
                        print "<tr><td><b>Metros</b></td><td>".$datos_consulta['metros']."</td></tr>";
                        print "<tr><td><b>Zona</b></td><td>".$datos_consulta['zona']."</td></tr>";
                        print "<tr><td><b>Precio</b></td><td>".$datos_consulta['precio']."</td></tr>";
                        print "<tr><td><b>Imagen</b></td><td><img src='".$datos_consulta['imagen']."'></td></tr>";
                        print "<tr><td><b>ID de usuario</b></td><td>".$datos_consulta['usuario_id']."</td></tr>";
    
                        $query_propietarios="select nombres from usuario where usuario_id like ".$datos_consulta["usuario_id"].";";
                        $consulta_propietario=mysqli_query($conexion,$query_propietarios);
                        $array_propietario=mysqli_fetch_array($consulta_propietario);
                
                        print "<tr><td><b>Nombre del propietario</b></td><td>". $array_propietario["nombres"] ."</td></tr>";
                        print "</table>";
                    }
                }else{
                    print "<table><tr><td><b>No hay coincidencias en la base de datos.</b></td></tr></table>";
                }

            }

            
        }
    ?>
</body>
</html>