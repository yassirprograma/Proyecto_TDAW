<?php
       session_start();  //siempre que se quiera usar una sesión en una página debe colocarse esto    
       echo "Cerrando sesión";
       session_destroy();//destruimos la sesion
       header("Cache-Control: private, must-revalidate, max-age=0"); //para perder la caché de las páginas anteriores
       header("Pragma: no-cache"); 
       header('Location: ../../index.php'); //si ya tiene una sesión, lo regresamos al index       
?>