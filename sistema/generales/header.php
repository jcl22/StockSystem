

<?php
    include '../php/conexion.php';
    include '../php/function.php';

    session_start();
    if (empty($_SESSION['active']))  
    {
        header('location:../login.php');
    }  

?>
<!-- if par traer tipo de rol -->
<?php
    $tipo_rol='';
    if ($_SESSION ['id_rol']==1) {
        $tipo_rol = 'Admin';
    } else {
        $tipo_rol = 'Empl';
    }
?>

<header id="header">
    <div class="container">
        <div class="content">
            <div class="row-">
                <div class="display d-flex">
                    <div class="logo-empresa wow animated bounceInLeft box1" data-wow-delay="0.2s">
                        <img src="../img/LOGO2.png" alt="">
                    </div>
                    <div class="saludo wow animated bounceInLeft box2" data-wow-delay="0.4s">
                        <p class="fecha"> <?php echo fechaC(); ?>  </p>     
                        <h2>¡Hola!<br><span class="user-name" id="user-name"> <?php echo $_SESSION ['nombre_usuario']; ?> </span></h2>
                    </div>
                    <div id="dropbtn" class="date-user dropbtn wow animated bounceInLeft box3" data-wow-delay="0.6s">
                        <div class="content-user d-flex">
                            <div class="name">
                                <span class="primernombre" id="primernombre"> <?php echo $_SESSION ['usuario'] . " - "; ?> <?php echo $tipo_rol ?></span>            
                            </div>
                            <div class="user-photo">
                                <div class="img-user">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div id="dropdown-content" class="user-option dropdown-content wow fadeInUp">
                            <ul>
                                <li><a href="config/perfil.php">Perfil</a></li>
                                <li><a href="config/cambiar_contrasena.php">Cambiar contraseña</a></li>
                                <li><a href="config/salir.php">Cerrar sesión</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>