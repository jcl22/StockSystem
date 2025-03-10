<?php
include "../../php/conexion.php";

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['id_cliente']) || empty($_POST['nombre_cliente'])
        || empty($_POST['direccion']) || empty($_POST['telefono'])) 
        {
        $alert ='<div id="alert" class="alert alert-warning d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg><b> Error! Todos los campos son obligatorios.  </b> 
                </div> ';
    } else {

        $id_Cliente = $_POST['id_cliente']; 
        $nombre_cliente = $_POST['nombre_cliente'];
        $direccion = $_POST['direccion'];
        $telefono = ($_POST['telefono']);
        $estado = 1;



                $sql_update = mysqli_query ($conn, "UPDATE cliente SET nombre_cliente = '$nombre_cliente', 
                direccion = '$direccion', telefono = '$telefono'
                WHERE id_cliente = $id_Cliente");


            if ($sql_update) {
                $alert ='<div id="alert" class="alert alert-success d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg><b> El cliente se ha actualizado correctamente  </b> 
                        </div>';
            } else {
                $alert ='<div id="alert" class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg><b> Error al actualizar el cliente  </b> 
                        </div>';
            }
        }
    }

// mostrar datos

if (empty($_GET['id'])) {
    header ('location:listaclientes.php');
}
$id_Cliente =  $_GET['id'];

$sql= mysqli_query($conn, "SELECT * FROM cliente WHERE id_cliente=$id_Cliente AND estado =1" );

$result_edit = mysqli_num_rows($sql);

if ($result_edit == 0 ) {
    header ('location:listacliente.php');
} else {

    
    while ($data = mysqli_fetch_array($sql)) {
        $id_Cliente = $data ['id_cliente'];
        $nombre_cliente = $data ['nombre_cliente'];
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
    <title>Socios | Editar Cliente </title>
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

    <section>
        <div class="tittle">
            <h2>Editar cliente </h2> <br>
        </div>
        <form action="" method="post">
            <div class="formulario">
                <input type="hidden" name="id_cliente" id="" value=" <?php echo $id_Cliente; ?> ">
                <div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Nombre</label>
                        <input type="text" class="form-control" id="" name="nombre_cliente" value="<?php echo $nombre_cliente; ?>">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Dirección</label>
                        <input type="text" class="form-control" id="" name="direccion" value="<?php echo $direccion; ?>">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Teléfono</label>
                        <input type="text" class="form-control" id="" name="telefono" value="<?php echo $telefono; ?>">
                    </div>
                </div>
            </div>
            <div class="button">
                <input id="login" type="submit" value="Actualizar" class="btn float-right login_btn">
            </div>
        </form>
        <?php echo isset($alert) ? $alert : ''; ?>
    </section>

</body>

</html>