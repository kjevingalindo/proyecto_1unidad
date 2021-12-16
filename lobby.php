<?php 
          if(!empty($_COOKIE['nombre'])){
          $r=$_COOKIE['nombre'];}
      ?>
<h1>Bienvenido al sistema <?php error_reporting(0); echo $r; ?></h1>

    <div class="contenedor">
      <div id="header">
        <ul class="nav">
          <li ><a href="#">Lista de Tareas</a>
            <ul>
              <li><a href="pendientes.php" target="myFrame">Pendientes</a></li>
              <li><a href="vencidas.php" target="myFrame">Vencidas</a></li>
              <li><a href="todas.php" target="myFrame">Todas</a></li>
              
            </ul>         
          </li>
          <li><a href="nueva_nota.php" target="myFrame">Agregar tarea</a></li>
        </ul>
        <a class="cerrar" href="logout.php">CERRAR SESION</a>
      </div>
      <div>

      <iframe src="todas.php" frameborder="0" name="myFrame">

        </iframe>
        
    </div>
</div>