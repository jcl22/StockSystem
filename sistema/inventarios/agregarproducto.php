<?php
include "../../php/conexion.php";

if (!empty($_POST)) {
    $alert = '';
    if (
        empty($_POST['nombre_producto']) || empty($_POST['id_categoria'])
        || empty($_POST['costo_producto']) || empty($_POST['precio_producto'])
    ) {
        $alert = '<div id="alert" class="alert alert-warning d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg><b> Error! Todos los campos son obligatorios.  </b> 
                </div> ';
    } else {


        $nombre_producto = $_POST['nombre_producto'];
        $id_categoria = $_POST['id_categoria'];
        $costo_producto = $_POST['costo_producto'];
        $precio_producto = $_POST['precio_producto'];

        $query = mysqli_query($conn, "SELECT * FROM producto 
        WHERE  nombre_producto = '$nombre_producto' ");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert ='<div id="alert" class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg><b> Error! El nombre del producto ya existe.  </b> 
                    </div>';
        } else {
            $query_insert = mysqli_query($conn, "INSERT INTO producto (nombre_producto, 
            id_categoria, costo_producto, precio_producto) VALUES ('$nombre_producto','$id_categoria','$costo_producto', '$precio_producto')");


            if ($query_insert) {
                $alert ='<div id="alert" class="alert alert-success d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg><b> El producto se ha creado correctamente. <br>
                            Para consultar el ID asignado, diríjase a lista de productos </b> 
                        </div>';
            } else {
                $alert ='<div id="alert" class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg><b> Error al crear el producto. </b> 
                        </div>';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario | Crear Producto </title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicons -->
    <link rel="icon" href="../../img/LOGO-ICON.ico">

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
            <h2>Crear proveedor</h2> <br>
        </div>
        <form action="" method="post">
            <div class="formulario">
                <div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Nombre</label>
                        <input type="text" class="form-control" name="nombre_producto" id="">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Categoría</label>
                        <?php
                        $query_categoria = mysqli_query($conn, "SELECT * FROM categoria_productos");
                        $result_categoria = mysqli_num_rows($query_categoria);
                        ?>
                        <select class="form-control" aria-label="Default select example" name="id_categoria">
                            <?php
                            if ($result_categoria > 0) {
                                while ($categoria = mysqli_fetch_array($query_categoria)) {
                            ?>
                                    <option value="<?php echo $categoria["id_categoria"]; ?>">
                                        <?php echo $categoria["nombre_categoria"] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Costo </label>
                        <input type="text" class="form-control" name="costo_producto" id="">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Precio</label>
                        <input type="text" class="form-control" name="precio_producto" id="">
                    </div>
                </div>
            </div>
            <div class="button">
                <input id="login" type="submit" value="Crear" class="btn float-right login_btn">
            </div>
        </form>
        <?php echo isset($alert) ? $alert : ''; ?>
    </section>
</body>

</html>