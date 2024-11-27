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

    <h4 class="text-center text-secondary">REGISTRO DE MOVILIDAD</h4>

    <?php
    include '../modelo/conexion.php';
    include "../controlador/controlador_registrar_vehiculo.php"
    ?>

    <div class="row">
        <form action="" method="POST">
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="Placa" class="input input_text" name="txtnombre">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="Marca" class="input input_text" name="txtmarca">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="Modelo" class="input input_text" name="txtmodelo">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="Color" class="input input_text" name="txtcolor">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="Año" class="input input_text" name="txtaño">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" placeholder="Tipo de Movilidad" class="input input_text" name="txttipomovil">
            </div>
           
            <div class="text-right p-2">
                <a href="vehiculo.php" class="btn btn-secondary btn-rounded">Atras</a>
                <button type="submit" value="ok" name="btnregistrar" class="btn btn-primary btn-rounded">Registrar</button>
            </div>
        </form>
</div>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>