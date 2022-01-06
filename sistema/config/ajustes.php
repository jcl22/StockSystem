<?php
include "../../php/conexion.php";

    $nit = '';
    $nombre = '';
    $telefono = '';
    $correo = '';
    $direccion = '';

    $query_empresa = mysqli_query($conn, "SELECT *FROM config_empresa");
    $result_empresa = mysqli_num_rows($query_empresa);
    if($result_empresa > 0 ) {
        while($infoEmpresa = mysqli_fetch_assoc($query_empresa)) {
            $nit = $infoEmpresa['nit'];
            $razonsocial = $infoEmpresa['razon_social'];
            $telefono = $infoEmpresa['telefono'];
            $correo = $infoEmpresa['correo'];
            $direccion = $infoEmpresa['direccion'];
        }
    }



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos | Lista Productos</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicons -->
    <link rel="icon" href="../../img/StockS.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f19db1c03.js" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        <?php include '../generales/headerapp.php' ?>
    </header>
    <?php
    $query_cantidades = mysqli_query($conn, "CALL datesInfo()");
    $result_cantidades = mysqli_num_rows($query_cantidades);

    if ($result_cantidades > 0) {
        $data_cantidades = mysqli_fetch_assoc($query_cantidades);
    }

    ?>
    <section>
        <article class="config">
            <a type="button" class="option_perfil" onclick="mostrar(1)">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                </svg>
                <p>Info</p>
            </a>
            <a type="button" class="option_estadistica" onclick="mostrar(2)">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07Z" />
                </svg>
                <p>Estadísticas</p>
            </a>
            <a type="button" class="option_contra" onclick="mostrar(3)">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
                    <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.356 3.356a1 1 0 0 0 1.414 0l1.586-1.586a1 1 0 0 0 0-1.414l-3.356-3.356a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0zm9.646 10.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708zM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11z" />
                </svg>
                <p>Cambiar contraseña</p>
            </a>
        </article>

        <!-- perfil -->
        <article id="perfil" class="opciones">
            <div class="cont-1">
                <!-- info personal -->
                <div class="datos_perfil">
                    <div class="mi_perfil">
                        <h1>Mi perfil</h1>
                        <br><br>
                        <div class="descriptions-perfil">
                            <p class="datos-perfil"> <b><span>ID usuario:</span></b> <?php echo $_SESSION['id_usuario']; ?> </p>
                            <p class="datos-perfil"> <b><span>Nombre:</span></b> <?php echo $_SESSION['nombre_usuario']; ?> </p>
                            <p class="datos-perfil"> <b><span>Usuario:</span></b> <?php echo $_SESSION['usuario']; ?> </p>
                            <p class="datos-perfil"> <b><span>Correo:</span></b> <?php echo $_SESSION['correo']; ?> </p>
                            <p class="datos-perfil"> <b><span>Rol:</span></b> <?php echo $tipo_rol; ?> </p>
                        </div>
                    </div>
                    <!-- info empresa -->
                    <?php


                    ?>
                    <div class="empresa">
                        <h1>Empresa</h1>
                        <br><br>
                        <div class="descriptions-empresa">
                            <p class="datos-perfil"> <b><span>NIT:</span></b> <?php $nit; ?> </p>
                            <p class="datos-perfil"> <b><span>Razón social:</span></b> <?php echo $razonsocial; ?>  </p>
                            <p class="datos-perfil"> <b><span>Teléfono:</span></b><?php echo $telefono; ?> </p>
                            <p class="datos-perfil"> <b><span>Correo:</span></b> <?php echo $correo; ?>  </p>
                            <p class="datos-perfil"> <b><span>Dirección:</span></b> <?php echo $direccion; ?>  </p>

                        </div>
                    </div>
                </div>
                <p class="copyright"> <b><span>© Copyright - 2022</span></b></p>

            </div>
        </article>

        <!-- Estadisticas   -->
        <article id="estadistica" class="opciones">
            <div class="cont-1">
                <!-- contenido 1 -->
                <div class="people">
                    <!-- usuarios -->
                    <div class="date">

                        <div class="date-svg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                            </svg>
                        </div>
                        <h3>Usuarios</h3>
                        <p class="cantidad"> <b> <?php echo $data_cantidades['cant_u']; ?> </b></p>
                        <!-- <p>Activos: <?php echo $data_cantidades['cant_usuarios']; ?></p>
                        <p>Inactivos: <?php echo $data_cantidades['cant_usuariosin']; ?></p> -->
                    </div>
                    <!-- proveedores -->
                    <div class="date">

                        <div class="date-svg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg>
                        </div>
                        <h3>Proveedores</h3>
                        <p class="cantidad"> <b> <?php echo $data_cantidades['cant_p']; ?> </b></p>
                        <!-- <p>Activos: <?php echo $data_cantidades['cant_proveedores']; ?></p>
                        <p>Inactivos: <?php echo $data_cantidades['cant_proveedoresin']; ?></p> -->
                    </div>
                    <!-- clientes -->
                    <div class="date">

                        <div class="date-svg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            </svg>
                        </div>
                        <h3>Clientes</h3>
                        <p class="cantidad"> <b> <?php echo $data_cantidades['cant_c']; ?> </b></p>
                        <!-- <p>Activos: <?php echo $data_cantidades['cant_clientes']; ?></p>
                        <p>Inactivos: <?php echo $data_cantidades['cant_clientesin']; ?></p> -->
                    </div>
                </div>

                <!-- contenido 2 -->
                <div class="dates">
                    <!-- productos -->
                    <div class="date">

                        <div class="date-svg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                            </svg>
                        </div>
                        <h3>Productos</h3>
                        <p class="cantidad"> <b> <?php echo $data_cantidades['cant_pr']; ?> </b></p>
                        <!-- <p>Activos: <?php echo $data_cantidades['cant_productos']; ?></p>
                        <p>Inactivos: <?php echo $data_cantidades['cant_productosin']; ?></p> -->
                    </div>
                    <!-- ventas -->
                    <div class="date">

                        <div class="date-svg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-handbag" viewBox="0 0 16 16">
                                <path d="M8 1a2 2 0 0 1 2 2v2H6V3a2 2 0 0 1 2-2zm3 4V3a3 3 0 1 0-6 0v2H3.36a1.5 1.5 0 0 0-1.483 1.277L.85 13.13A2.5 2.5 0 0 0 3.322 16h9.355a2.5 2.5 0 0 0 2.473-2.87l-1.028-6.853A1.5 1.5 0 0 0 12.64 5H11zm-1 1v1.5a.5.5 0 0 0 1 0V6h1.639a.5.5 0 0 1 .494.426l1.028 6.851A1.5 1.5 0 0 1 12.678 15H3.322a1.5 1.5 0 0 1-1.483-1.723l1.028-6.851A.5.5 0 0 1 3.36 6H5v1.5a.5.5 0 1 0 1 0V6h4z" />
                            </svg>
                        </div>
                        <h3>Ventas</h3>
                        <p class="cantidad"> <b> <?php echo $data_cantidades['cant_v']; ?> </b></p>
                        <!-- <p>Pagadas: <?php echo $data_cantidades['cant_ventas']; ?></p>
                        <p>Anuladas: <?php echo $data_cantidades['cant_ventasan']; ?></p> -->
                    </div>
                </div>

            </div>
        </article>


        <!-- cambiacontra -->
        <article id="cambiacontra" class="opciones">
            <div class="cont-1">
                <!-- cambiar contraseña -->
                <div class="contra">
                    <form action="" id="formCambio" name="formCambio">
                        <!-- <div class="contra-svg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                                <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                            </svg>
                        </div> -->
                        <div class="form-group" id="contra-label">
                            <label for="formGroupExampleInput">Contraseña actual</label>
                            <input type="password" class="form-control" id="txt_Actual" name="txt_Actual">
                        </div>
                        <div class="form-group" id="contra-label">
                            <label for="formGroupExampleInput">Nueva contraseña</label>
                            <input type="password" class="form-control nueva_contrasena" id="txt_newPass" name="txt_Actual">
                        </div>
                        <div class="form-group" id="contra-label">
                            <label for="formGroupExampleInput">Confirmar contraseña</label>
                            <input type="password" class="form-control nueva_contrasena" id="txt_confirmPass" name="txt_Actual">
                        </div>
                        <div id="alert-contra">
                            <!-- <p></p> -->
                        </div>
                        <div class="button">
                            <input id="contra" type="submit" value="Guardar" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
            </div>
        </article>
    </section>

</body>

</html>

<script src="../generales/funciones.js"></script>