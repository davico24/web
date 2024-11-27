<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtid"]) and !empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtvehiculo"])) {
        $id = $_POST["txtid"];
        $nombre = $_POST["txtnombre"];
        $apellido = $_POST["txtapellido"];
        $dni = $_POST["txtdni"];
        $telefono = $_POST["txttelefono"];
        $direccion = $_POST["txtdireccion"];
        $estadocivil = $_POST["txtestadocivil"];
        $vehiculo = $_POST["txtvehiculo"];
        $sql = $conexion->query(" update afiliado set nombre='$nombre', apellido='$apellido',dni='$dni',telefono='$telefono',direccion='$direccion',estadocivil='$estadocivil', vehiculo=$vehiculo where id_afiliado=$id ");
        if ($sql == true) { ?>
        <script>
        $(function notificacion() {
        new PNotify({
            title: "CORRECTO",
            type: "success",
            text: "El afiliado se ha modificado correctamente",
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
            text: "Error al modificar afiliado",
            styling: "bootstrap3"
        })
    })
    </script>
<?php } 
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