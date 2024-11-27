<?php

    if (!empty($_POST["btnregistrar"])) {
        if (!empty($_POST["txtnombre"])) {
            $nombre = $_POST["txtnombre"];
            $marca = $_POST["txtmarca"];
            $modelo = $_POST["txtmodelo"];
            $color = $_POST["txtcolor"];
            $año = $_POST["txtaño"];
            $tipomovil = $_POST["txttipomovil"];
            $verificarNombre = $conexion->query("SELECT COUNT(*) AS 'total' FROM vehiculo WHERE nombre = '$nombre' AND marca = '$marca' AND modelo = '$modelo' AND color = '$color' AND año = '$año' AND tipomovil = '$tipomovil'");
            if ($verificarNombre->fetch_object()->total > 0) { ?>
                    <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "ERROR",
                            type: "error",
                            text: "El Vehiculo <?= $nombre ?> ya existe",
                            styling: "bootstrap3"
                        })
                    })
                </script>
<?php } else {
    $sql = $conexion->query("insert into vehiculo(nombre,marca,modelo,color,año,tipomovil)values('$nombre', '$marca', '$modelo', '$color', '$año', '$tipomovil')");
        if ($sql==true) {?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Vehiculo registrado correctamente",
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
                            text: "Error al registrar vehiculo",
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