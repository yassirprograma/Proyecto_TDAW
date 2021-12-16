<?php           
$sehaenviadoformulario=0;        
if(isset($_POST['submit'])){ //TODO LO SIGUIENTE  se ejecutará hasta que se de el botón de enviar
      $sehaenviadoformulario=1;        

            include("../../funcioneseverywhere/conectabd.php"); /*Esta función permite incluir código desde otro archivo */
            include("../../funcioneseverywhere/milibreria.php"); //INCLUIMOS MI LIBRERIA DE FUNCIONES                                                          
      //GUARDAMOS EN VARIABLES
            $correo = $_POST['correo']; //campo requerido
            $username = $_POST['username']; //campo requerido
            $contra= $_POST['contra']; //campo requerido
            $comprobacion = $_POST['comprobacion']; //campo requerido
            $nombre = $_POST['nombre']; //campo requerido
            $apellidopaterno = $_POST['apellidopaterno']; //campo requerido
            $apellidomaterno = $_POST['apellidomaterno']; //campo no requerido
            $fechanac = $_POST['fechanac']; //campo requerido
            $sexo = $_POST['sexo']; //campo requerido                  
            $pais = $_POST['pais']; //campo requerido
            $ocupacion = $_POST['ocupacion']; //campo no requerido
            $escomunidad=$_POST['escomunidad'];
            
            if(key_exists('cursoselegidos', $_POST )){ //verificamos si el usuario eligió al menos una casilla y se generó la llave en el arreglo _POST
                  $cursoselegidos=$_POST['cursoselegidos']; //campo no requerido, este $cursoselegidos es un arreglo  de lo que se elige en el checkbox
            }else {
                  $cursoselegidos=[]; //generamos un arreglo vacío en caso de que html no haya generado la  llave 'cursoselegidos' en el arreglo _POST
            }
            


      //LUEGO HAY QUE REALIZAR UNA TRANSFORMACIÓN A ALGUNAS VARIABLES

      $correo=elim_espacio_ini_fin($correo);
      $username=elim_espacio_ini_fin($username);
      $nombre=elim_espacio_ini_fin($nombre);
      $apellidopaterno=elim_espacio_ini_fin($apellidopaterno);
      $apellidomaterno=elim_espacio_ini_fin($apellidomaterno);
      /* $nombre=elimina_acentos($nombre); //los acentos los respetaremos  
      /*  $apellidopaterno=elimina_acentos($apellidopaterno); */ //los acentos los respetaremos
      /*  $apellidomaterno=elimina_acentos($apellidomaterno); */  //los acentos los respetaremos 
      $nombre=convierte_a_mayus($nombre);
      $apellidopaterno=convierte_a_mayus($apellidopaterno); 
      $apellidomaterno=convierte_a_mayus($apellidomaterno);

      if($escomunidad=="TRUE"){
            $escomunidad=TRUE;      //pasamos a formato booleano            
      }else{
            $escomunidad=FALSE;
      }





      //LUEGO IMPRIMIMOS LO CAPTURADO:
      /*
            echo "<h3>FORMULARIO RECIBIDO</h3>";
            echo "<h3>INFORMACIÓN CAPTURADA:</h3>";

            echo "<h3>Correo:</h3>";
                  //campo requerido
            echo $correo, " ( tipo: ", gettype($correo), ") ";

            
            echo "<h4>Nombre de usuario:</h4>";
            echo $username, " ( tipo: ", gettype($username), ") ";

            echo "<h4>Contraseña:</h4>";                  
            echo $contra," ( tipo: ", gettype($contra), ") ";

            echo "<h4>Repetición de contraseña:</h4>";
            echo $comprobacion," ( tipo: ", gettype($comprobacion), ") ";

            echo "<h4>Nombre:</h4>";
            echo $nombre," ( tipo: ", gettype($nombre), ") ";

            echo "<h4>Primer Apellido:</h4>";
            echo $apellidopaterno," ( tipo: ", gettype($apellidopaterno), ") ";

            echo "<h4>Segundo Apellido:</h4>";
            if($apellidomaterno!=""){
                  echo $apellidomaterno," ( tipo: ", gettype($apellidomaterno), ") ";
            }else{
                  echo "<h5>(El espacio no se ha llenado)</h5>";
            }

            echo "<h4>Sexo:</h4>";
            echo $sexo," ( tipo: ", gettype($sexo), ") ";

            echo "<h4>Fecha de nacimiento:</h4>";
            echo $fechanac," ( tipo: ", gettype($fechanac), ") ";

            echo "<h4>Pais de origen:</h4>";
            echo $pais," ( tipo: ", gettype($pais), ") ";

            echo "<h4>Ocupación:</h4>";
            echo $ocupacion," ( tipo: ", gettype($comprobacion), ") ";

            echo "<h4>¿Es de la ESCOM?</h4>";
            echo $escomunidad," ( tipo: ", gettype($escomunidad), ") ";
            

            echo "<h4>Cursos de interés:</h4>";
            if(sizeof($cursoselegidos)>=1){ //imprimimos los elegidos siempre y cuando el usuario haya elegido al menos 1
                  for($i=0;$i<sizeof($cursoselegidos);$i++){//recorremos todo lo que se llenó del checkbox 
                        echo $cursoselegidos[$i],"<br><br>";
                  } 
            }else {
                  echo "<h5>No se eligió ningun curso</h5>", "<br>";
                  $cursoselegidos=[]; //si no eligió nada, dejamos el arreglo vacío
            }
            
            
            echo"<br> <br><br> <br><br>";

      */    


            //luego validamos
            $errores=0; //una variable contadora de errores
            
            //lo siguiente sustituye a una sanitización de html (se habla en el Libro de Robin Nixon en la página 279)

            //detectamos errores
            if(!es_correo_valido($correo)){
                  $errores=$errores+1;
                  if($errores==1){
                        echo "<div class='errores'>";
                        echo "<h3>Se han encontrado los siguientes errores en el formulario:</h3>";                      
                  }
                        
                   echo "<h4 id='error'>Correo inválido</h4>";
                  
            }

            if(!username_valido($username)){
            
                  $errores=$errores+1;
                  if($errores==1){
                        echo "<div class='errores'>";
                        echo "<h3>Se han encontrado los siguientes errores en el formulario:</h3>";                      
                  }
                  echo "<h4 class='error'>El Username tiene caracteres inválidos</h4>";
                  
            }

            if(!es_password_segura($contra)){
                  
                  $errores=$errores+1;
                  if($errores==1){
                        echo "<div class='errores'>";
                        echo "<h3>Se han encontrado los siguientes errores en el formulario:</h3>";                      
                  }
                  echo "<h4>Contraseña insegura</h4>";
                  
            }

            if(!passwords_iguales($contra, $comprobacion)){
                  
                  $errores=$errores+1;
                  if($errores==1){
                        echo "<div class='errores'>";
                        echo "<h3>Se han encontrado los siguientes errores en el formulario:</h3>";                      
                  }

                  echo "<h4 >Las contraseñas no coinciden</h4>";
                  
            }

            

            if(!es_alfabetica($nombre)){
                  
                  $errores=$errores+1;
                  if($errores==1){
                        echo "<div class='errores'>";
                        echo "<h3>Se han encontrado los siguientes errores en el formulario:</h3>";                      
                  }

                  echo "<h4 >El nombre contiene caracteres inválidos</h4>";
                  
            }

            if(!es_alfabetica($apellidopaterno)){
                  echo$apellidopaterno."<br>";
                  $errores=$errores+1;
                  if($errores==1){
                        echo "<div class='errores'>";
                        echo "<h3>Se han encontrado los siguientes errores en el formulario:</h3>";                      
                  }
                  echo "<h4 >El primer apellido contiene caracteres inválidos</h4>";
            }
            
            if(!es_alfabetica($apellidomaterno) && !es_cadena_vacia($apellidomaterno)){
                  
                  $errores=$errores+1;
                  if($errores==1){
                        echo "<div class='errores'>";
                        echo "<h3>Se han encontrado los siguientes errores en el formulario:</h3>";                      
                  }

                  echo "<h4>El segundo apellido contiene caracteres inválidos</h4>";
                  
            }


            
            //ahora probamos con la info que hay en la base de datos:
                  /*Si es válido el formulario comprobamos que nos podemos conectar a la base de datos:*/
                  /*Llamamos a la función de conexión de dicho archivo:*/
                  // $conexion=conecta();
            $yaregistrado=0;                  
            $conexion=conecta_a_base("127.0.0.1:33065", "root", "holapapu", "sitiowebibm"); /*la base de datos en uso se llama "sitiowebibm"*/
                  if($conexion) {
                        $res=verificacorreoyusuariodisponibles($conexion, $correo, $username);
                        if($res==1 && $errores==0){ //si ya se verificó con base de datos y con todas las funciones para los campos y no hay errores , entonces registramos al usuario
                              agregausuario($conexion, $correo, $username, $contra, $nombre, $apellidopaterno, $apellidomaterno, $fechanac, $sexo ,$pais, $ocupacion, $escomunidad );                              
                              echo "<div class='aceptacion'>";
                              echo "<h2>¡Usuario registrado exitosamente!</h2>";                              
                              echo ("<br><br><a class='avanzaform' href='Login.php'>Click aquí para ir al Login e iniciar sesión</a>"); //para seguir con el registro
                        }else{
                              if($res==-2){
                                    $errores=$errores+1;
                                    
                                    echo "<div class='warning'>";                                                                                         
                                    $yaregistrado=1;
                                    echo "<h4>Este usuario y correo ya han sido registrados</h4>"; // si ya 
                                    echo ("<br><br><a class='avanzaform' href='Login.php'>Click aquí para iniciar sesión</a>");
                              }
                              if($res==-1){
                                    $errores=$errores+1;
                                    if($errores==1){
                                          echo "<div class='errores'>";
                                          echo "<h3>Se han encontrado los siguientes errores en el formulario:</h3>";                      
                                    }
                                    echo "<h4>EL CORREO ELECTRÓNICO YA ESTÁ SIENDO UTILIZADO POR OTRA CUENTA</h4>";
                                    
                              }
                              if($res==0){
                                    $errores=$errores+1;
                                    if($errores==1){
                                          echo "<div class='errores'>";
                                          echo "<h3>Se han encontrado los siguientes errores en el formulario:</h3>";                      
                                    }
                                    echo "<h4>EL NOMBRE DE USUARIO NO ESTÁ DISPONIBLE, YA ESTÁ SIENDO UTILIZADO POR OTRA CUENTA</h4>";
                                    
                              }                     
                              if(!$yaregistrado){                                                             
                                    echo ("<br><br><a class='regresoform' href='javascript:history.back(1)'>Regresar y corregir el formulario</a>");   //para regresar y no perder el formulario        
                              }
                              
                        }
                        
                  }else{
                        die ("ERROR DE CONEXIÓN CON LA BASE DE DATOS");
                  }

            
            $conexion->close(); //se cierra la conexión con la base de datos
            //mail("kevincraftzombie@gmail.com", "w", "mensaje", "ok");
      
      
            echo "</div>";
}                                        
?>                            