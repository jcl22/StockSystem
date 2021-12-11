<?php
include "../../php/conexion.php";

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['id_proveedor']) || empty($_POST['nombre_proveedor'])
        || empty($_POST['direccion']) || empty($_POST['telefono'])) 
        {
        $alert = ' <h4> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg> <b> Error! Todos los campos son obligatorios.  </b> 
                    </h4> ';
    } else {

        $id_Proveedor = $_POST['id_proveedor']; 
        $nombre_proveedor = $_POST['nombre_proveedor'];
        $direccion = $_POST['direccion'];
        $telefono = ($_POST['telefono']);
        $estado = 1;

        $query = mysqli_query($conn, "SELECT * FROM proveedor
         WHERE  (nombre_proveedor = '$nombre_proveedor' AND id_proveedor != $id_Proveedor) ");
        
        $result = mysqli_fetch_array($query);


        if ($result > 0) {
            $alert = '  <h6> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                            </svg> <b> Error! El proveedor ya existe. </b> 
                        </h6> ';
        } else {



                $sql_update = mysqli_query ($conn, "UPDATE proveedor SET nombre_proveedor = '$nombre_proveedor', 
                direccion = '$direccion', telefono = '$telefono'
                WHERE id_proveedor = $id_Proveedor");


            if ($sql_update) {
                $alert = '  <h5> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                </svg> <b> El proveedor se ha actualizado correctamente. </b> 
                            </h5> ';
            } else {
                $alert = ' <h4 > 
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg> <b> Error al actualizar el proveedor. </b> </h4> ';

            }
        }
    }
}

// mostrar datos

if (empty($_GET['id'])) {
    header ('location:2.2listaproveedor.php');
}
$id_Proveedor =  $_GET['id'];

$sql= mysqli_query($conn, "SELECT * FROM proveedor WHERE id_proveedor=$id_Proveedor");

$result_edit = mysqli_num_rows($sql);

if ($result_edit == 0 ) {
    header ('location:2.2listaproveedor.php');
} else {

    
    while ($data = mysqli_fetch_array($sql)) {
        $id_Proveedor = $data ['id_proveedor'];
        $nombre_proveedor = $data ['nombre_proveedor'];
        $direccion = $data ['direccion'];
        $telefono = $data ['telefono'];
        $estado = 1;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras | Proveedor/Editar</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicons -->
    <link rel="icon" href="../../img/LOGO-ICON.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f19db1c03.js" crossorigin="anonymous"></script>


    <?php include '../../php/scripts2.php' ?>

</head>

<body>

    <?php include '../generales/header2.php'?>


    <section id="content-section" >
        <div class="titulo-section">
            <svg class="img-editproduct" xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
        </div>
        <div class="container-form">
            <div class="content">
                <div class="row-">

                    <form action="" method="post">
                        <div class="form-content ">
                            <div class="col-sm-4-left">
                                    <input type="hidden" name="id_proveedor" id="" value=" <?php echo $id_Proveedor; ?> ">
                                <div class="form-group">
                                    <input type="text" name="nombre_proveedor" id="" placeholder="Proveedor" value= "<?php echo $nombre_proveedor; ?>" >
                                </div>
 
                            </div>

                            <div class="col-sm-4-right">
                                <div class="form-group">
                                    <input type="text" name="direccion" id="" placeholder="Dirección" value= "<?php echo $direccion; ?>" >
                                </div>
                                <div class="form-group">
                                    <input type="text" name="telefono" id="" placeholder="Teléfono" value= "<?php echo $telefono; ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="botones">
                            <button id="button-modificar" type="submit" class="btn btn-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                </svg>Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="alert">
            <?php echo isset($alert) ? $alert : ''; ?>
        </div>
    </section>

    <section id="botones-footer">
        <div class="content">
            <div class="botones-abl-footer">
                <div class="float-left boton wow pulse" data-wow-iteration="infinite" data-wow-duration="500ms">
                    <a href="2.2listaproveedores.php" class="boton btn btn-primary"><i
                            class="fas fa-chevron-circle-left"></i></a>
                </div>
                <div class="float-right boton wow pulse" data-wow-iteration="infinite" data-wow-duration="500ms">
                    <a href="../index.php" class="boton btn btn-primary"><i class="fas fa-home"></i></a>
                </div>
            </div>
        </div>
    </section>

        <?php include '../generales/footer.php'?>



</body>

</html>