<?php
    session_start();
    if(isset($_SESSION['nombre'])){
        unset($_SESSION['nombre']);
        header("Location: index.php");
    }else
        echo "No has iniciado sesion";
?>