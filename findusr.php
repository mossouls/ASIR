<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar usuario</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <form action="findusr.php">
        <h2>Buscar Usuario</h2>
        <p>Buscar: <input type="text" name="findusr"></p>
        <input type="submit" value="Buscar" name="buscar">
    </form>
    <br>
    <a id='volver' href='inicio.html'>Volver al inicio</a>
    <br>
    <?php
        if (isset($_REQUEST["buscar"])) {
            $findusr=strip_tags(trim($_REQUEST["findusr"]));

            $conexion=mysqli_connect("localhost","root","rootroot") or die ("Imposible conectar con el servidor");      #establecemos la conexion al servidor
            mysqli_select_db($conexion,"inmobiliaria") or die ("Imposible acceder a la base de datos");                 #seleccionamos la base de datos
            $query="SELECT nombres,correo FROM usuario WHERE nombres like '$findusr'";                                  #la consulta que nos devuelve el los datos que coinciden
            $consulta=mysqli_query($conexion,$query);                                                                   #declaramos la consulta a la BD
            if (($num_lineas=mysqli_num_rows($consulta))>0) {                                                           #declaramos el numero de lineas que devuelve la consulra. si es >0
                $array=mysqli_fetch_array($consulta);                                                                   #extraemos los datos de la consulta en un array
                $nombre=$array["nombres"];                                                                              #declaramos el elemento nombre del array
                $correo=$array["correo"];                                                                               #declaramos el elemento correo del array
                print "<br>";
                print "<table>";
                
                for ($i=0; $i < $num_lineas; $i++) { 
                    if ($findusr==$nombre) {
                        print "<tr>";
                        print "<td class='us'>$nombre</td>";           
                        print "<td>$correo</td>";
                        print "</tr>";
                    }
                    
                }
                print "<tr><td><b>Numero de coincidencias</b></td><td>$num_lineas</td></tr>";
                print "</table>";
            
            }else{
                echo "<br>";
                print "<table>";
                print "<tr><td><b>Numero de coincidencias</b></td><td>$num_lineas</td></tr>";
                print "</table>";
            }
            mysqli_close($conexion);
        }
        
    ?>
</body>
</html>