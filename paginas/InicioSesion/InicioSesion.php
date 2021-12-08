<!DOCTYPE html>
<html lang="es">
      <head>
            <meta charset="utf-8">
            <title>Prueba formularios</title>
            <link rel="stylesheet" type="text/css" href="./estilosindex/estilo_index.css">
            <?php
                  
                  include("milibreria.php"); //INCUIMOS NUESTRA LIBRERÍA PARA PODER USARLA
            ?>
           
      </head>

      <body>

            <div id="contenidoprincipal">
                  <form name="registrodeusuario" action="respuesta.php" method="POST" enctype="multipart/form-data">

                        <fieldset>
                              <legend>Datos de la cuenta</legend>
                              <br><br>
                              <label for="correo">Correo electrónico*</label>
                              <input type="text" id="correo" name="correo"   placeholder="Correo electrónico"   maxlength="50"  size="30"  required>
                              <!--required es para que sea obligatorio-->
                              <br>
                              <br>
                              <label for="username">Elija un nombre de usuario para su cuenta* (sin espacios, solo letras sin acentos, números o "_", mínimo 3 caracteres, máximo 15 caracteres)</label>
                              <br>
                              <br>
                              <input type="text" id="username" name="username"  placeholder="Usuario" minlength="3" maxlength="15"  size="30" required>
                              <br>
                              <br>
                              <label for="contra">Elija una contraseña de mínimo 8 caracteres*</label>
                              <input type="password" id="contra" name="contra" placeholder=" "   maxlength="50" minlength="8" size="30" required>
                              <br>
                              <br>
                              <label for="comprobacion">Elija una contraseña de mínimo 8 caracteres*</label>
                              <input type="password" id="comprobacion" name="comprobacion"  placeholder=" " minlength="8"  maxlength="50"  size="30" required>

                        </fieldset>

                        <br>
                        <br>

                        <fieldset>
                              <legend>Datos personales</legend>
                              <br><br>                              
                              <label for="nombre">Ingrese su nombre *</label>
                              <input type="text" id="nombre"  name="nombre"  placeholder="Nombre(s)"  maxlength="50"  size="30" required>
                              <br>
                              <br>
                              <label for="apellidopaterno">Ingrese su primer apellido*</label>
                              <input type="text" id="apellidopaterno" name="apellidopaterno"   placeholder="Primer apellido"  maxlength="50"  size="30" required>
                              <br>
                              <br>
                              <label for="apellidomaterno">Ingrese su segundo apellido</label>
                              <input type="text" id="apellidomaterno" name="apellidomaterno" placeholder="Segundo apellido"  maxlength="50"  size="30" >
                              <br>
                              <br>
                              <label for="sexo">Sexo*</label>
                              <select name="sexo" id="sexo" >
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                              </select>

                              <br>
                              <br>
                              <label for="fechanac">Fecha de nacimiento*</label>
                              <input type="date" id="fechanac" name="fechanac" value="2001-06-14" min="1900-01-01" max="2018-01-01" required>
                              <br>
                              <br>
                              <label for="pais">Pais de origen*</label>                        

                                    <?php //para generar automáticamente el formulario
                                          selectAutomaticoCompleto("./paises.txt",",",":", "pais", "MX");
                                    ?>  

                              <br>
                              <br>
                              <label for="ocupacion">Ocupación</label>
                              <select name="ocupacion" id="ocupacion">
                                    <option value="Estudiante">Estudiante</option>
                                    <option value="Profesor">Docente</option>
                                    <option value="Empleado">Empleado</option>
                                    <option value="Ninguno">Ninguno</option>
                              </select>
                        </fieldset>

                        <br>
                        <br>
                        <br>


                        <fieldset> <!-- PARA LOS CURSOS DE INTERÉS-->
                              <legend>Cursos de interés</legend>
                              <legend>Elija uno o varios cursos de IBM que resulten de su interés:</legend>
                              <br>

                              <?php //para generar automáticamente los 
                                          checkboxAutomaticoCompleto("cursos.txt",",",":", "cursoselegidos");
                              ?>
                        
                        </fieldset>

                        <br>
                        <br>
                        <br>

                        <input type="submit" value="Enviar datos" name="enviar">

                  </form>

                 
            </div>
      </body>
</html>
