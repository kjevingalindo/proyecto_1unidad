<?php //logout.php
    session_start();

    if (isset($_SESSION['nombre']))
    {
        $nombre = $_SESSION['nombre'];
       

        destroy_session_and_data();

        echo "Sesión terminada <a href='login.php'>continuar</a>.<br>";
        
    }
    else echo "Por favor <a href='login.php'>Click aqui</a>
                para salir";

    function destroy_session_and_data()
    {
        //session_start();
        $_SESSION = array();
        setcookie(session_name(), '', time()-2592000, '/');
        session_destroy();
    }
?>