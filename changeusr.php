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
    <form action="changeusr.php">
        <h2>Modificar usuario</h2>
        <p>Contraseña actual: <input type="password" name="actual_pw"></p>
        <p><b>Nuevas Credenciales</b></p>
        <p>Nuevo nombre: <input type="text" name="new_usr"></p>
        <p>Nuevo email: <input type="email" name="new_email"></p>
        <p>Nueva password: <input type="password" name="new_pass" id=""></p>
        <p><input type="submit" value="Modificar" name="modificar"></p>
    </form>
    <a id='volver' href='inicio.html'>Volver al inicio</a>
    <br>
    <?php
        if (isset($_REQUEST["modificar"])) {
            $actual_pw=trim(strip_tags($_REQUEST["actual_pw"]));
            $new_usr=trim(strip_tags($_REQUEST["new_usr"]));
            $new_email=trim(strip_tags($_REQUEST["new_email"]));
            $new_pass=trim(strip_tags($_REQUEST["new_pass"]));
            //recuperamos el nombre de usuario
            $archivo_usuario=fopen("usuario.txt","r");
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
                
                if (!empty($new_email)) {
                    $query_email="update usuario set correo = '$new_email' where nombres like '$usuario_var'";
                    $query_email_real=mysqli_query($conexion,$query_email);
                }
                if (!empty($new_pass)) {
                    $query_npass="update usuario set clave = '$new_pass' where nombres like '$usuario_var'";
                    $query_npass_real=mysqli_query($conexion,$query_npass);
                }
                #NOTA IMPORTANTE: la modificacion del nombre de usuario tiene que ser lo último. Si se modifica lo primero, ya no vale el usuario
                #que hemos extraido del documento.
                if (!empty($new_usr)) {
                    $query_usr="update usuario set nombres = '$new_usr' where nombres like '$usuario_var'";
                    $query_usr_real=mysqli_query($conexion,$query_usr);
                }

                print "<br>";
                print "<table><tr><td><b>Usuario modificado con éxito.</b></td></tr></table>";
            }
            mysqli_close($conexion);
            

        }
    ?>
</body>
</html>