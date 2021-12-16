<?php
session_start();  
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: text/html');
      
      session_destroy();//destruimos la sesion

      //para que no pueda regresar a una página
      echo "Cerrando sesión";
      echo '<script language=\"javascript\">if(history.foward()){
            location.replace(history.foward()) ;} </script>';
      

      echo '<script language=\"javascript\">
            window.location.href=\"../../index.php\";
            </script>';

?>

<!DOCTYPE html>
<html lang="es">
      <head>
            <meta charset="utf-8">
            <meta http-equiv='cache-control' content='no-cache'>
            <meta http-equiv='expires' content='0'> <!--para que tenga expiracions-->
            <meta http-equiv='pragma' content='no-cache'>
            <title>Cierre</title>    
            <link rel="stylesheet" type="text/css" href="./estilos/estilos_formularioslogin.css">     
            <?php                  
                  include("../../funcioneseverywhere/funcionesHTML.php"); //INCUIMOS NUESTRA LIBRERÍA PARA PODER USARLA
            ?>       
      </head>

  
      <body>
      <?php      
                  //para que no pueda regresar a una página
                  echo "Cerrando sesión";
                  echo '<script language=\"javascript\">if(history.foward()){
                        location.replace(history.foward()) ;} </script>';
                  

                  echo '<script language=\"javascript\">
                        window.location.href=\"../../index.php\";
                        </script>';

      ?>
    
      </body>
</html>
