<!DOCTYPE html>
<html lang="es">
      <head>
            <meta charset="utf-8">
            <title>PHP</title>
            <link rel="stylesheet" type="text/css" href="../estilos/estilostablas.css">
      </head>

      <body>
            <?php 
                  include("conectabd.php"); /*Esta función permite incluir código desde otro archivo */
                  include("milibreria.php"); //INCLUIMOS MI LIBRERIA DE FUNCIONES
                  

           //GUARDAMOS EN VARIABLES
                  $correo = $_POST['correo']; //campo requerido
                  $username = $_POST['username']; //campo requerido
                  $contra= $_POST['contra']; //campo requerido
                  $comprobacion = $_POST['comprobacion']; //campo requerido
                  $nombre = $_POST['nombre']; //campo requerido
                  $apellidopaterno = $_POST['apellidopaterno']; //campo requerido
                  $apellidomaterno = $_POST['apellidomaterno']; //campo no requerido
                  $sexo = $_POST['sexo']; //campo requerido
                  $fechanac = $_POST['fechanac']; //campo requerido
                  $pais = $_POST['pais']; //campo requerido
                  $ocupacion = $_POST['ocupacion']; //campo no requerido

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
            $nombre=elimina_acentos($nombre);  //quitamos cualquier tipo de acentos
            $apellidopaterno=elimina_acentos($apellidopaterno); //quitamos cualquier tipo de acentos
            $apellidomaterno=elimina_acentos($apellidomaterno); //quitamos cualquier tipo de acentos
            $nombre=convierte_a_mayus($nombre);
            $apellidopaterno=convierte_a_mayus($apellidopaterno); 
            $apellidomaterno=convierte_a_mayus($apellidomaterno);


            //LUEGO IMPRIMIMOS LO CAPTURADO:
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
                  echo $ocupacion," ( tipo: ", gettype($comprobacion), ") ";;


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


                  //luego validamos
                  $errores=0; //una variable contadora de errores
                  

                  //detectamos errores
                  if(!es_correo_valido($correo)){
                        $errores=$errores+1;
                        if($errores==1)
                              echo "Se han encontrado errores en el formulario:";
                        echo "<h6>Correo inválido</h6>";
                        
                  }

                  if(!username_valido($username)){
                  
                        $errores=$errores+1;
                        if($errores==1)
                              echo "<h3>Se han encontrado los siguientes errores en el formulario:</h3>";
                        echo "<h6>Username inválido</h6>";
                        
                  }

                  if(!es_password_segura($contra)){
                        
                        $errores=$errores+1;
                        if($errores==1)
                              echo "<h3>Se han encontrado los siguientes errores en el formulario:</h3>";
                        echo "<h6>Contraseña insegura</h6>";
                        
                  }

                  if(!passwords_iguales($contra, $comprobacion)){
                        
                        $errores=$errores+1;
                        if($errores==1)
                              echo "<h3>Se han encontrado los siguientes errores en el formulario:</h3>";

                        echo "<h6>Las contraseñas no coinciden</h6>";
                        
                  }

                  

                  if(!es_alfabetica($nombre)){
                        
                        $errores=$errores+1;
                        if($errores==1)
                              echo "<h3>Se han encontrado los siguientes errores en el formulario:</h3>";

                        echo "<h6>El nombre contiene caracteres inválidos</h6>";
                        
                  }

                  if(!es_alfabetica($apellidopaterno)){
                        
                        $errores=$errores+1;
                        if($errores==1)
                              echo "<h3>Se han encontrado los siguientes errores en el formulario:</h3>";

                        echo "<h6>El primer apellido contiene caracteres inválidos</h6>";
                  }
                  
                  if(!es_alfabetica($apellidomaterno) && !es_cadena_vacia($apellidomaterno)){
                        
                        $errores=$errores+1;
                        if($errores==1)
                              echo "<h3>Se han encontrado los siguientes errores en el formulario:</h3>";

                        echo "<h6>El segundo apellido contiene caracteres inválidos</h6>";
                        
                  }

                  
                  
                  if($errores==0){ //si no hubo errores, todo bien
                        echo "<h2>El formulario es válido</h2>";
                  }else {
                        echo "<h2>El formulario es inválido</h2>";
                  }

                  /*Comprobemos que nos podemos conectar a la base de datos:*/
                  /*Llamamos a la función de conexión de dicho archivo:*/
                 // $conexion=conecta();
                  //$conexion=conectaabase("127.0.0.1:33065", "root", "holapapu", "pruebaformularios");
                  

                  //mail("kevincraftzombie@gmail.com", "w", "mensaje", "ok");

            ?>            
                

      </body>
</html>