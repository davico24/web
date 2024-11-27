<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtnombre"])) {
        $nombre = $_POST["txtnombre"];
        $marca = $_POST["txtmarca"];
        $modelo = $_POST["txtmodelo"];
        $color = $_POST["txtcolor"];
        $año = $_POST["txtaño"];
        $tipomovil = $_POST["txttipomovil"];
        $id = $_POST["txtid"];
        $verificarNombre = $conexion->query("SELECT COUNT(*) AS 'total' FROM vehiculo WHERE nombre = '$nombre' AND marca = '$marca' AND modelo = '$modelo' AND color = '$color' AND `año` = '$año' AND tipomovil = '$tipomovil' AND id_vehiculo != $id");
        if ($verificarNombre->fetch_object()->total > 0){ ?>
        <script>
        $(function notificacion() {
        new PNotify({
            title: "INCORRECTO",
            type: "error",
            text: "El nombre <?= $nombre ?> ya existe",
            styling: "bootstrap3"
        })
    })
    </script>
<?php } else { 
    $sql = $conexion->query(" update vehiculo set nombre='$nombre', marca='$marca', modelo='$modelo', color='$color', año='$año', tipomovil='$tipomovil' where id_vehiculo=$id ");
    if ($sql == true) { ?>
        <script>
        $(function notificacion() {
        new PNotify({
            title: "CORRECTO",
            type: "success",
            text: "Vehiculo modificado correctamente",
            styling: "bootstrap3"
        })
    })
    </script>
    <?php } else { ?>
        <script>
        $(function notificacion() {
        new PNotify({
            title: "INCORRECTO",
            type: "error",
            text: "Error al modificar los datos",
            styling: "bootstrap3"
        })
    })
    </script>
    <?php }
    
    }
    
    } else { ?>
    <script>
        $(function notificacion() {
        new PNotify({
            title: "INCORRECTO",
            type: "error",
            text: "Los campos estan vacios",
            styling: "bootstrap3"
        })
    })
    </script>
    <?php } ?>


<script>
    setTimeout(() => {
        window.history.replaceState(null, null, window.location.pathname);
        }, 0);
</script>

<?php }
?>