<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inmobiliaria</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <?php
                #establecemos la conexion con el servidor
                $conexion=mysqli_connect("localhost","root","rootroot") or die("Imposible conectar.");      
                
                #seleccionamos la BD
                mysqli_select_db($conexion,"inmobiliaria") or die("imposible seleccionar la base de datos.");
                
                #está es la consulta. La almacenamos en la variable query. Es solo un string, no es la consulta sobre la BD.
                $query="SELECT nombres,correo from usuario";

                #esta si es la consulta sobre la BD. 
                $lista=mysqli_query($conexion,$query);

                #devuelve el numero de filas de la consulta.
                $num_filas=mysqli_num_rows($lista);

                #si la consulta tiene mas de 0 filas, es que hay usuarios.
                if ($num_filas>0) {
                    print "<table>";

                    for ($i=0; $i < $num_filas; $i++) {     #recorre el array tantas veces como filas tenga
                        $array=mysqli_fetch_array($lista);  #mete los resultados de una consulta en un array
                        $nombre=$array["nombres"];          #almacena el elemento "nombre" del array en una variable
                        $correo=$array["correo"];           #almacena el elemento "correo" del array en una variable
                        print "<tr>";
                        print "<td class='us'>$nombre</td>";           
                        print "<td>$correo</td>";           
                        print "</tr>";                      
                    }

                    print "<tr><td><b>Usuarios totales</b></td><td>$num_filas</td></tr>";
                    print "</table>";
                    
                }else{
                    echo "Sin usuarios";
                }
                mysqli_close($conexion);
                print "<br>";
                print "<a id='volver' href='inicio.html'>Volver al inicio</a>";
    ?>
</body>
</html>