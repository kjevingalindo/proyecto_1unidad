<?php 
    require_once 'database.php';

    if ($conexion->connect_error) die ("Fatal error");

    if(!empty($_POST['nombre'])&&!empty($_POST['password1'])){

            if($_POST['password1']==$_POST['password2']){
                $nombre = mysql_entities_fix_string($conexion, $_POST['nombre']);
                $pw_temp = mysql_entities_fix_string($conexion, $_POST['password1']);

                $password = password_hash($pw_temp, PASSWORD_DEFAULT);

                $query="INSERT INTO usuarios (usuario,contraseña)  VALUES ('$nombre','$password')";
                $result = $conexion->query($query);
                if(!$result) die("las contraseñas no coenciden <a href='signup.php'>volvel a registrarce</a>");
                else {
                    $query   = "SELECT * FROM usuarios WHERE usuario='$nombre'";
                    $result  = $conexion->query($query);
                    if ($result->num_rows){
                        $row = $result->fetch_array(MYSQLI_NUM);
                        $result->close();
                        session_start();
                        $_SESSION['nombre']=$row[0];
                        $_SESSION['ide']=$row[2];
                        setcookie('nombre',$_SESSION['nombre'],time()+ 5);
                    }
                    
                    
                    die ("se registro <a href='lobby.php'>continuar</a>");
                }
            }

            else die("la contraseña no cuenside <a href='signup.php'>volver a registrarce</a>");

    }

    else {

        echo <<<_END
        <h1>registrece</h1>
        <span> o    <a href="login.php"> ingrese a su cuenta  </a></span>
      

        <form action="signup.php" method="post"><pre>
        <input type="text" name="nombre" placeholder="ingrese su nombre y apellido">
        <input type="password" name="password1" placeholder="ingrese su contraseña">
        <input type="password" name="password2" placeholder="confirme su contraseña">
        <input type="submit" value ="REGISTRARCE">
    </form>
    _END;
    
    }
    function mysql_entities_fix_string($conexion, $string)
        {
        return htmlentities(mysql_fix_string($conexion, $string));
        }
    function mysql_fix_string($conexion, $string)
        {
          //if (get_magic_quotes_gpc()) $string = stripslashes($string);
        return $conexion->real_escape_string($string);
        } 
?>