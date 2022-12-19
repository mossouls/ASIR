<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <form action="addusr.php">
        <h2>Añadir Usuario</h2>
        <p>Usuario: <input type="text" name="usuario" id=""></p>
        <p>Correo electrónico <input type="email" name="correo" id=""></p>
        <p>Contraseña: <input type="password" name="pw" id=""></p>
        <input type="submit" value="Registrar" name="subir">
    </form>
    <br>
    <a id='volver' href='inicio.html'>Volver al inicio</a>
    <?php
    if (isset($_REQUEST["subir"])) {

        $usuario=trim(strip_tags($_REQUEST["usuario"]));
        $correo=trim(strip_tags($_REQUEST["correo"]));
        $pw=trim(strip_tags($_REQUEST["pw"]));

        $conexion=mysqli_connect("localhost","root","rootroot") or die("Imposible conectar.");
        mysqli_select_db($conexion,"inmobiliaria") or die("imposible seleccionar la base de datos.");
        $query="INSERT INTO usuario (nombres,correo,clave) values ('$usuario','$correo','$pw')";
  

        if (mysqli_query($conexion,$query)) {
            echo "Usuario añadido correctamente";
        }else{
            echo "Error en la adición de usuario";
        }

        print "<br>";
        mysqli_close($conexion);
        
    }   
    ?>
</body>
</html>