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
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4 card mt-5 p-5 shadow">
            <!--<img class="m-auto pb-5" src="img/logo-white.png" width="60%"> -->
            <h2>Patata</h2>

            <?php
            if ($_SESSION['correcto'] == 0 ){
                echo "<p class='bg-success p-1 text-center'>¡Regresa pronto!</p>";
            }
            ?>

            <form action="index.php" method="post">
                <label>Usuario</label>
                <input class="form-control" type="text" name="user">
                <label>Contraseña</label>
                <input class="form-control" type="password" name="pass">
                <input class="form-control btn btn-outline-success" type="submit" name="btnLogin" value="Ingresar">
                </form>
                <a href="pages/registro.php"><small>¡Registrate!</small></a>
            <?php
            
            if (isset($_POST['btnLogin'])) {

                $nombreUsu = $_POST['user'];
                $claveUsu = $_POST['pass'];

                if($nombreUsu == "" || $claveUsu == ""){
                    echo "<script>
                    Swal.fire(
                        '¡Sin datos!',
                        'Ingresa ambos datos.',
                        'warning'
                      )
                    </script>";
                }else {

                include("conexion.php");
                $resultados = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$nombreUsu' AND clave = '$claveUsu'");
                while ($consulta = mysqli_fetch_array($resultados)) {
                    $_SESSION['correcto'] = 1;
                    $_SESSION['nombre'] = $consulta['nombre'];
                    $_SESSION['id'] = $consulta['id'];
                }
                include("desconexion.php");
                echo "<script>
                        Swal.fire(
                            'Datos incorrectos',
                            'Valida de nuevo.',
                            'error'
                            )
                            </script>";
                        }
                    }
            
            if($_SESSION['correcto'] == 1){
                header("Location:pages/dashboard.php");
            }
            ?>
        </div>
        <div class="col-sm-4">
        </div>
    </div>
</div>

</body>
</html>