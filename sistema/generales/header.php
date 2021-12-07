<?php
include '../php/conexion.php';
include '../php/function.php';

session_start();
if (empty($_SESSION['active'])) {
    header('location:../login.php');
}

?>
<!-- if par traer tipo de rol -->
<?php
$tipo_rol = '';
if ($_SESSION['id_rol'] == 1) {
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
                        <p class="fecha"> <?php echo fechaC(); ?> </p>
                        <h2>¡Hola!<br><span class="user-name" id="user-name"> <?php echo $_SESSION['nombre_usuario']; ?> </span></h2>
                    </div>
                    <div id="dropbtn" class="date-user dropbtn wow animated bounceInLeft box3" data-wow-delay="0.6s">
                        <div class="content-user d-flex">
                            <div class="name">
                                <span class="primernombre" id="primernombre"> <?php echo $_SESSION['usuario'] . " - "; ?> <?php echo $tipo_rol ?></span>
                            </div>
                            <div class="user-photo">
                                <div class="img-user">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div id="dropdown-content" class="user-option dropdown-content wow fadeInUp">
                            <ul>
                                <li><a href="index.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                                        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
                                    </svg> Inicio 
                                </a></li>
                                <li><a href="config/perfil.php"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                    </svg> Mi perfil 
                                </a></li>                    
                                <li><a href="config/salir.php"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                                        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                                    </svg> Cerrar sesión 
                                </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>