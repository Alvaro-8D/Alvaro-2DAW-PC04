

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej 6 Formularios</title>
  <style>
    .error {color: #FF0000;}
  </style>
</head>
<body>
  <?php
    include '../funciones_formularios.php'; // incluye función limpiar_campos()
    $nombreVacio = $correoVacio = $sexoVacio = "";
    $todos_los_datos = true;
    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
      /* nombre */  
      if (empty($_POST['nombre'])) {
        $nombreVacio= "<span class=\"error\">* Obligatorio</span>";
        $todos_los_datos = false; $nombre = "";
      }else{
        $nombre = limpiar_campos($_POST['nombre']);
      }
      /* Apellidos */
      $ap1 = limpiar_campos($_POST['ap1']);
      $ap2 = limpiar_campos($_POST['ap2']);
      /* Correo */
      if (empty($_POST['correo'])) {
        $correoVacio= "<span class=\"error\">* Obligatorio</span>";
        $todos_los_datos = false;$correo = "";
      }else{
        $correo = limpiar_campos($_POST['correo']);
      }
      /* Sexo */
      if (empty($_POST['sexo'])) {
        $sexoVacio= "<span class=\"error\">* Obligatorio</span>";
        $todos_los_datos = false;$sexo = "";
      }else{
        $sexo = limpiar_campos($_POST['sexo']);
      }
      
      /* * * * * * * * * * Programa * * * * * * * * * * * * */
      $espacio = "^^^";
      $nuevoAlumno = "<p>Nombre: ".$nombre.$espacio."Apellido1: ".$ap1.$espacio."Apellido2: ".$ap2.$espacio."Correo: ".$correo.$espacio."Sexo: ".$sexo."</p>#";
    }
  ?>
  <h1>Datos Alumnos</h1>

  <form name='mi_formulario' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='POST'>
      <p>Nombre:  <input name="nombre" type="text" ><?php echo $nombreVacio;?></p>
      <p>Apellido1:  <input name="ap1" type="text"></p>
      <p>Apellido2:  <input name="ap2" type="text"></p>
      <p>Email:  <input name="correo" type="text"><?php echo $correoVacio;?></p>
      <p>Sexo:<br>
          <input type='radio' name='sexo' value='hombre'>Hombre <?php echo $sexoVacio;?></br>
          <input type='radio' name='sexo' value='mujer'>Mujer <?php echo $sexoVacio;?></br>
      </p>
      
      <input type="submit" value="Enviar" /> <input type="reset" value="Borrar" />
  </form>
    <br>
  <?php /* Ver Alumno*/
      if($todos_los_datos && ($_SERVER["REQUEST_METHOD"] == "POST")){
        echo "<br>";
        $archivo = fopen("datos.txt","a"); /* abrir u crear archivo */
        fwrite($archivo,$nuevoAlumno); // añade nuevo alumno al archivo
        $fichero = explode("#",file_get_contents("datos.txt"),-1);// separa en un array cada alumno
        foreach ($fichero as $key => $value) {
          $fichero2[$key] = explode("^^^",$value);// separa datos de cada alumno
        }
        fclose($archivo); /* cerrar archivo */
        
        
        
        verTabla($fichero2);
      }
      
  ?>
  
</body>
</html>