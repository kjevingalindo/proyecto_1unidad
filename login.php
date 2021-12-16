
<?php 
    session_start();
    require_once 'database.php';
    
    
    if($conexion->connect_error) die("Error fatal");

    if (!empty($_POST['username'])&& !empty($_POST['password']))
    {
        $un_temp = mysql_entities_fix_string($conexion, $_POST['username']);
        $pw_temp = mysql_entities_fix_string($conexion, $_POST['password']);
        $query   = "SELECT * FROM usuarios WHERE usuario='$un_temp'";
        $result  = $conexion->query($query);
        if (!$result) die ("Usuario no encontrado");

        elseif ($result->num_rows)
        {
            $row = $result->fetch_array(MYSQLI_NUM);
            $result->close();
            if (password_verify($pw_temp, $row[1])){
                  
                  $_SESSION['nombre']=$row[0];
                  $_SESSION['ide']=$row[2];

                  //cookie
                  setcookie('nombre',$_SESSION['nombre'],time()+ 5);
                  die (" bienvenido <a href='lobby.php'>continuar</a>");
                    
                  echo htmlspecialchars("$row[0] $row[1]:hola $row[0], has ingresado como '$row[0]'");
                  die ("<p><a href='logout.php'>Click para salir</a></p>");
            }
            else{
              
                  die("bUsuario/password incorrecto <p><a href='signup.php'>
                  Registrese</a></p> O <p><a href='login.php'>
                  intente ingresar nuevamente  a su cuenta  </a></p> ");
            }
        }
        else {
            die( "aUsuario/password incorrect <p><a href='login.php'>
            intente nuevamente ingresar a su cuenta</a></p> O <p><a href='signup.php'>
            Registrese</a></p> ");
        }

        
    }
    else
    {
      echo <<<_END
      <h1>Ingrese</h1>
      <span> o    <a href="signup.php"> registrece para tener una cuenta </a></span>
      <form action="login.php" method="post"><pre>
         <input type="text" name="username" placeholder=nombre>
         <input type="password" name="password" placeholder= "contraseña">
         <input type="submit" value="INGRESAR" >
      </form>
      _END;
    }

    $conexion->close();

    function mysql_entities_fix_string($conexion, $string)
    {
        return htmlentities(mysql_fix_string($conexion, $string));
      }
    function mysql_fix_string($conexion, $string)
    {
        //if (get_magic_quotes_gpc()) $string = stripslashes($string);
        return $conexion->real_escape_string($string);
      }  
