<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <form action="rmusr.php">
    <h2>Borrar usuario</h2>
        <p>Introduce la contraseña de usuario: <input type="password" name="actual_pw"></p>
        <p><input type="submit" value="Borrar" name="borrar"></p>
    </form>
    <a id='volver' href='inicio.html'>Volver al inicio</a>
    <br>
    <?php
        if (isset($_REQUEST["borrar"])) {
            $actual_pw=trim(strip_tags($_REQUEST["actual_pw"]));

            //recuperamos el nombre de usuario
            $archivo_usuario=fopen("usuario_del.txt","r");
            //leemos el contenido. Debe haber solo 1 linea
            $usuario_var=fgets($archivo_usuario);
            $usuario_var=trim($usuario_var);
            //cerramos el archivo
            fclose($archivo_usuario);

            //abrimos la conexion al servidor
            $conexion=mysqli_connect("localhost","root","rootroot") or die ("Imposible conectar al servidor");
            //entramos en la BD
            mysqli_select_db($conexion,"inmobiliaria") or die ("Imposible acceder a la base de datos");
            //hacemos la query de la contrasenia
            $query_pass="select clave from usuario where nombres like '$usuario_var'";
            //declaramos la consulta que obtiene la contraseña
            $query_pass_real=mysqli_query($conexion,$query_pass);
            //extraemos la contraseña
            $filas=mysqli_num_rows($query_pass_real);

            //si hay coincidencia entre la contraseña real y la introducida, devuelve una variable true
            for ($i=0; $i < $filas; $i++) { 
                $array=mysqli_fetch_array($query_pass_real);
                $real_pass=$array["clave"];
                if ($real_pass==$actual_pw) {
                    $correct_pw=true;
                }else{
                    print "<table><tr><td><b>La contraseña es incorrecta. No se modificará nada.</b></td></tr></table>";
                }
            }

            //si la contraseña anterior es correcta, seguimos con el codigo. Si no, no
            if ($correct_pw==true) {
                $query="delete from usuario where nombres like '$usuario_var'";
                $query_real=mysqli_query($conexion,$query);
                print "<br>";
                print "<table><tr><td><b>Usuario borrado con éxito.</b></td></tr></table>";
            }
            mysqli_close($conexion);
            

        }
    ?>
</body>
</html>