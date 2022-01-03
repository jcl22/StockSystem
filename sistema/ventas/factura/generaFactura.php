

<?php

//print_r($_REQUEST);
//exit;
//echo base64_encode('2');
//exit;
session_start();
if (empty($_SESSION['active'])) {
	header('location: ../');
}
include "../../../php/conexion.php";
require_once '../pdf/vendor/autoload.php';


use Dompdf\Dompdf;



if (empty($_REQUEST['cl']) || empty($_REQUEST['f'])) {
	echo "No es posible generar la factura.";
} else {
	$codCliente = $_REQUEST['cl'];
	$noFactura = $_REQUEST['f'];
	$anulada = '';

	$query_config   = mysqli_query($conn, "SELECT * FROM config_empresa");
	$result_config  = mysqli_num_rows($query_config);
	if ($result_config > 0) {
		$configuracion = mysqli_fetch_assoc($query_config);
	}


	$query = mysqli_query($conn, "SELECT v.id_venta, DATE_FORMAT(v.fecha_venta, '%d/%m/%Y') as fecha, 
											DATE_FORMAT(v.fecha_venta,'%H:%i:%s') as  hora, v.id_cliente, v.estado,
												 u.nombre_usuario as vendedor,
												 cl.id_cliente, cl.nombre_cliente, cl.telefono,cl.direccion
											FROM venta v
											INNER JOIN usuarios u
											ON v.id_usuario = u.id_usuario
											INNER JOIN cliente cl
											ON v.id_cliente = cl.id_cliente
											WHERE v.id_venta = $noFactura AND v.id_cliente = $codCliente  AND v.estado != 10 ");

	$result = mysqli_num_rows($query);
	if ($result > 0) {

		$factura = mysqli_fetch_assoc($query);
		$no_factura = $factura['id_venta'];

		if ($factura['estado'] == 2) {
			$anulada = '<img class="anulada" src="../pdf/vendor/dompdf\dompdf/Anulado.png" alt="Anulada">';
		}

		$query_productos = mysqli_query($conn, "SELECT p.nombre_producto,dt.cantidad,dt.precio_venta,
														(dt.cantidad * dt.precio_venta) as precio_total
														FROM venta v
														INNER JOIN detalle_venta dt
														ON v.id_venta = dt.id_venta
														INNER JOIN producto p
														ON dt.id_producto = p.id_producto
														WHERE v.id_venta = $no_factura ");
		$result_detalle = mysqli_num_rows($query_productos);

		ob_start();
		include(dirname('__FILE__') . '/factura.php');
		$html = ob_get_clean();
		ob_end_clean();

		// $options = new Options();
		// $options->set('isRemoteEnabled', TRUE);
		$dompdf = new Dompdf();


		// instantiate and use the dompdf class
		//$dompdf = new Dompdf();

		$dompdf->loadHtml($html);
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('letter', 'portrait');
		// Render the HTML as PDF
		$dompdf->render();
		// Output the generated PDF to Browser
		$dompdf->stream('factura_' . $noFactura . '.pdf', array('Attachment' => 0));
		exit;
	}
}

?>