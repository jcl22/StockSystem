<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css" rel="stylesheet"/>

<div class="container">
  <div class="row">
    <table border="1" class="table" id="tablaprueba">
      <thead class="thead-dark">
        <tr>
          <th>ID</th>
          <th>Nombres</th>
          <th>Ap Paterno</th>
          <th>Ap Materno</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>

    <div class="form-group">
      <button type="button" class="btn btn-primary mr-2" onclick="agregarFila()">Agregar Fila</button>
      <button type="button" class="btn btn-danger" onclick="eliminarFila()">Eliminar Fila</button>
    </div>
  </div>
</div>

<script>
    function agregarFila() {
        document.getElementById("tablaprueba").insertRow(-1).innerHTML = '<td></td><td></td><td></td><td></td>';
    }

    function eliminarFila() {
        var table = document.getElementById("tablaprueba");
        var rowCount = table.rows.length;
        //console.log(rowCount);

        if (rowCount <= 1)
            alert('No se puede eliminar el encabezado');
        else
            table.deleteRow(rowCount - 1);
    }
</script>