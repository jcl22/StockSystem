<?php
include "../../php/conexion.php";

session_start();
//print_r($_POST); exit;

if (!empty($_POST)) {

    //extraer datos del producto
    if ($_POST['action'] == 'infoProducto') {

        $id_producto = $_POST['producto'];

        $query = mysqli_query($conn, "SELECT id_producto, nombre_producto, precio, existencia FROM producto
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
        exit;
    } 

    //buscar cliente desde venta
    if($_POST['action'] == 'searchCliente') {
        if (!empty ($_POST['cliente'])) {
            $id_cliente = $_POST['cliente'];
    
            $query_cliente = mysqli_query($conn, "SELECT * FROM cliente WHERE id_cliente LIKE '$id_cliente' 
            AND estado=1");
            $result_cliente= mysqli_num_rows($query_cliente);
    
            $data='';
            if ($result_cliente > 0 ) {
                $data= mysqli_fetch_assoc($query_cliente);
            } else {
                $data = 0;
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        exit;
    }

    //agregar cliente desde venta 
    if($_POST['action'] == 'Cliente') {
        // $id = $_POST['id_cliente'];
        $id_cliente = $_POST['id_cliente'];
        $nombre_cliente = $_POST['nombre_cliente'];
        $telefono_cliente = $_POST['telefono_cliente'];
        $direccion_cliente = $_POST['direccion_cliente'];

        $query_insert= mysqli_query($conn, "INSERT INTO cliente (id_cliente, nombre_cliente, telefono, direccion)
        VALUES ('$id_cliente', '$nombre_cliente', '$telefono_cliente', '$direccion_cliente')" );

        if ($query_insert) {
            $id_Cliente = $_POST['id_cliente'];
            $msg =  $id_Cliente;
        } else {
            $msg =  "error";
        }
        echo $msg;
        exit;
    }

    //agregar producto a detalle de venta 
    if($_POST['action'] == 'agregarDetProducto') {
        if(empty($_POST['producto']) || empty($_POST['cantidad'])) {
            echo 'error';
        } else {
            $id_producto = $_POST['producto'];
            $id_cantidad = $_POST['cantidad'];
            $token = md5($_SESSION['id_usuario']);

            $query_iva = mysqli_query($conn, "SELECT iva FROM config_empresa");
            $result_iva = mysqli_num_rows($query_iva);

            $query_detalleTemp = mysqli_query($conn, "CALL add_detalletemp($id_producto, $id_cantidad, '$token')");
            $result_detalleTemp = mysqli_num_rows($query_detalleTemp);

            $detalleTabla = '';
            $subtotal = 0;
            $iva = 0;
            $total = 0;
            $arrayData = array();

            if ($result_detalleTemp > 0) {
                if ($result_iva > 0) {
                    $info_iva = mysqli_fetch_assoc($query_iva);
                    $iva = $info_iva ['iva'];
                }
                while ($data = mysqli_fetch_assoc($query_detalleTemp)) {

                    $precioTotal = round($data ['cantidad'] * $data ['precio_venta'],2);
                    $subtotal = round($subtotal + $precioTotal,2);
                    $total= round($total+ $precioTotal,2);

                    $detalleTabla .= '<tr>
                                        <td>'.$data['id_producto'].'</td>
                                        <td>'.$data['nombre_producto'].'</td>
                                        <td></td>
                                        <td>'.$data['cantidad'].'</td>
                                        <td>'.$data['precio_venta'].'</td>
                                        <td>'.$precioTotal.'</td>
                                        <td><a class="form-control" aria-label="Default select 
                                            example" name="" onclick="event.preventDefault();
                                            del_product_detalle('.$data['id_detemp'].');" 
                                            id="quit""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                          </svg></a> </td>
                                    </tr>
                    
                    ';

                }

                $impuesto = round($subtotal * ($iva/100),2);
                $total_siniva = round($subtotal - $impuesto,2);
                $total = round($total_siniva + $impuesto,2);

                $detalleTotales ='<tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                                <tr class="totales">
                                    <td row="span" colspan="5" class="textright"> <b>SUBTOTAL</b> </td>
                                    <td class="textright">'.$total_siniva.'</td>
                                    <td></td>
                                </tr>
                                <tr class="totales">
                                    <th row="span" colspan="5" class="textright"> <b>IVA '.$iva.'%</b> </th>
                                    <td class="textright">'.$impuesto.'</td>
                                    <td></td>
                                </tr>
                                <tr class="totales">
                                    <th row="span" colspan="5" class="textright"> <b>TOTAL</b> </th>
                                    <td class="textright">'.$total.'</td>
                                    <td></td>
                                </tr>';
                $arrayData ['detalle'] = $detalleTabla;
                $arrayData ['totales'] = $detalleTotales;

                echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);

            } else {
                echo 'error';
            }
        }
        exit;
    }

        // extrae datos del detalle temporal 
        if($_POST['action'] == 'searchForDetalle') {
            if(empty($_POST['usuario'])) {
                echo 'error';
            } else {

                $token = md5($_SESSION['id_usuario']);

                $query = mysqli_query($conn, "SELECT tmp.id_detemp, tmp.token_usuario, tmp.cantidad, tmp.precio_venta,
                p.id_producto, p.nombre_producto FROM detalle_temp tmp INNER JOIN producto p
                ON tmp.id_producto = p.id_producto 
                WHERE token_usuario = '$token' ");

                $result = mysqli_num_rows($query);
    
                $query_iva = mysqli_query($conn, "SELECT iva FROM config_empresa");
                $result_iva = mysqli_num_rows($query_iva);                
    
                $detalleTabla = '';
                $subtotal = 0;
                $iva = 0;
                $total = 0;
                $arrayData = array();
    
                if ($result > 0) {
                    if ($result_iva > 0) {
                        $info_iva = mysqli_fetch_assoc($query_iva);
                        $iva = $info_iva ['iva'];
                    }
                    while ($data = mysqli_fetch_assoc($query)) {
    
                        $precioTotal = round($data ['cantidad'] * $data ['precio_venta'],2);
                        $subtotal = round($subtotal + $precioTotal,2);
                        $total= round($total+ $precioTotal,2);
    
                        $detalleTabla .= '<tr>
                                            <td>'.$data['id_producto'].'</td>
                                            <td>'.$data['nombre_producto'].'</td>
                                            <td></td>
                                            <td>'.$data['cantidad'].'</td>
                                            <td>'.$data['precio_venta'].'</td>
                                            <td>'.$precioTotal.'</td>
                                            <td><a class="form-control" aria-label="Default select 
                                                example" name="" onclick="event.preventDefault();
                                                del_product_detalle('.$data['id_detemp'].');" 
                                                id="quit""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                              </svg></a> </td>
                                        </tr>
                        
                        ';
    
                    }
    
                    $impuesto = round($subtotal * ($iva/100),2);
                    $total_siniva = round($subtotal - $impuesto,2);
                    $total = round($total_siniva + $impuesto,2);
    
                    $detalleTotales ='<tr>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                    </tr>
                                    <tr class="totales">
                                        <td row="span" colspan="5" class="textright"> <b>SUBTOTAL</b> </td>
                                        <td class="textright">'.$total_siniva.'</td>
                                        <td></td>
                                    </tr>
                                    <tr class="totales">
                                        <th row="span" colspan="5" class="textright"> <b>IVA '.$iva.'%</b> </th>
                                        <td class="textright">'.$impuesto.'</td>
                                        <td></td>
                                    </tr>
                                    <tr class="totales">
                                        <th row="span" colspan="5" class="textright"> <b>TOTAL</b> </th>
                                        <td class="textright">'.$total.'</td>
                                        <td></td>
                                    </tr>';
                    $arrayData ['detalle'] = $detalleTabla;
                    $arrayData ['totales'] = $detalleTotales;
    
                    echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
    
                } else {
                    echo 'error';
                }
            }
            exit;
        }

         // eliminar datos del detalle temporal 
         if($_POST['action'] == 'del_product_detalle') {
            if(empty($_POST['id_detalle'])) {
                echo 'error';
            } else {

                $id_detalle = $_POST ['id_detalle'];
                $token = md5($_SESSION['id_usuario']);

                
    
                $query_iva = mysqli_query($conn, "SELECT iva FROM config_empresa");
                $result_iva = mysqli_num_rows($query_iva);    
                
                $query_detalleTemp = mysqli_query($conn, "CALL 	delete_detalletemp($id_detalle, '$token')");
                $result = mysqli_num_rows($query_detalleTemp);
    
                $detalleTabla = '';
                $subtotal = 0;
                $iva = 0;
                $total = 0;
                $arrayData = array();
    
                if ($result > 0) {
                    if ($result_iva > 0) {
                        $info_iva = mysqli_fetch_assoc($query_iva);
                        $iva = $info_iva ['iva'];
                    }
                    while ($data = mysqli_fetch_assoc($query_detalleTemp)) {
    
                        $precioTotal = round($data ['cantidad'] * $data ['precio_venta'],2);
                        $subtotal = round($subtotal + $precioTotal,2);
                        $total= round($total+ $precioTotal,2);
    
                        $detalleTabla .= '<tr>
                                            <td>'.$data['id_producto'].'</td>
                                            <td>'.$data['nombre_producto'].'</td>
                                            <td></td>
                                            <td>'.$data['cantidad'].'</td>
                                            <td>'.$data['precio_venta'].'</td>
                                            <td>'.$precioTotal.'</td>
                                            <td><a class="form-control" aria-label="Default select 
                                                example" name="" onclick="event.preventDefault();
                                                del_product_detalle('.$data['id_detemp'].');" 
                                                id="quit""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                              </svg></a> </td>
                                        </tr>
                        
                        ';
    
                    }
    
                    $impuesto = round($subtotal * ($iva/100),2);
                    $total_siniva = round($subtotal - $impuesto,2);
                    $total = round($total_siniva + $impuesto,2);
    
                    $detalleTotales ='<tr>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                    </tr>
                                    <tr class="totales">
                                        <td row="span" colspan="5" class="textright"> <b>SUBTOTAL ($)</b> </td>
                                        <td class="textright">'.$total_siniva.'</td>
                                        <td></td>
                                    </tr>
                                    <tr class="totales">
                                        <th row="span" colspan="5" class="textright"> <b>IVA '.$iva.'%</b> </th>
                                        <td class="textright">'.$impuesto.'</td>
                                        <td></td>
                                    </tr>
                                    <tr class="totales">
                                        <th row="span" colspan="5" class="textright"> <b>TOTAL</b> </th>
                                        <td class="textright">'.$total.'</td>
                                        <td></td>
                                    </tr>';
                    $arrayData ['detalle'] = $detalleTabla;
                    $arrayData ['totales'] = $detalleTotales;
    
                    echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
    
                } else {
                    echo 'error';
                }
            }
            exit;
         }

         //limpiar campos de venta
         if($_POST['action'] == 'anularVenta') {

            $token = md5($_SESSION['id_usuario']);
            $query_del = mysqli_query($conn, "DELETE FROM detalle_temp WHERE token_usuario = '$token'");

            if ($query_del) {
                echo 'ok';
            } else {
                echo 'error';
            }
            exit;

         }
         //crear venta
         if($_POST['action'] == 'crearVenta') {
             
            if (empty($_POST['cod_cliente'])) {
                $cod_cliente =1;
            } else{
                $cod_cliente = $_POST['cod_cliente'];
            }

            $token = md5($_SESSION['id_usuario']);
            $usuario = $_SESSION['id_usuario'];

            $query= mysqli_query($conn, "SELECT * FROM detalle_temp WHERE token_usuario = '$token' ");
            $result = mysqli_num_rows($query);

            if ($result>0) {
                $query_ejecutar = mysqli_query($conn, "CALL procesar_venta($usuario, $cod_cliente, '$token')");
                $result_ejecutar = mysqli_num_rows($query_ejecutar);

                if($result_ejecutar >0) {
                    $data = mysqli_fetch_assoc($query_ejecutar);
                    echo json_encode($data, JSON_UNESCAPED_UNICODE);
                } else {
                    echo "error";
                }
            } else {
                echo "error";
            }
            exit;
        }

        //cambiar contraseña
        if($_POST['action'] == 'changePass') { 
            
            if(!empty($_POST['passActual']) && !empty($_POST['passNueva']) ) {

                $password = md5($_POST['passActual']);
                $newpassword = md5($_POST['passNueva']);
                $id_usuario = $_SESSION['id_usuario'];

                $code='';
                $msg='';
                $arrData=array();

                $query_usuario = mysqli_query($conn, "SELECT * FROM usuarios WHERE contrasena = '$password'
                AND id_usuario = $id_usuario");

                $result_usuario = mysqli_num_rows($query_usuario);

                if($result_usuario >0) {
                    $quey_update = mysqli_query($conn, "UPDATE usuarios SET contrasena = '$newpassword'
                    WHERE id_usuario = $id_usuario");

                    if($quey_update) {
                        $code='00';
                        $msg='Contraseña cambiada correctamente';
                    } else {
                        $code='2';
                        $msg='Error al cambiar contraseña';
                    }

                } else {
                    $code='1';
                        $msg='La contraseña actual es incorrecta';
                }
                $arrData = array('cod'=> $code, 'msg'=> $msg);
                echo json_encode($arrData, JSON_UNESCAPED_UNICODE);


            } else {
                echo "Error";
            }
            exit;
        }
}
exit;
