<?php
    require_once 'database.php';

    session_start();


    if ($conexion->connect_error) die ("Fatal error");
    
        $a=$_SESSION['ide'] ;

        $query = "SELECT * FROM tarea WHERE fechaalterna < NOW()";
        $result = $conexion->query($query);
        $filas = $result->num_rows;
        
        echo"Tienes $filas notas esctritas<br/>";
        echo"<br/>";
        ?>
        <form action="eliminar_modificar.php" method="post">
        <table border width='100%' cellpadding=5 CELLSPACING = 0> 
                    <tr>
                        <th>Titulo</th>
                        <th>Texto</th>
                        <th width='200px'>Fecha</th>
                        <th width='150px'>Eventos</th>
                    </tr>
                    
        <?php
        for ($j=0; $j<$filas;++$j)
        {
            $row = $result->fetch_array(MYSQLI_NUM);

            $r0 = htmlspecialchars($row[0]);
            $titulo = htmlspecialchars($row[1]);
            $fecha = htmlspecialchars($row[2]);
            $texto = htmlspecialchars($row[4]);
            ?>
                    <tr>
                        <td><?= $titulo ?></td>
                        <td><?= $texto ?></td>
                        <td><?= $fecha?></td>
                        <?php 
                        echo <<<_END
                        <input type='hidden' name='delete' value='yes'>
                        <input type="hidden" name="titulo" value="$titulo">  
                        <input type="hidden" name="texto" value="$texto"> 
                        <input type="hidden" name="fecha" value="$fecha">
                        _END;
                        ?>
                        <td><input type="submit" name="eliminar" value="eliminar"><input type="submit" name="modificar" value="modificar"></td>
                    </tr>
                    <?php
        }
        ?>
            </table>
        <?php
         
        ?>
        </form>
        <?php

        $result->close();
        $conexion->close();
        
?>
