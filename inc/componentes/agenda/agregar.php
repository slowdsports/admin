<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">
                    Agregar Partido
                </h4>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <!-- LOCAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="equipoLocal" class="form-label">Equipo Local</label>
                                <select class="form-control select2" data-toggle="select2" id="equipoLocal"
                                    name="equipoLocal">
                                    <?php
                                    $equipos_query = "SELECT equipoId, equipoNombre FROM equipos";
                                    $resultado_equipos = mysqli_query($conn, $equipos_query);
                                    while ($equipo = mysqli_fetch_assoc($resultado_equipos)):
                                        ?>
                                        <option value="<?= $equipo['equipoId'] ?>">
                                            <?= $equipo['equipoNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- VISITANTE -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="equipoVisitante" class="form-label">Equipo Visitante</label>
                                <select class="form-control select2" data-toggle="select2" id="equipoVisitante"
                                    name="equipoVisitante">
                                    <?php
                                    $resultado_equipos = mysqli_query($conn, $equipos_query);
                                    while ($equipo = mysqli_fetch_assoc($resultado_equipos)):
                                        ?>
                                        <option value="<?= $equipo['equipoId'] ?>">
                                            <?= $equipo['equipoNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- LIGA -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoLiga" class="form-label">Liga</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoLiga"
                                    name="partidoLiga">
                                    <?php
                                    $ligas_query = "SELECT ligaId, ligaNombre FROM ligas";
                                    $resultado_ligas = mysqli_query($conn, $ligas_query);
                                    while ($liga = mysqli_fetch_assoc($resultado_ligas)):
                                        ?>
                                        <option value="<?= $liga['ligaId'] ?>">
                                            <?= $liga['ligaNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- TIPO -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoTipo" class="form-label">Tipo</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoTipo" name="partidoTipo">
                                    <option value="football">
                                        Fútbol
                                    </option>
                                    <option value="american-football">
                                        Fútbol Americano
                                    </option>
                                    <option value="basketball">
                                        Basketball
                                    </option>
                                    <option value="baseball">
                                        Baseball
                                    </option>
                                    <option value="tennis">
                                        Tennis
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!-- FECHA -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoFecha" class="form-label">Fecha</label>
                                <input type="datetime-local" id="partidoFecha" name="partidoFecha">
                            </div>
                        </div>
                        <!-- CANALES -->
                        <div class="col-lg-4">
                            <div class="card">
                                <h4 class="header-title">Canales</h4>
                            </div>
                        </div>
                        <!-- Star+ -->
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="starp" name="starp">
                                    <label class="form-check-label" for="starp">Star +</label>
                                </div>
                            </div>
                        </div>
                        <!-- Vix+ -->
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="vix" name="vix">
                                    <label class="form-check-label" for="vix">Vix +</label>
                                </div>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal1" class="form-label">Canal 1</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal1"
                                    name="partidoCanal1">
                                    <option value="">Ninguno</option>
                                    <?php
                                    $fuentes_query = "SELECT fuenteId, fuenteNombre FROM fuentes";
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option value="<?= $fuente['fuenteId'] ?>">
                                            <?= $fuente['fuenteNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal2" class="form-label">Canal 2</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal2"
                                    name="partidoCanal2">
                                    <option value="">Ninguno</option>
                                    <?php
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option value="<?= $fuente['fuenteId'] ?>">
                                            <?= $fuente['fuenteNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal3" class="form-label">Canal 3</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal3"
                                    name="partidoCanal3">
                                    <option value="">Ninguno</option>
                                    <?php
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option value="<?= $fuente['fuenteId'] ?>">
                                            <?= $fuente['fuenteNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal4" class="form-label">Canal 4</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal4"
                                    name="partidoCanal4">
                                    <option value="">Ninguno</option>
                                    <?php
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option value="<?= $fuente['fuenteId'] ?>">
                                            <?= $fuente['fuenteNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal5" class="form-label">Canal 5</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal5"
                                    name="partidoCanal5">
                                    <option value="">Ninguno</option>
                                    <?php
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option value="<?= $fuente['fuenteId'] ?>">
                                            <?= $fuente['fuenteNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal6" class="form-label">Canal 6</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal6"
                                    name="partidoCanal6">
                                    <option value="">Ninguno</option>
                                    <?php
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option value="<?= $fuente['fuenteId'] ?>">
                                            <?= $fuente['fuenteNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal7" class="form-label">Canal 7</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal7"
                                    name="partidoCanal7">
                                    <option value="">Ninguno</option>
                                    <?php
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option value="<?= $fuente['fuenteId'] ?>">
                                            <?= $fuente['fuenteNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal8" class="form-label">Canal 8</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal8"
                                    name="partidoCanal8">
                                    <option value="">Ninguno</option>
                                    <?php
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option value="<?= $fuente['fuenteId'] ?>">
                                            <?= $fuente['fuenteNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal9" class="form-label">Canal 9</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal9"
                                    name="partidoCanal9">
                                    <option value="">Ninguno</option>
                                    <?php
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option value="<?= $fuente['fuenteId'] ?>">
                                            <?= $fuente['fuenteNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal10" class="form-label">Canal 10</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal10"
                                    name="partidoCanal10">
                                    <option value="">Ninguno</option>
                                    <?php
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option value="<?= $fuente['fuenteId'] ?>">
                                            <?= $fuente['fuenteNombre'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CTA -->
                        <button type="button" id="agregar" name="agregar" class="btn btn-primary"
                            onclick="agregarPartido()">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>