<!DOCTYPE html>
<html lang="es">
      <head>
            <meta charset="utf-8">
            <title>Inicio de sesión</title>    
            <link rel="stylesheet" type="text/css" href="./estilos/estilos_formularioslogin.css">     
            <?php                  
                  include("funcionesHTML.php"); //INCUIMOS NUESTRA LIBRERÍA PARA PODER USARLA
            ?>       
      </head>

      <?php            
            session_start();  //siempre que se quiera usar una sesión en una página debe colocarse esto         
            if(isset($_SESSION['username'])){ //para comprobar si ha iniciado sesión   
                  $username=$_SESSION['username'];                              
                  header('Location: ../../index.php'); //si ya tiene una sesión, lo regresamos al index
            }else {                 
                  $username=0;  //si no hubo usuario, dejamos vacío
            }                        
      ?>

      <body>
      
      <div class="todo">
                  <div id="contenido">
                      
                        <div class="encabezadoformulario">                                                                                                                                                                                                                      
                                    <img src="../../imagenesindex/usericono.png" alt="Icono USER" id="usericono">
                                    <div class="titulo">
                                          <span >INICIO DE SESIÓN</span>                                   
                                    </div>                                   
                        </div>
                        
                              <div id="resultadoformulario">
                                    <?php 
                                          include_once("respuestaLogin.php"); //INCUIMOS TODO EL CÓDIGO DE RESPUESTA PARA QUE ESTA MISMA PÁGINA DE SIGN IN SEA LA QUE PROCESE EL FORMULARIO Y MUESTRE ERRORES
                                    ?>
                              </div>
                        
                        <br>
                        <br>
                        <br>

                        <form id="formulario" name="registrodeusuario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                                                  <!--ESTE action permite que este mismo archivo sea el que reciba el POST-->
                                                                                       
                              <div class="campotext">
                                    <label for="username">Username </label>   
                                    <br>                                                               
                                    <input type="text" id="username" name="username"  placeholder="Usuario" minlength="3" maxlength="15"  size="30" required>
                              </div>
                        
                              <br>
                              
                              <div class="campotext">
                                    <label for="contra">Contraseña</label>    
                                    <br>                                
                                    <input type="password" id="contra" name="contra" placeholder=" "   maxlength="50" minlength="1" size="30" required>
                              </div>           
                              
                              <br>
                              <br>                              
                              <input id="botonenviarform" type="submit" value="Iniciar sesión" name="submit">   
                        </form>

                        <div id="pieformulario">
                              <br>
                              <br>
                              <span>¿No tiene una cuenta? <a href="SignIn.php">Crear una cuenta</a></span> 
                              
                        
                              <br>
                              <br>
                              <br>
                              <div class="botonhome">                                                                    
                                    <a  href="../../index.php">  <img src="./imagenes/homeboton.png" alt="Home"><span>Volver a Home</span>  </a>
                              </div>
                        </div>

                  </div> 
            </div>    
      </body>
</html>
