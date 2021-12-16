<?php

function imprimeError($texto){ 
      echo "<div class='errores'>";  
                   echo "<h4 >".$texto."</h4>";                  
      echo "</div>";      
}

function imprimeAceptacion($texto){
      echo "<div class='aceptacion'>";  
                  echo "<h4 >".$texto."</h4>";                  
      echo "</div>";            
}

function imprimeWarning(){
      echo "<div class='warning'>";  
                  echo "<h4 >".$texto."</h4>";                  
      echo "</div>"; 
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