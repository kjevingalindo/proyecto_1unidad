<?php
session_start();
require_once 'database.php';

    if($conexion->connect_error) die("Error fatal");
    
    if(!empty($_POST['cancelar'])){
        echo" USTED CANCELO LA OPERACION <a href='todas.php'> continuar</a>";
    }

//recibiendo array $_post de eliminar_modificar.php
if (!empty($_POST['modificar'])&&!empty($_POST['titulo']) &&!empty($_POST['texto']) )
    {
        $titulo = get_post($conexion,'titulo');
        //$texto=htmlentities( $_POST['texto']);
        $texto= get_post($conexion, 'texto');
        
        $ide= $_SESSION['ide'];
        $titulo1= $_SESSION['titulo'];
        $fecha1= $_SESSION['fecha'];
        $texto1= $_SESSION['texto'];

        $query ="UPDATE tarea SET titulo='$titulo', texto='$texto'
                WHERE titulo='$titulo1' AND texto= '$texto1' AND fecha='$fecha1'";;  
        
        $result = $conexion->query($query);
        
        if (!$result) echo " ! HUBO UNA FALLA EN LA MODIFICACION !<br><br>";
        else {
            die (" SE MODIFICO CORRECTAEMTE SU NOTA<a href='todas.php'> continuar </a> <br/> ");
        }
    }

elseif(empty($_POST['cancelar'])){ echo"NO A MODIFICADO NADA <a href='todas.php'> elija nuevamente una nota</a>";
}
    function get_post($con, $var)
    {
        return $con->real_escape_string($_POST[$var]);
    }
    
?>