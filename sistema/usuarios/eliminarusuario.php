<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios | Eliminar Usuario</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicons -->
    <link rel="icon" href="../../img/LOGO-ICON.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/7f19db1c03.js" crossorigin="anonymous"></script>

    <?php include '../../php/scripts2.php' ?>
    
</head>

<body>

    <?php include '../generales/header2.php'?>

    <section id="content-section" >
        <div class="titulo-section">
            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-person-x"
                viewBox="0 0 16 16">
                <path
                    d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                <path fill-rule="evenodd"
                    d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z" />
            </svg>
        </div>
        <div class="container-eliminar">
            <div class="content">
                <div class="row-">
                    <div class="eliminar">
                        <!-- <h3>¡Cuidado! Estás a punto de realizar cambios importantes</h3> -->
                        <!-- <p class="subtitulo">Es muy importante que conozcas la información que depende este usuario, por lo que antes de eliminarlo te ofrecemos dos alternativas.</p> -->
                        <div class="row opciones-eliminar-g">

                            <div class="col-md-4 opciones-eliminar">
                                <div class="bg-opciones">
                                    <h5>Asignar dependencias a otro usuario</h5>
                                    <!-- <p>Puedes asignar las dependencias que el usuario tiene en las demas aereas a un usuario ya creado y posterior mente eleminar el usuario de manera permanente.</p> -->
                                    <div class="botones">
                                        <div class="boton-elimina-pro">
                                            <div class="bg-boton">
                                                <button onclick="mostrarAsigned();" class="asignar-dependencias"
                                                    id="button-asigned">Aplicar opción</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 opciones-eliminar">

                                <div class="bg-opciones">
                                    <!-- <p class="especial">Recomendado</p> -->
                                    <h5>Activar o inactivar usuario y sus dependencias</h5>
                                    <!-- <p>Puedes archivar el usuario de manera permanente y conservar sus dependecias, es decir, concervar los cambios o requerimientos que este tenga pendientes en las diferentes areas que se ecuentra involucrado</p> -->
                                    <div class="botones">

                                        <div class="boton-elimina-pro">
                                            <div class="bg-boton">
                                                <button onclick="mostrarBlock();" class="bloquear">Aplicar
                                                    opción</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 opciones-eliminar">
                                <div class="bg-opciones">
                                    <h5>Eliminar usuario y sus dependencias</h5>
                                    <!-- <p>Elimina de manra permanete este usuario y cada una de sus dependecias y cada uno de los cambios establecidos desde su periodo de creación.</p> -->
                                    <div class="botones">

                                        <div class="boton-elimina-pro">
                                            <div class="bg-boton">
                                                <button onclick="mostrarRemove();">Aplicar opción</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Asignar -->
                            <div class="option-asigdep" id="asigned">
                                <form action="">
                                    <input type="text" name="" id="" placeholder="ID usuario a asignar ">
                                </form>
                                <button id="asigned-user" type="button" class="btn btn-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" />
                                    </svg>Asignar </button>
                                <button onclick="cancelAsigned();" id="cancel-asigned" type="button"
                                    class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-x-circle" viewBox="0 0 16 16">
                                        <path
                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                    </svg>Cancelar</button>
                            </div>

                            <!-- Bloquear -->
                            <div class="option-block" id="block">
                                <form action="">
                                    <input type="text" name="" id="" placeholder="ID usuario a bloquear/desbloquear">
                                </form>
                                <button id="block-user" type="button" class="btn btn-dark"> <svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-lock" viewBox="0 0 16 16">
                                        <path
                                            d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z" />
                                    </svg> Bloquear </button>
                                <button id="desblock-user" type="button" class="btn btn-sucess">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-unlock" viewBox="0 0 16 16">
                                        <path
                                            d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z" />
                                    </svg> Desbloquear </button>
                                <button onclick="cancelBlock();" id="cancel-block" type="button" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-x-circle" viewBox="0 0 16 16">
                                        <path
                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                    </svg> Cancelar</button>
                            </div>

                            <!-- eliminar -->

                            <div class="option-asigdep" id="remove">
                                <form action="">
                                    <input type="text" name="" id="" placeholder="ID usuario a eliminar ">
                                </form>
                                <button id="remove-user" type="button" class="btn btn-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd"
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>Eliminar
                                </button>
                                <button onclick="cancelRemove();" id="cancel-remove" type="button"
                                    class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-x-circle" viewBox="0 0 16 16">
                                        <path
                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                    </svg>Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="botones-footer">
        <div class="content">
            <div class="botones-abl-footer">
                <div class="float-left boton wow pulse" data-wow-iteration="infinite" data-wow-duration="500ms">
                    <a href="modulo_usuarios.php" class="boton btn btn-primary"><i
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