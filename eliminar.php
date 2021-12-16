<?php
session_start();
require_once 'database.php';

    if($conexion->connect_error) die("Error fatal");

    if(!empty($_POST['cancelar'])){
        echo" USTED CANCELO LA OPERACION <a href='todas.php'> continuar</a>";
    }
if(!empty($_POST['continuar'])&& !empty($_POST['titulo'])&&!empty($_POST['texto'])&&!empty($_POST['fecha'])){
    $ide=$_SESSION['ide'] ;
    $titulo=get_post($conexion, 'titulo');
    $texto=get_post($conexion, 'texto');
    $fecha=get_post($conexion, 'fecha');
    $query   = "DELETE FROM tarea WHERE id_usuario=$ide AND titulo='$titulo' AND fecha='$fecha'";
    $result  = $conexion->query($query);
    if (!$result) die ("no se a podido borrar");
    else echo "SE ELIMINO CORRECTAMENTE <a href='todas.php'> continuar</a> <br/>";
}

function get_post($con, $var)
    {
        return $con->real_escape_string($_POST[$var]);
    }
?>