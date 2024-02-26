<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="?p=fuentes&agregar" class="btn btn-outline-primary">+ Agregar</a>
                <hr>
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Acción</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        while ($result = mysqli_fetch_array($canales)):
                            ?>
                            <tr id="fuente-<?= $result['fuenteId'] ?>">
                                <td class="table-user">
                                    <img src="../assets/img/canales/<?= $result['canalImg']; ?>.png"
                                        alt="table-user" class="me-2 rounded-circle">
                                        <?= $result['fuenteNombre']; ?> (<?= $result['paisNombre']; ?>)
                                </td>
                                <td>
                                    <?= $result['categoriaNombre']; ?>
                                </td>
                                <td>
                                    <div class="btn-group mb-2">
                                        <a href="?p=fuentes&editar=<?= $result['fuenteId'] ?>"
                                            class="btn btn-outline-primary">Editar</a>
                                        <button type="button" class="btn btn-outline-danger eliminarFuente"
                                        data-id="<?= $result['fuenteId'] ?>" onclick="eliminarFuente()">Borrar</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row -->