<?php

session_start();
if (empty($_SESSION['active'])) {
    header('location:../login.php');
}
$tipo_rol = '';
if ($_SESSION['id_rol'] == 1) {
    $tipo_rol = 'Administrador';
} else {
    $tipo_rol = 'Empleado';
}

?>

<nav class="nav">
    <ul class="list">
        <li class="logo">
            <img src="../../img/StockS.png" alt="">
        </li>

        <!-- inicio -->
        <li class="list__item">
            <div class="list__button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                    <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                </svg>
                <a href="../index.php" class="nav__link">Inicio</a>
            </div>
        </li>
        <!-- usuarios -->
        <li class="list__item list__item--click">
            <div class="list__button list__button--click">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                </svg>
                <a href="#" class="nav__link">Usuarios</a>
                <img src="../../img/ARROW.svg" class="list__arrow">
            </div>
            <ul class="list__show">
            <?php if ($tipo_rol == 'Administrador') { ?>
                <li class="list__inside">
                    <a href="../usuarios/agregarusuario.php" class="nav__link nav__link--inside">Crear usuario</a>
                </li>
            <?php } ?>   
                <li class="list__inside">
                    <a href="../usuarios/listausuarios.php" class="nav__link nav__link--inside">Lista de usuarios</a>
                </li>
            </ul>

        </li>

        <!-- compras -->
        <li class="list__item list__item--click">
            <div class="list__button list__button--click">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                </svg>
                <a href="#" class="nav__link">Compras</a>
                <img src="../../img/ARROW.svg" class="list__arrow">
            </div>

            <ul class="list__show">
                <li class="list__inside">
                    <a href="../compras/agregarcompra.php" class="nav__link nav__link--inside">Crear compra</a>
                </li>

                <li class="list__inside">
                    <a href="../compras/listacompras.php" class="nav__link nav__link--inside">Lista de compras</a>
                </li>
                <?php if ($tipo_rol == 'Administrador') { ?>
                <li class="list__inside">
                    <a href="../compras/agregarproveedor.php" class="nav__link nav__link--inside">Crear proveedor</a>
                </li>
                <?php } ?>
                <li class="list__inside">
                    <a href="../compras/listaproveedores.php" class="nav__link nav__link--inside">Lista de proveedores</a>
                </li>
            </ul>

        </li>

        <!-- inventarios -->
        <li class="list__item list__item--click">
            <div class="list__button list__button--click">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calculator" viewBox="0 0 16 16">
                    <path d="M12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z" />
                    <path d="M4 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-4z" />
                </svg>
                <a href="#" class="nav__link">Inventarios</a>
                <img src="../../img/ARROW.svg" class="list__arrow">
            </div>

            <ul class="list__show">
                <li class="list__inside">
                    <a href="../inventarios/bodegas.php" class="nav__link nav__link--inside">Bodegas</a>
                </li>
                <li class="list__inside">
                    <a href="../inventarios/3inventarios.php" class="nav__link nav__link--inside">Inventarios</a>
                </li>
            </ul>

        </li>
        <!-- productos -->
        <li class="list__item list__item--click">
            <div class="list__button list__button--click">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                    <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                </svg>
                <a href="#" class="nav__link">Productos</a>
                <img src="../../img/ARROW.svg" class="list__arrow">
            </div>

            <ul class="list__show">
                <?php if ($tipo_rol == 'Administrador') { ?>
                <li class="list__inside">
                    <a href="../inventarios/agregarproducto.php" class="nav__link nav__link--inside">Crear productos</a>
                </li>
                <?php } ?>
                <li class="list__inside">
                    <a href="../inventarios/listaproductos.php" class="nav__link nav__link--inside">Lista productos</a>
                </li>
                <li class="list__inside">
                    <a href="../inventarios/categoriaproductos.php" class="nav__link nav__link--inside">Categorías</a>
                </li>
            </ul>

        </li>

        <!-- ventas -->
        <li class="list__item list__item--click">
            <div class="list__button list__button--click">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-handbag" viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 1 2 2v2H6V3a2 2 0 0 1 2-2zm3 4V3a3 3 0 1 0-6 0v2H3.36a1.5 1.5 0 0 0-1.483 1.277L.85 13.13A2.5 2.5 0 0 0 3.322 16h9.355a2.5 2.5 0 0 0 2.473-2.87l-1.028-6.853A1.5 1.5 0 0 0 12.64 5H11zm-1 1v1.5a.5.5 0 0 0 1 0V6h1.639a.5.5 0 0 1 .494.426l1.028 6.851A1.5 1.5 0 0 1 12.678 15H3.322a1.5 1.5 0 0 1-1.483-1.723l1.028-6.851A.5.5 0 0 1 3.36 6H5v1.5a.5.5 0 1 0 1 0V6h4z" />
                </svg>
                <a href="#" class="nav__link">Ventas</a>
                <img src="../../img/ARROW.svg" class="list__arrow">
            </div>

            <ul class="list__show">
                <li class="list__inside">
                    <a href="../ventas/agregarventa.php" class="nav__link nav__link--inside">Crear venta</a>
                </li>

                <li class="list__inside">
                    <a href="../ventas/listaventas.php" class="nav__link nav__link--inside">Lista de ventas</a>
                </li>
                <?php if ($tipo_rol == 'Administrador') { ?>
                <li class="list__inside">
                    <a href="../ventas/agregarcliente.php" class="nav__link nav__link--inside">Crear cliente</a>
                </li>
                <?php } ?>
                <li class="list__inside">
                    <a href="../ventas/listaclientes.php" class="nav__link nav__link--inside">Lista de clientes</a>
                </li>
            </ul>

        </li>
        <li class="list__item">
            <div class="list__button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                </svg>
                <a href="../config/perfil.php" class="nav__link">Perfil</a>
            </div>
        </li>
        <li class="list__item">
            <div class="list__button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z" />
                </svg>
                <a href="../config/salir.php" class="nav__link">Cerrar sesión</a>
            </div>
        </li>
        <li class="list__item">
            <div class="list__button-rol">
                <p class="user"> <?php echo $_SESSION['usuario']; ?> </p>
                <p class="rol"> <b> <?php echo $tipo_rol ?> </b> </p> 
            </div>
        </li>
    </ul>
</nav>


<?php include '../generales/scriptsapp.php' ?>