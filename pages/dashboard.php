<?php

include("header.php");

$id = $_SESSION['id'];

?>

<div class="container">
  <div class="row">
    <div class="col-md-4 pt-3">
      <form action="dashboard.php" method="post">
        <input class="form-control" type="number" name="valor">
        <input class="form-control btn btn-outline-danger" type="submit" name="btnCupo">
      </form>
      <p><small>Ingresa tu cupo actual para <b>resetear</b>.</small></p>

      <?php
      if(isset($_POST['btnCupo'])){
        
        $valor = $_POST["valor"];
        $fecha_v = date("Y-m-d");
        
        include("../conexion.php");

        $sql = $conexion->query("INSERT INTO total (id_user, valor, fecha_v) VALUES ('$id','$valor','$fecha_v')");

          if($sql > 0){
            echo "<script>
            Swal.fire(
                '¡Actualizado!',
                'Se ha cargado el reset con el valor correspondiente.',
                'success'
              )
            </script>";
          }
        include("../desconexion.php");
      }
      ?>
    </div>      
    <div class="col-md-8 text-center">
      <?php
      include("../conexion.php");
      $resultados = mysqli_query($conexion, "SELECT valor FROM total WHERE id_user = '$id' ORDER BY `total`.`id_t` ASC");
      while ($consulta = mysqli_fetch_array($resultados)) {
        $actual = $consulta['valor'];
      }
      include("desconexion.php");
      ?>
    <h2>$ <?php echo $actual; ?></h2>
    </div>

    <div class="col-sm-12">
    <br/><hr>
    </div>

    <div class="col-sm-12">
      <h3>Registro</h3>  
      <p><small>No dejes escapar <b>nada</b>. Mantener tu registro actualizado es la clave para conocer tus <b>finanzas</b>.</small></p>
      <form action="dashboard.php" method="post">
        <div class="row">
          <div class="col-sm-6">
          <input class="form-control" type="date" name="fecha_g" value="<?php echo date("Y-m-d"); ?>">
          </div>
          <div class="col-sm-6">
            <input class="form-control" type="number" name="valor">
          </div>
          <div class="col-sm-12">
            <textarea class="form-control" type="text" name="detalles"></textarea>
            <input class="form-control btn btn-outline-danger" type="submit" name="btnGastos">
          </div>
        </div>
      </form>

      <?php
      if(isset($_POST['btnGastos'])){

        include("../conexion.php");

        // Consultamos tabla total
        $resultados = mysqli_query($conexion, "SELECT valor FROM total WHERE id_user = '$id' ORDER BY `total`.`id_t` ASC");
        while ($consulta = mysqli_fetch_array($resultados)) {
          $actual = $consulta['valor'];
        }
        // Guardamos valores del formulario
        $valor = $_POST["valor"];
        $detalles = $_POST["detalles"];
        $fecha_g = date("Y-m-d");
        
        // Actualizamos tabla total
        $insertar = $actual - $valor; 

        $conexion->query("INSERT INTO total (id_user, valor, fecha_v) VALUES ('$id','$insertar','$fecha_g')");

        // Actualizamos la tabla gastos
        $sql = $conexion->query("INSERT INTO gastos (id_user, valor, detalles, fecha_g) VALUES ('$id','$valor','$detalles','$fecha_g')");

          if($sql > 0){
            echo "<script>
            Swal.fire(
                '¡Perfecto!',
                'Actualización cargada correctamente.',
                'success'
              )
            </script>";
          }
        include("../desconexion.php");
      }
      ?>
    </div>
  </div>
</div>

<?php

include("footer.php");

?>