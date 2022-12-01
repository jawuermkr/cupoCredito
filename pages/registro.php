<?php

    session_start();
    ob_start();

?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="css/estilos.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6 card mt-5 p-5 shadow">
            <!--<img class="m-auto pb-5" src="img/logo-white.png" width="60%"> -->
            <h2>Registro</h2>
            <form action="registro.php" method="post">
            <div class="row">    
              <div class="col-sm-8">
                <label>Nombre</label>
                <input class="form-control" type="text" name="nombre">
              </div>
              <div class="col-sm-4">
                <label>Usuario</label>
                <input class="form-control" type="text" name="usuario">
              </div>
              <div class="col-sm-8">
                <label>Correo</label>
                <input class="form-control" type="email" name="correo">
              </div>
              <div class="col-sm-4">  
                <label>Clave</label>
                <input class="form-control" type="password" name="clave">
              </div>
              <div class="col-sm-12">
                <input class="form-control btn btn-outline-primary" type="submit" name="btnR" value="Registrar">
              </div>
              </form>
                <a href="../index.php"><small>¡Ingresar!</small></a>
            </div>
            <?php

            if (isset($_POST['btnR'])) {

                $nombre = $_POST['nombre'];
                $usuario = $_POST['usuario'];
                $correo = $_POST['correo'];
                $clave = $_POST['clave'];
                $fecha_r = date("Y-m-d");

                if($nombre == "" || $usuario == "" || $correo == "" || $clave == ""){
                    echo "<script>
                    Swal.fire(
                        '¡Sin datos!',
                        'Todos los campos son obligatorios.',
                        'warning'
                      )
                    </script>";
                }else {    

                include("../conexion.php");
                
                $existe = "SELECT `usuario` FROM `usuarios` WHERE `usuario` = '$usuario'";
                $res_existe = mysqli_query($conexion, $existe);
                
                if (mysqli_num_rows($res_existe) == 0) {
                    $sql = $conexion->query("INSERT INTO usuarios (nombre, usuario, correo, clave, fecha_r) VALUES ('$nombre','$usuario','$correo','$clave','$fecha_r')");

                  if($sql > 0){
                    echo "<script>
                    Swal.fire(
                        '¡Perfecto!',
                        'Ya puedes hacer uso del sistema.',
                        'success'
                      )
                    </script>";
                  }
                  } else {
                    echo "<script>
                    Swal.fire(
                        '¡Duplicado!',
                        'El usuario ya existe, contacta con soporte para recuperar tu clave.',
                        'error'
                      )
                    </script>";
                }
                include("../desconexion.php");
                }
              }
            ?>
        </div>
        <div class="col-sm-3">
        </div>
    </div>
</div>

<?php

include("footer.php");

?>




