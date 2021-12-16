<?php // session_start();  //este no debe ir, pues esta página va a ser cargada en Login.php y esa página ya tiene session start en el header

$sehaenviadoformulario=0;        

if(isset($_POST['submit'])){ //TODO LO SIGUIENTE  se ejecutará hasta que se de el botón de enviar
      $sehaenviadoformulario=1;        

      include("conectabd.php"); /*Esta función permite incluir código desde otro archivo */
      include("../../funcioneseverywhere/milibreria.php"); //INCLUIMOS MI LIBRERIA DE FUNCIONES                                                          
      

      //estos usuarios los voy a crear para que puedan iniciar sesión los del equipo
      $u1="yassir";            
      $p1="tdaw1";

      $u2="erick";            
      $p2="tdaw2";

      $u3="angelo";            
      $p3="tdaw3";

      $u4="julio";            
      $p4="tdaw4";

      $u=$_POST['username'];
      $p=$_POST['contra'];
      

      if(($u1==$u && $p1==$p) ||($u2==$u && $p2==$p)||($u3==$u && $p3==$p) ||($u4==$u && $p4==$p)){ //si es alguno de los del equipo                                    
            $_SESSION['username']=$u; //GUARDAMOS EL USUARIO EN LA SESIÓN Y APARTIR DE AHÍ YA SABEMOS QUIÉN ES, SIMPLEMENTE VIENDO EL ARCHIVO SESSION                                                                                          
            $imprime="Bienvenido ".$_SESSION['username'].("<br><br><a class='vuelve' href='../../index.php'>Click aquí para ir a HOME</a>");                                                                                         
            imprimeAceptacion($imprime);   

      }else{                   
            $conexion=conecta_a_base("127.0.0.1:33065", "root", "holapapu", "sitiowebibm"); /*la base de datos en uso se llama "sitiowebibm"*/
                  
                  if($conexion) {                 //si se logró la conexión, procedemos 
                        $username = sanitizeMySQL($conexion, $_POST['username']);  //sanitizamos la entrada
                        $passwordcapturada= sanitizeMySQL($conexion,$_POST['contra']);      //sanitizamos la entrada

                        
                        $query="SELECT username, password FROM usuario WHERE username='$username'"; //cadena de nuestra consulta
                        $result=$conexion->query($query); //hacemos la consulta y la asignamos a $result                  
                        
                        if(!$result->num_rows){ //si el resultado es vacío, quiere decir que el usuario no existe                       
                        imprimeError("El usuario ingresado no existe");                       
                        $result->close(); //cerramos la consulta
                        }elseif($result->num_rows){ //pero si obtuvo algo, entonces procedemos a verificar la contraseña
                              
                              $fila=$result->fetch_array(MYSQLI_NUM); //la posición 0 tiene el username y la 1 la contraseña
                              $result->close(); //cerramos la consulta
                              
                              $username=$fila[0];
                              $passwordenbase=$fila[1]; //guardamos la que viene de la base de datos

                              if(password_verify($passwordcapturada, $passwordenbase)){ //pero como le habíamos hecho algoritmo de hashing, debemos compararla con password_verify (función nativade php)                                                            
                              // ini_set('sesion.gc_maxlifetime', 60*60*24); //establecemos el tiempo que queremos que dure una sesión, esto siempre va antes de generarla                                                                                                                       
                                    $_SESSION['username']=$username; //GUARDAMOS EL USUARIO EN LA SESIÓN Y APARTIR DE AHÍ YA SABEMOS QUIÉN ES, SIMPLEMENTE VIENDO EL ARCHIVO SESSION                                                                                          
                                    $imprime="Bievenido ".$_SESSION['username'].("<br><br><a class='vuelve' href='../../index.php'>Click aquí para ir a HOME</a>");                                                                                         
                                    imprimeAceptacion($imprime);                                                 
                                    
                              }else{
                                    imprimeError("La contraseña o el usuario no coinciden");
                              }

                        }
                        

                  }else{
                        //si no se pudo conectar con la base, marcamos error
                        echo "<div class='errores'>";  
                              die ("ERROR DE CONEXIÓN CON LA BASE DE DATOS");
                        echo "</div>";     
                  }

            $conexion->close(); //se cierra la conexión con la base de datos
            //mail("kevincraftzombie@gmail.com", "w", "mensaje", "ok");                              
            /*
                  echo "<div class=''>";  
                        echo "<h4 >Este nombre de usuario no existe</h4>";                  
                  echo "</div>";
            */
      }
}                                        
?>                            