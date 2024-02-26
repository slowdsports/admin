<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">
                    Agregar Canal
                </h4>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <!-- NOMBRE -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="canalNombre" class="form-label">Nombre</label>
                                <input type="text" id="canalNombre" class="form-control" required>
                            </div>
                        </div>
                        <!-- IMAGEN -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="canalImg" class="form-label">Imagen</label>
                                <input type="text" id="canalImg" class="form-control" required>
                            </div>
                        </div>
                        <!-- CATEGORIA -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="canalCategoria" class="form-label">Categoría</label>
                                <select class="form-control select2" data-toggle="select2" id="canalCategoria"
                                    name="canalCategoria" required>
                                    <?php
                                    $categorias_query = "SELECT categoriaId, categoriaNombre FROM categorias";
                                    $resultado_categorias = mysqli_query($conn, $categorias_query);
                                    while ($categoria = mysqli_fetch_assoc($resultado_categorias)):
                                        ?>
                                        <option value="<?= $categoria['categoriaId'] ?>">
                                            <?= $categoria['categoriaNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CTA -->
                        <button type="button" id="agregar" name="agregar" class="btn btn-primary"
                            onclick="agregarCanal()">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>