<!DOCTYPE html>
<html lang="es">
      <head>
            <meta charset="utf-8">
            <title>IBM</title>
            <link rel="stylesheet" type="text/css" href="./estilosindex/estilo_index.css">
            <?php                  
                  include("./funcioneseverywhere/funcionesHTML.php"); //INCUIMOS NUESTRA LIBRERÍA PARA PODER USARLA
                  include("./funcioneseverywhere/milibreria.php"); //INCUIMOS NUESTRA LIBRERÍA PARA PODER USARLA
            ?> 
      </head>

      <?php            
            session_start();  //siempre que se quiera hacer uso de la sesión se debe colocar este trozo
            if(isset($_SESSION['username'])){ //para comprobar si ha iniciado sesión   
                  $username=$_SESSION['username'];                              
            }else {                 
                  $username=0;  //si no hubo usuario, dejamos vacío
            }
            
      ?>

      <body>
      
            <div id="cabecera" >
                  <div id="logoibm">                        
                        <a href="./"><img src="./imagenesindex/IBMLOGO.png" alt="LOGO DE LA PÁGINA"></a>                        
                  </div>

                  <nav id="menu">
                        <ul id="elementosmenu">                         
                              <li class="desplegable"> 
                                    <div>Sobre IBM</div>
                                    
                                    <ul>
                                          <li>
                                                <a href="./paginas/QueEsIBM/QueEsIBM.html" target="iframecontenido" > <div>¿Qué es IBM?</div> </a>
                                          </li>
                                          <li>
                                                <a href="./paginas/HistoriaIBM/HistoriaIBM.html" target="iframecontenido"> <div>Historia de IBM</div> </a>
                                          </li>
                                    </ul>
                              </li>

                              <li>
                                    <a href="./paginas/FAQ/FAQ.php" target="iframecontenido"><div>FAQ</div></a>
                              </li>

                              <li>
                                    <a href="./paginas/ProductosServicios/ProductosServicios.html" target="iframecontenido"><div>Productos y servicios</div></a>
                              </li>

                              <li class="desplegable">
                                    <div>IBM para estudiantes</div>
                                    
                                    <ul>                                    
                                          <li><a href="./paginas/OportunidadesEstudiantes/OportunidadesEstudiantes.html" target="iframecontenido"><div>Oportunidades para estudiantes</div></a></li>
                                          <li><a href="./paginas/Herramientas/Herramientas.html" target="iframecontenido"><div>Herramientas</div></a></li> 
                                          <li><a href="./paginas/CapacitacionEducativo/CapacitacionEducativo.html" target="iframecontenido"><div>Capacitación y contenido educativo</div></a></li>
                                          <li><a href="./paginas/EscomIBM/EscomIBM.html" target="iframecontenido"><div>ESCOM e IBM</div></a></li>
                                    </ul>
                              </li>

                              <li>
                                    
                                    <a href="./paginas/EmpleoIBM/EmpleoIBM.html" target="iframecontenido"><div>Empleo en IBM</div></a>
                              </li>

                              <li>
                                    <a href="./paginas/ComunidadIBM/ComunidadIBM.php" target="iframecontenido"><div>Comunidad IBM</div></a>
                              </li>

                              <li>
                                    <a href="./paginas/EventosIBM/EventosIBM.html" target="iframecontenido"><div>Eventos IBM</div></a>
                              </li>
                                                                                          
                        </ul>                  
                  </nav>

                  <div id="login">
                        
                              <?php
                                    if($username!=0){                                          
                                          echo'<a id="botonlogin" href="./"><img src="./imagenesindex/usericono.png" alt="icono de inicio de sesión">';                                          
                                          echo "<br>";
                                          echo $username;
                                          echo "</a>";
                                          echo "<br>";
                                                                                    
                                          echo'<a id="botonlogin" href="./paginas/Login/Logout.php"> Cerrar sesión </a>';                                          
                                          
                                    }else{            
                                          
                                          echo'<a id="botonlogin" href="./paginas/Login/Login.php">';                                                
                                                echo '<img src="./imagenesindex/usericono.png" alt="icono de inicio de sesión">';                                          
                                                echo"<br>Inicio de sesión";                                                                                    
                                          echo "</a>";
                                    }
                              ?>
                              
                        
                  </div>
                  
                  
            </div>






            <!--Aquí se manda el contenido principal-->
            <div id="contenidoprincipal">
               
                  <iframe id="iframecontenido" name="iframecontenido" src="./paginas/IBMHome/IBMHome.html" >

                  </iframe>
            </div>

            



            <div id="piedepagina">      
                  <div id="datoscontacto">
                        
                        <h3>Equipo 1 de desarrollo</h3>                        
                        <h3>Datos de contacto</h4>     
                        <br>                                     
                        <h4>Correo de contacto del equipo:</h4>
                        <p>equipo1tdaw@gmail.com</p>
                        
                        <h4>Dirección</h4>      
                        <p>ESCOM IPN, Unidad Profesional Adolfo López Mateos, 07320 Ciudad de México, CDMX</p>
                        
                        <h4>Teléfono de contacto</h4>
                        
                        <p>+52 55 3933 70 30</p>
                        
                        
                  </div>


                  <div id="logos">
                        <img src="./imagenesindex/logo-ipn.png" alt="Logo del IPN">
                        <img src="./imagenesindex/escudoESCOM.png" alt="Escudo de la ESCOM">                                                      
                        <img src="./imagenesindex/logohtml.png" alt="Logo html">
                        <img src="./imagenesindex/logocss.png" alt="Logo css">
                        <img src="./imagenesindex/phplogo.png" alt="Logo html">                  
                  </div>


                  <div id="enlaces">  
                        <h3>Visita nuestras redes sociales</h3> 
                        <br>

                        <div id="redessociales">
                              <a href="https://www.facebook.com/escomipnmx/" target="_blank">
                                    <img src="./imagenesindex/facelogo.svg" class="logoredsocial" alt="Logo facebook">
                                    <p>Facebook</p>
                              </a>                        
                              <a href="https://www.linkedin.com/" target="_blank">
                                    <img src="./imagenesindex/linkedinlogo.png" class="logoredsocial" alt="Logo Linkedin">
                                    <p>Linkedin</p>
                              </a>                        
                              <a href="https://github.com/yassirprograma/Proyecto_TDAW" target="_blank">
                                    <img src="./imagenesindex/githublogo.png" alt="Logo github">
                                    <p>Repositorio Github</p>
                              </a>                        
                        </div>
                        <br>
                        <br>                        
                        <a href="./paginas/EquipodeTrabajo/EquipodeTrabajo.html" target="_blank">Conoce más información sobre el equipo de trabajo</a>
                        
                  </div>

            </div>

      </body>
</html>
