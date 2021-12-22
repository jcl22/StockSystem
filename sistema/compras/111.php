<?php
include "../../php/conexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras | Crear proveedor </title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicons -->
    <link rel="icon" href="../../img/StockS.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f19db1c03.js" crossorigin="anonymous"></script>


</head>

<body>
    <!-- <select id="colaboradores">
        <option value="0" data-codigo="" data-dni="" selected disabled>--Seleccione colaborador--</option>
        <option value="1" data-codigo="A1" data-dni="111">Pedro</option>
        <option value="2" data-codigo="M1" data-dni="222">María</option>
        <option value="3" data-codigo="S1" data-dni="333">Santiago</option>
    </select>
    <hr />
    <input id="id" type="text" placeholder="id" />
    <input id="codigo" type="text" placeholder="código" />
    <input id="nombre" type="text" placeholder="nombre" />
    <input id="dni" type="text" placeholder="DNI" /> -->
    <div align="center">
        <select id="producto">
            <option value="0" data-costo_producto="" selected disabled>--Producto--</option>
            <?php
            $query = $conn->query("SELECT * FROM producto");
            while ($row = $query->fetch_assoc()) {
                $data = "data-costo_producto=\"$row[costo_producto]\""; #Como atributo data sólo irán codigo y dni
                $value = "value=\"$row[id_producto]\"";                      #El id_colaborador lo tomaremos del value
                echo "<option $value $data>$row[nombre_producto]</option>";           #El nombre lo tomaremos del text
            }
            ?>
        </select>
        <hr />
        <input id="id" type="text" placeholder="id" />
        <input id="costo_producto" type="text" placeholder="costo" />

    </div>
</body>



</html>


<script>
    document.getElementById('producto').onchange = function() {
        /* Referencia al option seleccionado */
        var mOption = this.options[this.selectedIndex];
        /* Referencia a los atributos data de la opción seleccionada */
        var mData = mOption.dataset;

        /* Referencia a los input */
        var elId = document.getElementById('id');
        var elCosto = document.getElementById('costo_producto');


        /* Asignamos cada dato a su input*/
        elId.value = this.value;
        elCosto.value = mData.costo_producto;

    };
</script>