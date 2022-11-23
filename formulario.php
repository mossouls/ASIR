<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>

    <body>
        <?php
            $base=$_REQUEST["base"];
            $altura=$_REQUEST["altura"];
            $enviar=$_REQUEST["enviar"];
            if (isset($enviar)) {
                for ($i=0; $i < $altura; $i++) { 
                    print"*\n";
                    for ($j=0; $j < $base-1; $j++) { 
                        print"*\n";
                    }
                    print"<br>\n";
                }
            }else{

        ?> 
        <form action="formulario.php">
            <p>Introduce la altura:</p>
            <input type="number" name="altura" id="">
            <p>Introduce la base:</p>
            <input type="number" name="base" id="">
            <br>
            <input type="submit" value="Envíar" name="enviar">
        </form>
        <?php
            }
        ?>   
    </body>
</html>