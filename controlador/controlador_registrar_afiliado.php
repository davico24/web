<?php

if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtvehiculo"])) {
            $nombre = $_POST["txtnombre"];
            $apellido = $_POST["txtapellido"];
            $dni = $_POST["txtdni"];
            $telefono = $_POST["txttelefono"];
            $direccion = $_POST["txtdireccion"];
            $estadocivil = $_POST["txtestadocivil"];
            $vehiculo = $_POST["txtvehiculo"];
            $sql = $conexion->query(" insert into afiliado(nombre,apellido,dni,telefono,direccion,estadocivil,vehiculo)values('$nombre', '$apellido', $dni, '$telefono', '$direccion', '$estadocivil', $vehiculo) ");
            if ($sql == true) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Afiliado registrado correctamente",
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
                        text: "Error al registrar afiliado",
                        styling: "bootstrap3"
                    })
                })    
            </script>
            <?php }
        } else { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
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