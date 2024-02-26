<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">
                    Editar canal:
                    <?= $result['canalNombre'] ?>
                </h4>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <?php
                        // $getCanal = $_GET['editar'];
                        // $queryCanal = mysqli_query($conn, "SELECT * FROM canales WHERE canalId='$getCanal'");
                        // $result = mysqli_fetch_array($queryCanal);
                        // echo $result['canalId'];
                        ?>
                        <!-- DATOS FUENTE -->
                        <div class="col-lg-12">
                            <div class="card">
                                <h4 class="header-title">Datos del canal</h4>
                            </div>
                        </div>
                        <!-- NOMBRE -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="canalNombre" class="form-label">Nombre</label>
                                <input type="text" id="canalNombre" class="form-control" value="<?= $result['canalNombre'] ?>">
                            </div>
                        </div>
                        <!-- IMG -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="canalImg" class="form-label">Imagen (nombre en carpeta)</label>
                                <input type="text" id="canalImg" class="form-control" value="<?= $result['canalImg'] ?>">
                            </div>
                        </div>
                        <!-- CATEGORIAS -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categorías</label>
                                <select class="form-control select2" data-toggle="select2" id="categoria" name="categoria">
                                    <?php
                                    $categorias_query = "SELECT categoriaId, categoriaNombre FROM categorias";
                                    $resultado_categorias = mysqli_query($conn, $categorias_query);
                                    while ($categoria = mysqli_fetch_assoc($resultado_categorias)):
                                        ?>
                                        <option value="<?= $categoria['categoriaId'] ?>"
                                        <?= ($categoria['categoriaId'] == $result['canalCategoria']) ? "selected" : "" ?>>
                                            <?= $categoria['categoriaNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CTA -->
                        <button type="button" id="editar" name="editar" class="btn btn-primary"
                            onclick="editarCanal()">Editar</button>
                        <!-- ID -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <input type="hidden" id="canalId" class="form-control" value="<?= $result['canalId'] ?>">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>