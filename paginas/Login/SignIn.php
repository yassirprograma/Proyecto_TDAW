<!DOCTYPE html>
<html lang="es">
      <head>
            <meta charset="utf-8">
            <title>Registro de usuario</title>
            <?php                  
                  include("funcionesHTML.php"); //INCUIMOS NUESTRA LIBRERÍA PARA PODER USARLA
            ?>
            <link rel="stylesheet" type="text/css" href="./estilos/estilos_formularioslogin.css">
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
                                          <span >REGÍSTRESE</span>                                   
                                    </div>                                   
                        </div>
                        
                              <div id="resultadoformulario">
                                    <?php 
                                          include_once("respuestaSignIn.php"); //INCUIMOS TODO EL CÓDIGO DE RESPUESTA PARA QUE ESTA MISMA PÁGINA DE SIGN IN SEA LA QUE PROCESE EL FORMULARIO Y MUESTRE ERRORES
                                    ?>
                              </div>
                        
                        <br>
                        <br>
                        <br>

                        <form id="formulario" name="registrodeusuario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                                                  <!--ESTE action permite que este mismo archivo sea el que reciba el POST-->
                                    
                              <div class="campotext">
                                    <label for="correo">Correo electrónico*</label>   
                                    <br>
                                    <input type="text" id="correo" name="correo"   placeholder="Correo electrónico"   maxlength="100"  size="30"  required>
                                    <!--required es para que sea obligatorio-->
                              </div>
                              <br>
                              
                              <div class="campotext">
                                    <label for="username">Username*</label>                                                               
                                    <br>
                                    <span class="indicaciones">
                                          (Solo letras sin acentos, números o "_", sin espacios; Longitud: 3-15 caracteres)
                                          
                                    </span>   
                                    
                                    <br>
                                    <input type="text" id="username" name="username"  placeholder="Usuario" minlength="3" maxlength="15"  size="30" required>
                              </div>
                        
                              <br>
                              
                              <div class="campotext">
                                    <label for="contra">Elija una contraseña *</label>      
                                    <br>
                                    <span class="indicaciones">
                                          (Mínimo 8 caracteres, se recomienda utilizar números, mayúsculas y signos)
                                          
                                    </span>                                 
                                    <br>
                                    <input type="password" id="contra" name="contra" placeholder=" "   maxlength="50" minlength="8" size="30" required>
                              </div>                                    
                              <br>
                              
                              <div class="campotext">
                                    <label for="comprobacion">Repita su contraseña*</label>
                                    <br>                                    
                                    <input type="password" id="comprobacion" name="comprobacion"  placeholder=" " minlength="8"  maxlength="50"  size="30" required>
                              </div>                                    
                          

                              <br>
                              <br>

                              
                          

                              <div class="campotext">
                                    <label for="nombre">Ingrese su nombre *</label>                                    
                                    <br>
                                    <input type="text" id="nombre"  name="nombre"  placeholder="Nombre(s)"  maxlength="50"  size="30" required>                              
                              </div>                                       
                              <br>

                              <div class="campotext">
                                    <label for="apellidopaterno">Ingrese su primer apellido*</label>
                                    <br>
                                    <input type="text" id="apellidopaterno" name="apellidopaterno"   placeholder="Primer apellido"  maxlength="50"  size="30" required>                              
                              </div>

                              <div class="campotext">
                                    <label for="apellidomaterno">Ingrese su segundo apellido</label>                  
                                    <br>
                                    <input type="text" id="apellidomaterno" name="apellidomaterno" placeholder="Segundo apellido"  maxlength="50"  size="30" >                        
                              </div>                                    
                              <br>

                              <div class="camposelect">
                                    <label for="sexo">Sexo*</label>                                    
                                    <select name="sexo" id="sexo" >
                                          <option value="Masculino">Masculino</option>
                                          <option value="Femenino">Femenino</option>
                                          <option value="Otro">Otro</option>
                                    </select>                              
                              </div> 
                              <br>


                              <div class="campofecha">
                                    <label for="fechanac">Fecha de nacimiento*</label>                              
                                    <input type="date" id="fechanac" name="fechanac" value="2001-06-14" min="1900-01-01" max="2018-01-01" required>                              
                              </div>                                     
                              <br>


                              <div class="camposelect">
                                    <label for="pais">Pais de origen*</label>                                                      

                                          <?php //para generar automáticamente el formulario
                                                selectAutomaticoCompleto("./paises.txt",",",":", "pais", "MX");
                                          ?>  
                              </div>                                     
                              <br>
                              

                              <div class="camposelect">
                                    <label for="ocupacion">Ocupación</label>                                    
                                    <select name="ocupacion" id="ocupacion">
                                          <option value="Estudiante">Estudiante</option>
                                          <option value="Profesor">Docente</option>
                                          <option value="Empleado">Empleado</option>
                                          <option value="Ninguno">Ninguno</option>
                                    </select>
                              </div>                                     
                              <br>
                              
                              <div class="camposelect">
                                    <label for="comunidadescom">¿Eres parte de la ESCOMUNIDAD?*</label>                              
                                    <select name="escomunidad" id="escomunidad" required>
                                          <option value="TRUE" >Sí</option>
                                          <option value="FALSE">No</option>
                                    </select>
                              </div>                                     
                              
                        
                              <!--
                                    
                                    <fieldset> 
                                          <legend>Cursos de interés</legend>
                                          <legend>Elija uno o varios cursos de IBM que resulten de su interés:</legend>
                                          <br>

                                          <?php //para generar automáticamente los 
                                    //              checkboxAutomaticoCompleto("cursos.txt",",",":", "cursoselegidos");
                                          ?>
                                    
                                    </fieldset>

                                    <br>
                                    <br>
                                    <br>
                              -->
                              <br>
                              <br>
                              <br>
                              <input id="botonenviarform" type="submit" value="Crear cuenta" name="submit">                                                  
                        </form>

                        <div id="pieformulario">
                              <br>
                              <br>
                              <span>¿Ya tiene una cuenta? <a href="Login.php">Inicie sesión</a></span> 
                              
                              <br>
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
