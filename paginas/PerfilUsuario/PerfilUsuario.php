<?php            
session_start(); 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: text/html');
?>

<!DOCTYPE html>
<html lang="es">
      <head>
            <meta charset="utf-8">
            <meta http-equiv='cache-control' content='no-cache'>
            <meta http-equiv='expires' content='0'> <!--para que tenga expiracions-->
            <meta http-equiv='pragma' content='no-cache'>  
            <title>Mi perfil</title>    
            <link rel="stylesheet" type="text/css" href="./estilos/estilos_formularioslogin.css">     
            <?php                  
                  include("../../funcioneseverywhere/funcionesHTML.php"); //INCUIMOS NUESTRA LIBRERÍA PARA PODER USARLA
                  include("../../funcioneseverywhere/milibreria.php");                 
                  include("FuncionesPerfil.php"); 
            ?>                
      </head>

  
      <?php    
      /* otra forma de redirigir, pero con javascript
            echo "<script language=\"javascript\">
            window.location.href=\"index.php\";
            </script>";
      */
            if(isset($_SESSION['username'])){ //para comprobar si ha iniciado sesión   
                  $username=$_SESSION['username'];                              
                 // header('Location: ../../index.php'); //si ya tiene una sesión, lo regresamos al index
            }else {                 
                  $username="";  //si no hubo usuario, dejamos vacío
            }                                                                                    
      ?>    

      <body>
            <div id="usuario">
                  <?php
                        echo "Hola ".$username;
                        $infouser=infousuario($username);
                        $cursosuser=cursosdelusuario($username);
                  ?>                        
            </div>
            
      </body>
</html>

