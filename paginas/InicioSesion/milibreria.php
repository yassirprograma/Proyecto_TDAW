<?php
      function conecta_a_base($servidor, $usuario, $contra, $base){
            /* La siguiente función es la que que la página de php recomienda usar para php5, php7 y php8 : */
            $conexion = mysqli_connect($servidor, $usuario, $contra, $base) or die ("Error al conectar a mysql"); 

            if($conexion){
                  echo "<h2>Conexión a base de datos realizada correctamente </h2>";
            }
            return $conexion;
      }


      function elim_espacio_ini_fin($cadena){ 
      //a todo lo que entre del formulario debemos quitarle espacios del inicio y del final
      //esta función se debe aplicar a las variables de cada campo de texto
            return trim($cadena); 
      }

      function convierte_a_mayus($cadena){
            //para covertir a mayúsculas los campos de nombre y de los apellidos
                  return  strtoupper($cadena);
      }

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

      function selectAutomaticoSimple($nombreArchivo,$separador, $nombreSelect, $elemdefault){
            echo "<select name='". $nombreSelect."'". "id='".$nombreSelect."'>" ;
      
                  $archivo=fopen($nombreArchivo, "r") or die("Archivo no encontrado"); //probamos abrir el archivo en modo lectura
                  $linea=fgets($archivo); //devuelve una cadena de la primer línea del archivo
                  $elementos=explode($separador,$linea); /*devuelve un arreglo donde cada posición son  los 
                  tokens que están separados por el delimitador "," dentro de la cadena $linea*/
                  for($i=0;$i<sizeof($elementos);$i++){
                        echo "<option value='";
                        echo $elementos[$i];   
                        echo "' ";                                
      
                        if($elementos[$i]==$elemdefault){ //si coincide con el que queremos por default, entonces le ponemos selected
                              echo"selected";
                        }
                        echo">";
                        echo $elementos[$i];
                        
                        echo "</option>";   
                  }
            echo"</select>";
      }

      function selectAutomaticoCompleto($nombreArchivo,$separador1, $separador2, $nombreSelect, $elemdefault){
      
            echo "<select name='". $nombreSelect."'". "id='".$nombreSelect."'>" ;
                  $archivo=fopen($nombreArchivo, "r") or die("Archivo no encontrado"); //probamos abrir el archivo en modo lectura
                  $linea=fgets($archivo); //devuelve una cadena de la primer línea del archivo
                  $pares=explode($separador1,$linea); /*devuelve un arreglo donde cada posición son  los 
                  tokens que están separados por el delimitador1 dentro de la cadena $linea*/
                  //el separador 1 separa los tokens de cada opcion (cada token tiene dos elementos)
      
                  for($i=0;$i<sizeof($pares);$i++){
                        $elems=explode($separador2,$pares[$i]); //separamos los dos elementos de acuerdo al segundo separador
                        $value=$elems[0]; //el valor que va a ir al post
                        $texto=$elems[1]; //el texto que se muestra de una opción
                        //echo $value. "->".$texto. "<br>";
                        echo "<option value='";
                        echo $value;   
                        echo "' ";                                
                        if($value==$elemdefault){ //si coincide con el que queremos por default, entonces le ponemos selected
                              echo"selected";
                        }
                        echo">";
                        echo $texto;
                        
                        echo "</option>";   
                  }
      
            echo"</select>";
      }

      function checkboxAutomaticoCompleto($nombreArchivo,$separador1, $separador2, $nombreCheckbox){
            //genera un checkbox de la información de un archivo
      
            $archivo=fopen($nombreArchivo, "r") or die("Archivo no encontrado"); //probamos abrir el archivo en modo lectura
            $linea=fgets($archivo); //devuelve una cadena de la primer línea del archivo
            $pares=explode($separador1,$linea); /*devuelve un arreglo donde cada posición son  los 
            tokens que están separados por el delimitador1 dentro de la cadena $linea*/
            //el separador 1 separa los tokens de cada opcion (cada token tiene dos elementos)
      
            for($i=0;$i<sizeof($pares);$i++){
                  $elems=explode($separador2,$pares[$i]); //separamos los dos elementos de acuerdo al segundo separador
                  $id=$elems[0]; //el valor que va a ir al post
                  $value=$elems[1]; //el texto que se muestra de una opción
                  //echo $value. "->".$texto. "<br>";
                        echo "<label for='";
                        echo $id;
                        echo "'>";
                        echo $value;
                        echo "</label>";
                        echo "<input type='checkbox' value='";
                        echo $value;
                        echo "'";
                        echo " id='";
                        echo $id;
                        echo "'";
                        echo" name='".$nombreCheckbox."[]'".">";
                        echo "<br><br>";
                  
            }      
      }
      




      



?>


