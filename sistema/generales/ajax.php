<?php
include "../../php/conexion.php";

session_start();
//print_r($_POST); exit;

if (!empty($_POST)) {

    //extraer datos del producto
    if ($_POST['action'] == 'infoProducto') {

        $id_producto = $_POST['producto'];

        $query = mysqli_query($conn, "SELECT id_producto, nombre_producto FROM producto
            WHERE id_producto = $id_producto AND estado=1 ");

        $result = mysqli_num_rows($query);

        if ($result > 0) {
            $data = mysqli_fetch_assoc($query);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            exit;
        }
        echo "error";
        exit;
    }
    //agregar datos del produc
    if ($_POST['action'] == 'addProduct') {

        if (!empty($_POST['cantidad']) || !empty($_POST['precio']) || !empty($_POST['id_producto'])) {

            $cantidad = $_POST['cantidad'];
            $precio = $_POST['precio'];
            $id_producto = $_POST['id_producto'];
            $id_usuario = $_SESSION['id_usuario'];

            $quey_insert = mysqli_query($conn, "INSERT INTO inventario (id_producto, existencia, precio, id_usuario)
                VALUES ($id_producto, $cantidad, $precio, $id_usuario)");

            if ($quey_insert) {
                // ejecutar procedimiento almacenado
                $query_upd = mysqli_query($conn, "CALL actualizar_precio_producto($cantidad, $precio, $id_producto)");

                $result_pro = mysqli_num_rows($query_upd);
                if ($result_pro > 0) {
                    $data = mysqli_fetch_assoc($query_upd);

                    $data ['id_producto'] = $id_producto;

                    echo json_encode($data, JSON_UNESCAPED_UNICODE);
                    exit;
                }
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    }
    exit;
}
exit;
