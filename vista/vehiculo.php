<?php
    session_start();
    if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
        header('location:login/login.php');
    }

?>

<style>
    ul li:nth-child(4) .activo  {
        background: rgb(11, 150, 214) !important;
    }
</style>



<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class="text-center text-secondary">LISTA DE TIPO DE MOVILIDAD</h4>

    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_modificar_vehiculo.php";
    include "../controlador/controlador_eliminar_vehiculo.php";
    $sql=$conexion->query(" SELECT * from vehiculo ");

    ?>
    
    <a href="registro_vehiculo.php" class="btn btn-primary btn-rounded mb-2"><i class="fas fa-plus"></i> &nbsp;Registrar</a>
    <div class="text-right mb-2">
        <a href="fpdf/ReporteVehiculo.php" target="_blank" class="btn btn-success"><i class="fas fa-file-pdf"></i> Generar reportes</a>
</div>
    <table class="table table-bordered table-hover w-100" id="example">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">PLACA</th>
                <th scope="col">MARCA</th> 
                <th scope="col">MODELO</th> 
                <th scope="col">COLOR</th> 
                <th scope="col">AÑO</th> 
                <th scope="col">TIPO DE MOVILIDAD</th> 
            <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($datos = $sql->fetch_object()) { ?>
            <tr>
                <td><?= $datos->id_vehiculo ?></td>
                <td><?= $datos->nombre?></td>
                <td><?= $datos->marca?></td>
                <td><?= $datos->modelo?></td>
                <td><?= $datos->color?></td>
                <td><?= $datos->año?></td>
                <td><?= $datos->tipomovil?></td>
                <td>
                    <a href="" data-bs-toggle="modal" data-toggle="modal" data-target="#exampleModal<?= $datos->id_vehiculo ?>" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                    <a href="vehiculo.php?id=<?= $datos->id_vehiculo ?>" onclick="advertencia(event)" class="btn btn-danger"><i class="fas fa-trash"></i></i></a>
                </td>
            </tr>

<!-- Modal -->
<div class="modal fade" id="exampleModal<?= $datos->id_vehiculoo ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-between">
        <h5 class="modal-title w-100" id="exampleModalLabel">Modificar Movilidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="POST">
            <div hidden class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="ID" class="input input__text" name="txtid" value="<?= $datos->id_vehiculo ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="Placa" class="input input__text" name="txtnombre" value="<?= $datos->nombre ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="Marca" class="input input__text" name="txtmarca" value="<?= $datos->marca ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="Modelo" class="input input__text" name="txtmodelo" value="<?= $datos->modelo ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="Color" class="input input__text" name="txtcolor" value="<?= $datos->color ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="Año" class="input input__text" name="txtaño" value="<?= $datos->año ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="Tipo de Movilidad" class="input input__text" name="txtplaca" value="<?= $datos->tipomovil ?>">
            </div>
            

            <div class="text-right p-2">
                <a href="vehiculo.php" class="btn btn-secondary btn-rounded">Atras</a>
                <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">Modificar</button>
            </div>
        </form>
      </div>

    </div>
  </div>
</div>
        <?php }
        ?>


    </tbody>
</table>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>