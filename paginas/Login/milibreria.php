<?php

/*Funciones para mysql*/

      function sanitizeString($cadena){ //para evitar inyecciones a través del formulario
            
            $cadena=stripcslashes($cadena);                        
            $cadena=strip_tags($cadena);
            $cadena=htmlentities($cadena);
            return $cadena;
      }

      function sanitizeMySQL($conection, $var){ //sanitiza una cadena para prevenir que genere inyecciones SQL, pero se debe tener instanciado un objeto conexión
            $var=$conection->real_escape_string($var);
            $var=sanitizeString($var);
            return $var;
      }

      function conecta_a_base($servidor, $usuario, $contra, $base){

            /*la base de datos en uso se llama "sitiowebibm"*/
            /* La siguiente función es la que que la página de php recomienda usar para php5, php7 y php8 : */
            $conexion = mysqli_connect($servidor, $usuario, $contra, $base) or die ("ERROR DE CONEXIÓN CON LA BASE DE DATOS"); 

            if($conexion){
                 // echo "<h2>Conexión a base de datos realizada correctamente </h2>";
            }
            return $conexion;
      }


      function verificacorreoyusuariodisponibles($conexion, $correo, $username){ /*para verificar que el usuario que queremos insertar no */
            $queryuser="SELECT * FROM usuario WHERE username='$username'";
            $resultadouser=$conexion->query($queryuser) or die("Error con la base de datos");
          
            $querycorreo="SELECT * FROM usuario WHERE correo='$correo'";
            $resultadocorreo=$conexion->query($querycorreo) or die("Error con la base de datos");
            
         
            if($resultadocorreo && $resultadouser){
                  if($resultadouser->num_rows==0 && $resultadocorreo->num_rows==0){  //si no encontró ese correo y no encontró  ese usuario, quiere decir que ambos están disponibles
                        
                        return 1;
                  }else {
                        if($resultadouser->num_rows==1 && $resultadocorreo->num_rows==1){                                                
                              return -2; //ambos ya se han usado
                        }else {
                              if($resultadocorreo->num_rows==1){
                                    
                                    return -1; //el correo ya se ha usado
                              }   

                              if($resultadouser->num_rows==1){
                                    
                                    return 0; //el username ya se ha usado
                              }

                        }
                        
                  }
                
            }
            $resultadocorreo->close();
            $resultadouser->close(); //siempre hay que cerrar una consulta     
           
      }



      function agregausuario($conexion, $correo, $username, $password, $nombre, $appat, $apmat, $fechanac, $sexo ,$pais, $ocupacion, $escomunidad ){
            
            $hash=password_hash($password,PASSWORD_DEFAULT); //FORMA DE DAR SEGURIDAD MEDIANTE PROPIEDADES DE HASHING, EL ALGORITMO LOS ESCOGE POR DEFAULT PHP
                                                            //PARA REGRESAR A LA CONTRASEÑA SE APLICA password_verify()
            $stmt=$conexion->prepare('INSERT INTO usuario VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?)'); /*PREPARAMOS A LA CONEXIÓN PARA RECIBIR UNA CONSULTA */
            /*Los campos de la tabla "usuario"  creada son: (idusuario,correo,username,password, nombre, primerapellido, segundoapellido, fechanac, sexo, pais,ocupacion, escomunidad)*/
            $stmt->bind_param('ssssssssssi', $correo, $username, $hash, $nombre, $appat, $apmat, $fechanac, $sexo ,$pais, $ocupacion, $escomunidad); /*al principio se debe indicar el tipo de valores que  */            
            $stmt->execute();
            $stmt->close();
      }


/*Terminan las funciones de mysql */


/*Funciones para formulario*/

      function elim_espacio_ini_fin($cadena){ 
      //a todo lo que entre del formulario debemos quitarle espacios del inicio y del final
      //esta función se debe aplicar a las variables de cada campo de texto
            return trim($cadena); 
      }

 
/*      
      function elimina_acentos($cadena){	//para quitar todos los acentos
		//Reemplazamos la A y a
		$cadena = str_replace(
		array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'), array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
		$cadena
		);

		//Reemplazamos la E y e
		$cadena = str_replace(
		array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'), array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
		$cadena );
 
		//Reemplazamos la I y i
		$cadena = str_replace(
		array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'), array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
		$cadena );
 
		//Reemplazamos la O y o
		$cadena = str_replace(
		array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'), array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
		$cadena );
 
		//Reemplazamos la U y u
		$cadena = str_replace(
		array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'), array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
		$cadena );
 
		//Reemplazamos la N, n, C y c
		$cadena = str_replace(
		array('Ñ', 'ñ', 'Ç', 'ç'), array('N', 'n', 'C', 'c'),
		$cadena
		);
		
		return $cadena;
	}
*/
      function mayusconacento($cadena){	//para quitar todos los acentos
            //Reemplazamos la A y a
            $cadena = str_replace(
            array( 'á', 'à', 'ä', 'â'), array('Á', 'À','Ä', 'Â' ),
            $cadena
            );

            //Reemplazamos la E y e
            $cadena = str_replace(
            array( 'é', 'è', 'ë', 'ê'), array('É', 'È','Ë', 'Ê' ),
            $cadena );

            //Reemplazamos la I y i
            $cadena = str_replace(
            array( 'í', 'ì', 'ï', 'î'), array('Í', 'Ì', 'Ï', 'Î'),
            $cadena );

            //Reemplazamos la O y o
            $cadena = str_replace(
            array( 'ó', 'ò', 'ö', 'ô'), array('Ó', 'Ò', 'Ö', 'Ô'),
            $cadena );

            //Reemplazamos la U y u
            $cadena = str_replace(
            array( 'ú', 'ù', 'ü', 'û'), array('Ú', 'Ù', 'Ü', 'Û'),
            $cadena );

            //Reemplazamos la N, n, C y c
            $cadena = str_replace(
            array( 'ñ', 'ç'), array('Ñ','Ç'),
            $cadena
            );
            
            return $cadena;
      }


      function convierte_a_mayus($cadena){
            //para covertir a mayúsculas los campos de nombre y de los apellidos            
                  $cadena=strtoupper($cadena);
                  $cadena=mayusconacento($cadena);
                  return  $cadena;
      }


      function es_correo_valido($correo){
            if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
                  return 1;
            }else {
                  return 0;
            }
      }

      function  es_password_segura($password){
            /*valida si una contraaseña tiene largo mayor a 8 caracteres*/
            if(strlen($password)>=8)
                  return 1;
            else
                  return 0;
      }

      function passwords_iguales($password, $repeticion){
            if($password==$repeticion)
                  return 1;
            else
                  return 0;
      }

      function es_string($variable){
            if(gettype($variable)=="string")
                  return 1;
            else
                  return 0;
      }

      function es_entero($variable){
            if(gettype($variable)=="int")
                  return 1;
            else
                  return 0;
      }


      /*
      function es_alfanumerico($cadena){

      }
      */
  
      function es_alfabetica($cadena){ 
            //para validar aquellas cadenas que tienen solo caracteres alfabeticos y espacios
      
            $posfinal=strlen($cadena)-1;
            //pregmatch indica cuantas coincidencias de una expresión regular encuentra dentro de una cadena (debe coincidir la cadena completa, así como sus prefijos y sufijos)
            if(preg_match_all("/([A-Za-zÇ-Ñ]|[[:space:]])+/", $cadena)==1 && preg_match_all("/([A-Za-zÇ-Ñ])+/", $cadena[0])==1  &&   preg_match_all("/([A-Za-zÇ-Ñ])+/", $cadena[$posfinal])==1 ){
                  
                  return 1; 
      
            }else {
                  return 0; //si la cantidad de coincidencias es diferente de 1, entonces retorna 0
            }
      }
      
  
      function tiene_espacios($cadena){
            //muestra si una cadena tiene espacios
            for($i=0;$i<strlen($cadena);$i++)
            {
                  if($cadena[$i]==' '){
                        //echo "espaciossss";
                        return 1;
                  }else {
                       // echo $cadena[$i];
                  }        
                  
            }
            return 0;
      }

      function es_cadena_vacia($cadena){
            if($cadena=="")
                  return 1;
            else
                  return 0;
      }

      function username_valido($username){
            /*para validar que el usuario no tenga espacios, 
            y que solo tenga letras, números y guión bajo y solo puede tener de de 3 a 15 caracteres
            */                        
            if(strlen($username)>=3 && strlen($username)<=15){ //debe tener entre 3 y 15 caracteres
                  $posfinal=strlen($username)-1;
                  //pregmatch indica cuantas coincidencias de una expresión regular encuentra dentro de una cadena (debe coincidir la cadena completa, así como sus prefijos y sufijos)
                  if(preg_match_all("/([A-Za-z0-9_])+/", $username)==1 && preg_match_all("/([A-Za-z0-9_])+/", $username[0])==1  &&   preg_match_all("/([A-Za-z0-9_])+/", $username[$posfinal])==1 ){
                        
                        return 1; 
      
                  }else {
                        return 0; //si la cantidad de coincidencias es diferente de 1, entonces retorna 0
                  }
            }else {
                  return 0;
            }            
      }
      
?>


