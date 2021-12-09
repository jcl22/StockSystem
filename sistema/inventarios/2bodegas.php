<?php
include "../../php/conexion.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventarios | Bodegas </title>
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

    <?php include '../generales/header2.php' ?>

    <section id="content-section">
        <div class="content-lista">
            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-map" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15.817.113A.5.5 0 0 1 16 .5v14a.5.5 0 0 1-.402.49l-5 1a.502.502 0 0 1-.196 0L5.5 15.01l-4.902.98A.5.5 0 0 1 0 15.5v-14a.5.5 0 0 1 .402-.49l5-1a.5.5 0 0 1 .196 0L10.5.99l4.902-.98a.5.5 0 0 1 .415.103zM10 1.91l-4-.8v12.98l4 .8V1.91zm1 12.98 4-.8V1.11l-4 .8v12.98zm-6-.8V1.11l-4 .8v12.98l4-.8z"/>
            </svg>
        </div>
        <p class="content-text">*Las bodegas se basan en la rotación de los producto*</p>

        

        <div class="">
            <table>
                <tr>
                    <th>ID bodega</th>
                    <th>Nombre</th>
                    <th>Ciudad</th>
                    <th>Descripción</th>
                    <th>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                            <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                            <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                        </svg>
                    </th>
                </tr>

                <?php
                $query = mysqli_query($conn, "SELECT * FROM bodega ORDER BY id_bodega
                ASC");

                $result = mysqli_num_rows($query);

                if ($result > 0) {
                    while ($data = mysqli_fetch_array($query)) {

                ?>
                        <tr class="datos-usuario">
                            <td> <?php echo $data["id_bodega"] ?> </td>
                            <td> <?php echo $data["nombre_bodega"] ?> </td>
                            <td> <?php echo $data["lugar"] ?> </td>
                            <td> <?php echo $data["descripcion_bod"] ?> </td>


                            <?php if ($data["id_bodega"] ==1) { ?>
                            <td class="arrow1">    
                                <svg  xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                                    <path  fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                                </svg>
                            </td>
                            <?php } else if ($data["id_bodega"] ==2) { ?>
                            <td class="arrow2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-up-right-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.854 10.803a.5.5 0 1 1-.708-.707L9.243 6H6.475a.5.5 0 1 1 0-1h3.975a.5.5 0 0 1 .5.5v3.975a.5.5 0 1 1-1 0V6.707l-4.096 4.096z"/>
                                </svg>
                            </td>    
                            <?php } else if ($data["id_bodega"] ==3) { ?>
                            <td class="arrow3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                </svg>  
                            </td>    
                            <?php } else if ($data["id_bodega"] ==4) { ?> 
                            <td class="arrow4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-down-right-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.854 5.146a.5.5 0 1 0-.708.708L9.243 9.95H6.475a.5.5 0 1 0 0 1h3.975a.5.5 0 0 0 .5-.5V6.475a.5.5 0 1 0-1 0v2.768L5.854 5.146z"/>
                                </svg> 
                            </td>  
                            <?php } else if ($data["id_bodega"] ==5) { ?>
                            <td class="arrow5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                                </svg>
                            </td>
                                <?php } ?>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>


            </table>
            
        </div>

        <section id="botones-footer">
            <div class="content">
                <div class="botones-abl-footer">
                    <div class="float-left boton wow pulse" data-wow-iteration="infinite" data-wow-duration="500ms">
                        <a href="modulo_inventarios.php" class="boton btn btn-primary"><i class="fas fa-chevron-circle-left"></i></a>
                    </div>
                    <div class="float-right boton wow pulse" data-wow-iteration="infinite" data-wow-duration="500ms">
                        <a href="../index.php" class="boton btn btn-primary"><i class="fas fa-home"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <?php include '../generales/footer.php' ?>

</body>

</html>