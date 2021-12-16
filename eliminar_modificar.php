<?php 
    session_start();
    require_once 'database.php';
    if($conexion->connect_error) die("Error fatal");
    if(!empty($_POST['cancelar'])){
        echo" USTED CANCELO LA OPERACION <a href='todas.php'> continuar</a>";
    }

 if(!empty($_POST['eliminar'])&& !empty($_POST['titulo'])&&!empty($_POST['texto'])&&!empty($_POST['fecha']))
 { 
   // $titulo11=$_POST['titulo'];
    //$texto11=$_POST['texto'];
    $fecha11=$_POST['fecha'];
    $titulo11=mysql_entities_fix_string($conexion, $_POST['titulo']);
    $texto11=mysql_entities_fix_string($conexion, $_POST['texto']);
    echo"¿esta seguro que desea eliminar?</br>";
    echo"</br>";
        echo <<<_END
        <form action="eliminar.php" method="post">
        <input type="hidden" name="titulo" value="$titulo11">  
        <input type="hidden" name="texto" value="$texto11"> 
        <input type="hidden" name="fecha" value="$fecha11">
        <input type="submit" name="continuar" value="continuar">
        <input type="submit" name="cancelar" value="cancelar">
        </form>
        _END;
    
}
    elseif(isset($_POST['modificar'])&& isset($_POST['titulo'])&&isset($_POST['texto'])&&isset($_POST['fecha'])){
        $titulo12=get_post($conexion, 'titulo');
        $texto12=get_post($conexion, 'texto');
        //$texto12=htmlentities( $_POST['texto']);
        $fecha12=get_post($conexion, 'fecha');
        $_SESSION['titulo']=$titulo12;
        $_SESSION['texto']=$texto12;
        $_SESSION['fecha']=$fecha12;;
        echo "Titulo: $titulo12</br>" ;
        echo "Fecha : $fecha12</br>" ;
        echo"</br>";
        $texto12=$_POST['texto'];
        echo <<<_END
        <form action="modificar.php" method="post">
        <input type="search" name="titulo"  placeholder="Titulo" value='$titulo12'>
        <br><textarea name="texto"  cols="100" rows="10" wrap="hard"  placeholder="¿Que paso hoy?">$texto12</textarea></br>
        <input type="submit" name="modificar" value="modificar">
        <input type="submit" name="cancelar" value="cancelar">
        </form>
        _END;   
        
        
    }
    
    function get_post($con, $var)
    {
        return $con->real_escape_string($_POST[$var]);
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