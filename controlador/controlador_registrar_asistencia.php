<?php

if (!empty($_POST["btnentrada"])) {
    if (!empty($_POST["txtdni"])) {
        $dni = $_POST["txtdni"];
        $consulta = $conexion->query(" select count(*) as 'total' from afiliado where dni='$dni' ");
        $id = $conexion->query(" select id_afiliado from afiliado where dni='$dni' ");
        if ($consulta->fetch_object()->total > 0) {
            $fecha = date("Y-m-d h:i:s");
            $id_afiliado = $id->fetch_object()->id_afiliado;

            $consultaFecha = $conexion->query(" select entrada from asistencia where id_afiliado=$id_afiliado order by id_asistencia desc limit 1 ");
            $fechaBD = $consultaFecha->fetch_object()->entrada;

            if (substr($fecha, 0, 10) == substr($fechaBD, 0, 10)) {
                ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "INCORRECTO",
                            type: "error",
                            text: "YA REGISTRASTE TU ENTRADA",
                            styling: "bootstrap3"
                        })
                    })
                </script>
            <?php
            } else {
                $sql = $conexion->query(" insert into asistencia(id_afiliado,entrada)values($id_afiliado,'$fecha') ");
            if ($sql == true) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Hola, BIENVENIDO",
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
                    text: "Error al registrar ENTRADA",
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
                    text: "El CI ingresado no existe",
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
                text: "Ingrese el CI",
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

<!-- REGISTRO DE SALIDA -->

<?php

if (!empty($_POST["btnsalida"])) {
    if (!empty($_POST["txtdni"])) {
        $dni = $_POST["txtdni"];
        $consulta = $conexion->query(" select count(*) as 'total' from afiliado where dni='$dni' ");
        $id = $conexion->query(" select id_afiliado from afiliado where dni='$dni' ");
        if ($consulta->fetch_object()->total > 0) {

            $fecha = date("Y-m-d h:i:s");
            $id_afiliado = $id->fetch_object()->id_afiliado;
            $busqueda = $conexion->query(" select id_asistencia,entrada from asistencia where id_afiliado=$id_afiliado order by id_asistencia desc limit 1 ");
            
            while ($datos = $busqueda->fetch_object()) {
                $id_asistencia = $datos->id_asistencia;
                $entradaBD = $datos->entrada;
            }

            if (substr($fecha, 0, 10) !=substr($entradaBD, 0, 10)) {
                ?>
                <script>
            $(function notificacion() {
                new PNotify({
                    title: "INCORRECTO",
                    type: "error",
                    text: "PRIMERO DEBES REGISTRAR TU ENTRADA",
                    styling: "bootstrap3"
                    })
                })
        </script>
            <?php
            } else {
                $consultaFecha = $conexion->query(" select salida from asistencia where id_afiliado=$id_afiliado order by id_asistencia desc limit 1 ");
            $fechaBD = $consultaFecha->fetch_object()->salida;

            if (substr($fecha, 0, 10) ==substr($fechaBD, 0, 10)){
                ?>
                <script>
            $(function notificacion() {
                new PNotify({
                    title: "INCORRECTO",
                    type: "error",
                    text: "YA REGISTRASTE TU SALIDA",
                    styling: "bootstrap3"
                    })
                })
        </script>
            <?php
            } else {
                $sql = $conexion->query(" update asistencia set salida='$fecha' where id_asistencia=$id_asistencia ");
            if ($sql == true) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "ADIOS, Vuelve Pronto",
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
                    text: "Erro al registrar SALIDA",
                    styling: "bootstrap3"
                    })
                })
        </script>
            <?php }
            }
            }
            

            
        } else { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "INCORRECTO",
                    type: "error",
                    text: "El CI ingresado no existe",
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
                text: "Ingrese el CI",
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