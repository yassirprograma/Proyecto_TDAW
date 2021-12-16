<?php          
            function infousuario($username){ //debe recibir
                  $conexion=conecta_a_base("127.0.0.1:33065", "root", "holapapu", "sitiowebibm"); /*la base de datos en uso se llama "sitiowebibm"*/           
                  if($conexion) {                 //si se logró la conexión, procedemos                                                       
                                    $query="SELECT * FROM usuario WHERE username='$username'"; //cadena de nuestra consulta
                                    $result=$conexion->query($query); //hacemos la consulta y la asignamos a $result                
                                    
                                    $fila=NULL;
                                    
                                    if(!$result->num_rows){ //si el resultado es vacío, quiere decir que el usuario no existe                       
                                          //imprimeError("El usuario ingresado no existe");                       
                                          $result->close(); //cerramos la consulta
                                    }elseif($result->num_rows){ //pero si obtuvo algo, entonces procedemos a verificar la contraseña
                                          $fila=$result->fetch_array(MYSQLI_NUM); //la posición 0 tiene el username y la 1 la contraseña
                                          $result->close(); //cerramos la consulta
                                          /*
                                                [0] => idusuario
                                                [1] => correo
                                                [2] => username
                                                [3] => password
                                                [4] => nombre
                                                [5] => primerapellido
                                                [6] => segundoapellido
                                                [7] => fechanac
                                                [8] => Masculino
                                                [9] => MX
                                                [10] => Estudiante
                                                [11] => 1
                                          */
                                       //echo "<pre>";
                                         // print_r($fila);
                                       //echo "</pre>";
                                    }                              
       
                        }else{
                              //si no se pudo conectar con la base, marcamos error
                              echo "<div class='errores'>";  
                                    die ("ERROR DE CONEXIÓN CON LA BASE DE DATOS");
                              echo "</div>";     
                        }
       
                  $conexion->close(); //se cierra la conexión con la base de datos

                  return $fila; //devolvemos el arreglo con la información
           }

           function cursosdelusuario($username){
                $infouser=infousuario($username);                 
                $idusuario=$infouser[0];
                $conexion=conecta_a_base("127.0.0.1:33065", "root", "holapapu", "sitiowebibm"); /*la base de datos en uso se llama "sitiowebibm"*/           

                if($conexion) {                 //si se logró la conexión, procedemos                                                       

                        $query=("SELECT idevento, nombreevento, codigoseguimiento, fecha, lugar, enlaceinfo FROM inscripcion INNER JOIN evento where usuario_idusuario=$idusuario and evento_idevento=idevento") ; //cadena de nuestra consulta ESTO NO FUNCIONA                        
                        //MUCHO OJO PORQUE al hacer el fetch array solo guarda una fila XD, VA A TENER QUE SER OTRA FORMA DE PASAR EL RESULTADO A UNA VARIABLE

                        $result=$conexion->query($query); //hacemos la consulta y la asignamos a $result                


                        
                        $filacursos=NULL;
                        
                        if(!$result->num_rows){ //si el resultado es vacío, quiere decir que el usuario no ha registrado ningún curso                                                     
                              $result->close(); //cerramos la consulta
                        }elseif($result->num_rows){ //pero si obtuvo algo, entonces procedemos a verificar la contraseña
                              $filacursos=$result->fetch_array(MYSQLI_NUM); //la posición 0 tiene el username y la 1 la contraseña
                              $result->close(); //cerramos la consulta    

                              echo "<pre>";
                              print_r($filacursos);
                              echo "</pre>";              
                        }                              

                  }else{
                            //si no se pudo conectar con la base, marcamos error
                            echo "<div class='errores'>";  
                                  die ("ERROR DE CONEXIÓN CON LA BASE DE DATOS");
                            echo "</div>";     
                  }
     
                $conexion->close(); //se cierra la conexión con la base de datos

             
                return $filacursos;
           }
           
           
            
      ?>  