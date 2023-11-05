<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">
                    Agregar Fuente de Canal
                </h4>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="row">
                        <!-- DATOS CANAL -->
                        <div class="col-lg-12">
                            <div class="card">
                                <h4 class="header-title">Canal Padre</h4>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs mb-3" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a href="#existente" data-bs-toggle="tab" aria-expanded="false"
                                                    class="nav-link active" aria-selected="true" role="tab">
                                                    Existente
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a href="#nuevo" data-bs-toggle="tab" aria-expanded="true"
                                                    class="nav-link" aria-selected="false" role="tab" tabindex="-1">
                                                    Nuevo
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <!-- Canal Existente -->
                                            <div class="tab-pane active show" id="existente" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="canalExistente" class="form-label">Existente</label>
                                                        <select class="form-control select2" data-toggle="select2"
                                                            id="canalExistente" name="canalExistente">
                                                            <option value="">Ninguno</option>
                                                            <?php
                                                            $canales_query = "SELECT canalId, canalNombre FROM canales";
                                                            $resultado_canales = mysqli_query($conn, $canales_query);
                                                            while ($canal = mysqli_fetch_assoc($resultado_canales)):
                                                                ?>
                                                                <option value="<?= $canal['canalId'] ?>">
                                                                    <?= $canal['canalNombre'] ?>
                                                                </option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Canal Nuevo -->
                                            <div class="tab-pane" id="nuevo" role="tabpanel">
                                                <div class="row">
                                                    <!-- NOMBRE -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="canalNombre" class="form-label">Nombre</label>
                                                            <input type="text" id="canalNombre" class="form-control">
                                                        </div>
                                                    </div>
                                                    <!-- URL -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="canalImg" class="form-label">Imagen</label>
                                                            <input type="text" id="canalImg" class="form-control">
                                                        </div>
                                                    </div>
                                                    <!-- CATEGORIA -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="canalCategoria"
                                                                class="form-label">Categoría</label>
                                                            <select class="form-control select2" data-toggle="select2"
                                                                id="canalCategoria" name="canalCategoria">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end card-body -->
                                </div>
                            </div>
                        </div>
                        <!-- DATOS FUENTE -->
                        <div class="col-lg-12">
                            <div class="card">
                                <h4 class="header-title">Datos de la Fuente</h4>
                            </div>
                        </div>
                        <!-- NOMBRE -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="fuenteNombre" class="form-label">Nombre</label>
                                <input type="text" id="fuenteNombre" class="form-control">
                            </div>
                        </div>
                        <!-- URL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="fuenteUrl" class="form-label">URL</label>
                                <input type="text" id="fuenteUrl" class="form-control">
                            </div>
                        </div>
                        <!-- KEY 1 -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="key1" class="form-label">Key 1</label>
                                <input type="text" id="key1" class="form-control">
                            </div>
                        </div>
                        <!-- KEY 2 -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="key2" class="form-label">Key 2</label>
                                <input type="text" id="key2" class="form-control">
                            </div>
                        </div>
                        <!-- PAIS -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="pais" class="form-label">Liga</label>
                                <select class="form-control select2" data-toggle="select2" id="pais" name="pais">
                                    <?php
                                    $paises_query = "SELECT paisId, paisNombre FROM paises";
                                    $resultado_paises = mysqli_query($conn, $paises_query);
                                    while ($pais = mysqli_fetch_assoc($resultado_paises)):
                                        ?>
                                        <option value="<?= $pais['paisId'] ?>">
                                            <?= $pais['paisNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- TIPOS -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="tipo" class="form-label">Tipo</label>
                                <select class="form-control select2" data-toggle="select2" id="tipo" name="tipo">
                                    <?php
                                    $tipos_query = "SELECT tipoId, tipoNombre FROM tipos";
                                    $resultado_tipos = mysqli_query($conn, $tipos_query);
                                    while ($tipo = mysqli_fetch_assoc($resultado_tipos)):
                                        ?>
                                        <option value="<?= $tipo['tipoId'] ?>">
                                            <?= $tipo['tipoNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CTA -->
                        <button type="submit" id="agregar" name="agregar" class="btn btn-primary">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>