<?php 
    session_start();
    if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
        header('location:login/login.php');
    }
?>

<style>
    ul li:nth-child(5) .activo {
        background: rgb(11, 150, 214) !important;
    }
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class="text-center text-secondary">DATOS DE LA ASOCIACION</h4>

    <?php
    include '../modelo/conexion.php';
    include '../controlador/controlador_modificar_empresa.php';

    // Ejecutar consulta para obtener datos de la empresa
    $sql = $conexion->query("SELECT * FROM empresa");

    // Inicializar el ID de la empresa
    $id_empresa = null;

    // Procesar la subida de documentos
    if (isset($_POST['btnsubir'])) {
        if (!empty($_FILES['pdf_document']['name'])) {
            $documento = $_FILES['pdf_document']['name'];
            $ruta_temp = $_FILES['pdf_document']['tmp_name'];
            $destino = "../documentos/" . $documento;

            if (move_uploaded_file($ruta_temp, $destino)) {
                $id_empresa = $_POST['txtid']; // Vincular el documento con la empresa correspondiente
                $sql_insert = $conexion->query("INSERT INTO documento (id_empresa, nombre_documento, ruta) VALUES ('$id_empresa', '$documento', '$destino')");
                if ($sql_insert) {
                    echo "<div class='alert alert-success'>Documento subido y guardado correctamente.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error al guardar el documento en la base de datos.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Error al subir el archivo.</div>";
            }
        } else {
            echo "<div class='alert alert-warning'>Por favor, seleccione un archivo PDF.</div>";
        }
    }

    // Procesar la eliminación de documentos
    if (isset($_GET['eliminar']) && $_GET['eliminar'] == 1) {
        $id_documento = $_GET['id'];
        $sql_delete = $conexion->query("DELETE FROM documento WHERE id_documento = '$id_documento'");
        if ($sql_delete) {
            echo "<div class='alert alert-success'>Documento eliminado correctamente.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al eliminar el documento.</div>";
        }
    }
    ?>

    <div class="row">
        <form action="" method="POST" enctype="multipart/form-data">
            <?php
            // Mostrar datos de la empresa
            if ($sql->num_rows > 0) {
                while ($datos = $sql->fetch_object()) { 
                    // Guardar el ID de la empresa
                    $id_empresa = $datos->id_empresa;
            ?>
                    <div hidden class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                        <input type="text" placeholder="ID" class="input input__text" name="txtid" value="<?= $datos->id_empresa ?>">
                    </div>
                    <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                        <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre" value="<?= $datos->nombre ?>">
                    </div>
                    <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                        <input type="text" placeholder="Telefono" class="input input__text" name="txttelefono" value="<?= $datos->telefono ?>">
                    </div>
                    <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                        <input type="text" placeholder="Ubicacion" class="input input__text" name="txtubicacion" value="<?= $datos->ubicacion ?>">
                    </div>
                    <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                        <input type="text" placeholder="Personeria Juridica" class="input input__text" name="txtruc" value="<?= $datos->ruc ?>">
                    </div>
                    <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                        <label for="pdf_document">Subir Documento (PDF):</label>
                        <input type="file" name="pdf_document" class="form-control">
                    </div>
                    <div class="text-right p-2">
                        <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">MODIFICAR</button>
                        <button type="submit" value="upload" name="btnsubir" class="btn btn-success btn-rounded">SUBIR DOCUMENTO</button>
                    </div>
                <?php }
            } else {
                echo "<div class='alert alert-danger'>No se encontraron datos de la empresa.</div>";
            }
            ?>
        </form>
    </div>

    <!-- Mostrar documentos subidos -->
    <div class="row mt-4">
        <h5 class="text-secondary">Documentos Subidos</h5>
        <?php
        // Validar que el ID de la empresa no sea nulo antes de ejecutar la consulta
        if (!empty($id_empresa)) {
            $sql_docs = $conexion->query("SELECT * FROM documento WHERE id_empresa = '$id_empresa'");
            if ($sql_docs->num_rows > 0) {
                while ($doc = $sql_docs->fetch_object()) { ?>
                    <div class="col-12 col-md-6 mb-3">
                        <a href="<?= $doc->ruta ?>" target="_blank" class="btn btn-info btn-rounded">Mostrar Documento: <?= $doc->nombre_documento ?></a>
                        <a href="?eliminar=1&id=<?= $doc->id_documento ?>" class="btn btn-danger btn-rounded" onclick="return confirm('¿Estás seguro de eliminar este documento?')">Eliminar</a>
                    </div>
                <?php }
            } else {
                echo "<div class='alert alert-warning'>No se encontraron documentos subidos para esta empresa.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>No se pudo cargar el ID de la empresa.</div>";
        }
        ?>
    </div>

</div>
<!-- fin del contenido principal -->

<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>