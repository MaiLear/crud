<?php

use Controllers\FrutaController;

include_once("Controllers/FrutaController.php");

if (isset($_POST['crear'])) {

    $msg = FrutaController::store() ? 'Producto creado satisfactoriamente' : 'No se pudo crear el producto';
}

$response = FrutaController::index() ? FrutaController::index() : '';


if (isset($_POST['actualizar'])) {
    $msg =  FrutaController::update() ? 'Producto actualizado satasfactoriamente' : 'No se pudo actualizar';
}

if (isset($_POST['eliminar'])) {
    $msg = FrutaController::destroy() ? 'Campo eliminado satisfactoriamente' : 'No se pudo eliminar el campo';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>frutas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <h1 class="text-center"><?php echo $msg ?? '' ?></h1>
    <div class="container d-flex justify-content-center">
        <form class="form card w-50" action="index.php" method="post">
            <div class="card-header text-center display-4">Formulario comida</div>
            <div class="card-body">
                <input class="form-control" type="text" name="name" placeholder="Ingrese el nombre de el alimento">
                <input class="form-control" type="number" name="valor" placeholder="Ingrese el costro del alimento">
                <input class="form-control" type="text" name="color" placeholder="Ingrese el color del alimento">
                <div class="d-flex justify-content-center">
                    <input class="btn btn-primary btn-lg my-4" type="submit" name="crear" value="Enviar">
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-5">
        <table id="mytable" class="table table-dark bg-dark caption-top">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Valor</th>
                    <th>Color</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($response as  $value) {
                    echo "<tr>
                   <td class='td__id'>$value[id]</td>
                   <td class='td__name'>$value[name]</td>
                   <td class='td__valor'>$value[valor]</td>
                   <td class='td__color'>$value[color]</td>
                   <td>
                   <div class='d-flex'>
                    <button class='btn btn-primary me-2' data-bs-toggle='modal' data-bs-target='#mi-modal' id='boton-modal'>Editar</button>
                    <form action='index.php' method='post'>
                    <input  type='hidden' name='id-eliminar' value=$value[id]>
                    <button type='submit' name='eliminar' class='btn btn-danger' id='boton-eliminar'>Eliminar</button></td>
                    </form>
                   </div>
                   </tr>";
                } ?>

            </tbody>
            <caption>Esta tabla contiene datos de un alimento</caption>
        </table>
    </div>

    <div class="modal fade" id="mi-modal">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Editar</h1>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body d-flex justify-content-center">
                    <form action="index.php" method="post">
                        <input type="hidden" id="modal__id" name="id">
                        <input type="text" class="mb-2 form-control" name="name" id="modal__name" placeholder="Ingrese el  nuevo nombre"><br>
                        <input type="number" class="mb-2 form-control" name="valor" id="modal__valor" placeholder="Ingrese el nuevo valor"><br>
                        <input type="text" class="mb-2 form-control" name="color" id="modal__color" placeholder="Ingrese el nuevo color"><br>
                        <input type="submit" class="mb-2 form-control bg-success text-light" name="actualizar" value="Actualizar">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <sc ript src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></sc>

    <script>
        document.addEventListener('click', (e) => {
            if (e.target.matches('#boton-modal')) {
                $elementTr = e.target.closest('tr');
                update($elementTr);
            }
        })



        let table = new DataTable('#mytable', {
            processing: true,
        });


        function update(parent) {
            console.log(parent);
            document.getElementById('modal__id').value = parent.querySelector('.td__id').textContent;
            document.getElementById('modal__name').value = parent.querySelector('.td__name').textContent;
            document.getElementById('modal__valor').value = valorValue = parent.querySelector('.td__valor').textContent;
            document.getElementById('modal__color').value = parent.querySelector('.td__color').textContent;
        }
    </script>
</body>

</html>