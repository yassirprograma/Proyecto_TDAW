
<?php
function conecta(){
      $servidor="127.0.0.1:33065"; /*A este lugar me estoy conectando, yo coloco la dirección de mi host local*/
                                    /*Nota muy importante: como yo cambié al puerto 33065, debo especificarlo en la variable servidor,
                                      si no hago eso, marca error

                                    */

      $usuario="root"; /*Por defecto este es el usuario*/
      $contra="holapapu"; /*En esta variable escribimos la contraseña, esta contra yo se la puse en phpmyadmin */
      $base="pruebaformularios";   /*así le puse a mi base de datos*/

      
      /* La siguiente función es la que que la página de php recomienda usar para php5, php7 y php8 : */
      $conexion = mysqli_connect($servidor, $usuario, $contra, $base) or die ("Error al conectar a mysql"); 

      if($conexion){
            echo "<h2>Conexión a base de datos realizada correctamente </h2>";
      }
      return $conexion;
}

/* Nota muy importante, siempre que se 
deje de requerir la conexión a la base de datos 
hay que cerrarla con la siguiente función, pero esto
es hasta que la dejemos de usar en el archivo en que eso se requiera

mysqli_close($conexion)

*/

?>

