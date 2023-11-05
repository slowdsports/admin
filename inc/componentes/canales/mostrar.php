<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-start">
                    Filtro Liga
                </div>
                <div class="d-flex justify-content-end flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-success"><i
                            class="ri-money-pound-circle-line me-1"></i> Money</button>
                    <button type="button" class="btn btn-outline-primary"><i class="ri-paypal-line me-1"></i>
                        PayPal</button>
                    <button type="button" class="btn btn-outline-danger"><i class="ri-equalizer-line me-1"></i>
                        Settings</button>
                </div>
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
                            <tr>
                                <td class="table-user">
                                    <img src="../assets/img/canales/<?= $result['canalImg']; ?>.png"
                                        alt="table-user" class="me-2 rounded-circle">
                                        <?= $result['fuenteNombre']; ?>
                                </td>
                                <td>
                                    <?= $result['categoriaNombre']; ?>
                                </td>
                                <td>
                                    <div class="btn-group mb-2">
                                        <a href="?p=canales&editar=<?= $result['fuenteId'] ?>"
                                            class="btn btn-outline-primary">Editar</a>
                                        <button type="button" class="btn btn-outline-danger">Borrar</button>
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