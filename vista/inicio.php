<?php
    session_start();
    if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
        header('location:login/login.php');
    }

?>

<style>
    ul li:nth-child(1) .activo  {
        background: rgb(11, 150, 214) !important;
    }
</style>



<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class="text-center text-secondary">LISTA DE ASISTENCIA DE AFILIADOS</h4>

    <?php
    include "../modelo/conexion.php";
    include "../controlador/Controlador_eliminar_asistencia.php";

    $sql=$conexion->query(" SELECT
    asistencia.id_asistencia,
    asistencia.id_afiliado,
    asistencia.entrada,
    asistencia.salida,
    afiliado.id_afiliado,
    afiliado.nombre as 'nom_afiliado',
    afiliado.apellido,
    afiliado.dni,
    afiliado.vehiculo,
    vehiculo.id_vehiculo,
    vehiculo.nombre as 'nom_vehiculo'
    FROM
    asistencia
    INNER JOIN afiliado ON asistencia.id_afiliado = afiliado.id_afiliado
    INNER JOIN vehiculo ON afiliado.vehiculo = vehiculo.id_vehiculo");

    ?>
    <div class="text-right mb-2">
        <a href="fpdf/ReporteAsistencia.php" target="_blank" class="btn btn-success"><i class="fas fa-file-pdf"></i> Generar reportes</a>
</div>
<div class="text-right mb-2">
        <a href="reporte_asistencia.php" class="btn btn-primary"><i class="fas fa-plus"></i> Mas Reporte</a>
</div>
    <table class="table table-bordered table-hover W-100" id="example">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">AFILIADO</th> 
                <th scope="col">CI</th>
                <th scope="col">PLACA</th>
                <th scope="col">ENTRADA</th>
                <th scope="col">SALIDA</th>
            <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($datos = $sql->fetch_object()) { ?>
            <tr>
                <td><?= $datos->id_asistencia ?></td>
                <td><?= $datos->nom_afiliado . " ". $datos->apellido?></td>
                <td><?= $datos->dni ?></td>
                <td><?= $datos->nom_vehiculo ?></td>
                <td><?= $datos->entrada ?></td>
                <td><?= $datos->salida ?></td>

                <td>
                    <a href="inicio.php?id=<?=$datos->id_asistencia?>" onclick="advertencia(event)" class="btn btn-danger"><i class="fas fa-trash"></i>
                </td>
            </tr>
        <?php }
        ?>


    </tbody>
</table>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>