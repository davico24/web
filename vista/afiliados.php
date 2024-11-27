<?php
    session_start();
    if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
        header('location:login/login.php');
    }

?>

<style>
    ul li:nth-child(3) .activo  {
        background: rgb(11, 150, 214) !important;
    }
</style>



<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class="text-center text-secondary">LISTA DE AFILIADOS</h4>
    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_modificar_afiliado.php";
    include "../controlador/controlador_eliminar_afiliado.php";

    $sql = $conexion->query(" SELECT
    afiliado.id_afiliado,
    afiliado.nombre,
    afiliado.apellido,
    afiliado.dni,
    afiliado.telefono,
    afiliado.direccion,
    afiliado.estadocivil,
    afiliado.vehiculo,
    vehiculo.nombre as 'nom_vehiculo'
    FROM
    afiliado
    INNER JOIN vehiculo ON afiliado.vehiculo = vehiculo.id_vehiculo
     ");
    ?>
    
    <a href="registro_afiliado.php" class="btn btn-primary btn-rounded mb-2"><i class="fas fa-plus"></i> &nbsp;Registrar</a>
    <div class="text-right mb-2">
        <a href="fpdf/ReporteAfiliado.php" target="_blank" class="btn btn-success"><i class="fas fa-file-pdf"></i> Generar reportes</a>
</div>
    <table class="table table-bordered table-hover w-100" id="example">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOMBRE</th> 
                <th scope="col">APELLIDO</th>
                <th scope="col">CI</th>
                <th scope="col">TELEFONO</th>
                <th scope="col">DIRECCION</th>
                <th scope="col">ESTADO CIVIL</th>
                <th scope="col">PLACA</th>
            <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($datos = $sql->fetch_object()) { ?>
            <tr>
                <td><?= $datos->id_afiliado ?></td>
                <td><?= $datos->nombre?></td>
                <td><?= $datos->apellido ?></td>
                <td><?= $datos->dni ?></td>
                <td><?= $datos->telefono ?></td>
                <td><?= $datos->direccion ?></td>
                <td><?= $datos->estadocivil ?></td>
                <td><?= $datos->nom_vehiculo ?></td>
                <td>
                    <a href="" data-bs-toggle="modal" data-toggle="modal" data-target="#exampleModal<?= $datos->id_afiliado ?>" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                    <a href="afiliados.php?id=<?= $datos->id_afiliado ?>" onclick="advertencia(event)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                </td>
            </tr>

<!-- Modal -->
<div class="modal fade" id="exampleModal<?= $datos->id_afiliado ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-between">
        <h5 class="modal-title w-100" id="exampleModalLabel">Modificar Afiliado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="POST">
            <div hidden class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="ID" class="input input__text" name="txtid" value="<?= $datos->id_afiliado ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre" value="<?= $datos->nombre ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="Apellido" class="input input__text" name="txtapellido" value="<?= $datos->apellido ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="CI" class="input input__text" name="txtdni" value="<?= $datos->dni ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="Telefono" class="input input__text" name="txttelefono" value="<?= $datos->telefono ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="Direccion" class="input input__text" name="txtdireccion" value="<?= $datos->direccion ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="Estado Civil" class="input input__text" name="txtestadocivil" value="<?= $datos->estadocivil ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
            <select name="txtvehiculo" class="input input__select">
                <?php
                    $sql2 = $conexion->query(" select * from vehiculo ");
                    while ($datos2 = $sql2->fetch_object()) { ?>
                    <option <?= $datos->vehiculo==$datos2->id_vehiculo ? 'selected' : '' ?> value="<?= $datos2->id_vehiculo ?>"><?= $datos2->nombre ?></option>
                    <?php }
                ?>
            </select>
            </div>

            <div class="text-right p-2">
                <a href="afiliados.php" class="btn btn-secondary btn-rounded">Atras</a>
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