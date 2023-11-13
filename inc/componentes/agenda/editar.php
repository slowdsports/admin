<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">
                    Editar
                    <?= $result['equipo_local'] ?> vs.
                    <?= $result['equipo_visitante'] ?> de
                    <?= $result['partido_liga'] ?>
                </h4>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <!-- ID -->
                        <input type="hidden" name="partidoId" id="partidoId" value="<?=$result['id']?>">
                        <!-- LOCAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="equipoLocal" class="form-label">Equipo Local</label>
                                <select class="form-control select2" data-toggle="select2" id="equipoLocal" name="local">
                                    <?php
                                    //$equipos_query = "SELECT equipoId, equipoNombre FROM equipos WHERE equipoLiga = '" . mysqli_real_escape_string($conn, $result['liga']) . "'";
                                    $equipos_query = "SELECT equipoId, equipoNombre FROM equipos";
                                    $resultado_equipos = mysqli_query($conn, $equipos_query);
                                    while ($equipo = mysqli_fetch_assoc($resultado_equipos)):
                                        ?>
                                        <option
                                        value="<?= $equipo['equipoId'] ?>"
                                        <?= ($equipo['equipoId'] == $result['id_local']) ? "selected" : "" ?>>
                                            <?= $equipo['equipoNombre'] ?> (<?= $result['id_local'] ?>)
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
                                        <option
                                        value="<?= $equipo['equipoId'] ?>"
                                        <?= ($equipo['equipoId'] == $result['id_visitante']) ? "selected" : "" ?>>
                                            <?= $equipo['equipoNombre'] ?> (<?= $result['id_visitante'] ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- LIGA -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoLiga" class="form-label">Liga</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoLiga" name="partidoLiga">
                                    <?php
                                    $ligas_query = "SELECT * FROM ligas
                                    INNER JOIN paises ON ligas.ligaPais=paises.paisCodigo";
                                    $resultado_ligas = mysqli_query($conn, $ligas_query);
                                    while ($liga = mysqli_fetch_assoc($resultado_ligas)):
                                        ?>
                                        <option
                                        value="<?= $liga['ligaId'] ?>"
                                        <?= ($liga['ligaId'] == $result['liga']) ? "selected" : "" ?>>
                                            <?= $liga['ligaNombre'] ?> (<?= $liga['paisNombre'] ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- FECHA -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoFecha" class="form-label">Fecha</label>
                                <input
                                type="datetime-local"
                                id="partidoFecha"
                                name="partidoFecha"
                                value="<?=$result['fecha_hora']?>"
                                >
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
                                    <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="starp"
                                    name="starp"
                                    <?= ($result['starp'] == 1) ? "checked" : "" ?>>
                                    <label class="form-check-label" for="starp">Star +</label>
                                </div>
                            </div>
                        </div>
                        <!-- Vix+ -->
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="vix"
                                    name="vix"
                                    <?= ($result['vix'] == 1) ? "checked" : "" ?>>
                                    <label class="form-check-label" for="vix">Vix +</label>
                                </div>
                            </div>
                        </div>
                        <!-- HBO MAX -->
                        <div class="col-log-12">
                            <div class="mb-3">
                                <?php
                                $paramId = $_GET['editar'];
                                $hbo_query = "SELECT hboId, url, partido FROM hbom
                                WHERE partido='$paramId'";
                                $resultado_hbo = mysqli_query($conn, $hbo_query);
                                $hbom = mysqli_fetch_assoc($resultado_hbo)
                                ?>
                                <label for="hbom" class="form-label">HBO</label>
                                <textarea class="form-control" id="hbom" name="hbom" rows="5"> <?= (isset($hbom['url']) ? $hbom['url'] : NULL) ?></textarea>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal1" class="form-label">Canal 1</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal1" name="partidoCanal1">
                                    <option value="NULL">Ninguno</option>
                                    <?php
                                    $fuentes_query = "SELECT * FROM fuentes
                                    INNER JOIN paises ON fuentes.pais=paises.paisId";
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option
                                        value="<?= $fuente['fuenteId'] ?>"
                                        <?= ($fuente['fuenteId'] == $result['id_canal1']) ? "selected" : "" ?>>
                                            <?= $fuente['fuenteNombre'] ?> (<?= $fuente['paisNombre'] ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal2" class="form-label">Canal 2</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal2" name="partidoCanal2">
                                    <option value="NULL">Ninguno</option>
                                    <?php
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option
                                        value="<?= $fuente['fuenteId'] ?>"
                                        <?= ($fuente['fuenteId'] == $result['id_canal2']) ? "selected" : "" ?>>
                                            <?= $fuente['fuenteNombre'] ?> (<?= $fuente['paisNombre'] ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal3" class="form-label">Canal 3</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal3" name="partidoCanal3">
                                    <option value="NULL">Ninguno</option>
                                    <?php
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option
                                        value="<?= $fuente['fuenteId'] ?>"
                                        <?= ($fuente['fuenteId'] == $result['id_canal3']) ? "selected" : "" ?>>
                                            <?= $fuente['fuenteNombre'] ?> (<?= $fuente['paisNombre'] ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal4" class="form-label">Canal 4</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal4" name="partidoCanal4">
                                    <option value="NULL">Ninguno</option>
                                    <?php
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option
                                        value="<?= $fuente['fuenteId'] ?>"
                                        <?= ($fuente['fuenteId'] == $result['id_canal4']) ? "selected" : "" ?>>
                                            <?= $fuente['fuenteNombre'] ?> (<?= $fuente['paisNombre'] ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal5" class="form-label">Canal 5</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal5" name="partidoCanal5">
                                    <option value="NULL">Ninguno</option>
                                    <?php
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option
                                        value="<?= $fuente['fuenteId'] ?>"
                                        <?= ($fuente['fuenteId'] == $result['id_canal5']) ? "selected" : "" ?>>
                                            <?= $fuente['fuenteNombre'] ?> (<?= $fuente['paisNombre'] ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal6" class="form-label">Canal 6</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal6" name="partidoCanal6">
                                    <option value="NULL">Ninguno</option>
                                    <?php
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option
                                        value="<?= $fuente['fuenteId'] ?>"
                                        <?= ($fuente['fuenteId'] == $result['id_canal6']) ? "selected" : "" ?>>
                                            <?= $fuente['fuenteNombre'] ?> (<?= $fuente['paisNombre'] ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal7" class="form-label">Canal 7</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal7" name="partidoCanal7">
                                    <option value="NULL">Ninguno</option>
                                    <?php
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option
                                        value="<?= $fuente['fuenteId'] ?>"
                                        <?= ($fuente['fuenteId'] == $result['id_canal7']) ? "selected" : "" ?>>
                                            <?= $fuente['fuenteNombre'] ?> (<?= $fuente['paisNombre'] ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal8" class="form-label">Canal 8</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal8" name="partidoCanal8">
                                    <option value="NULL">Ninguno</option>
                                    <?php
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option
                                        value="<?= $fuente['fuenteId'] ?>"
                                        <?= ($fuente['fuenteId'] == $result['id_canal8']) ? "selected" : "" ?>>
                                            <?= $fuente['fuenteNombre'] ?> (<?= $fuente['paisNombre'] ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal9" class="form-label">Canal 9</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal9" name="partidoCanal9">
                                    <option value="NULL">Ninguno</option>
                                    <?php
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option
                                        value="<?= $fuente['fuenteId'] ?>"
                                        <?= ($fuente['fuenteId'] == $result['id_canal9']) ? "selected" : "" ?>>
                                            <?= $fuente['fuenteNombre'] ?> (<?= $fuente['paisNombre'] ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CANAL -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="partidoCanal10" class="form-label">Canal 10</label>
                                <select class="form-control select2" data-toggle="select2" id="partidoCanal10" name="partidoCanal10">
                                    <option value="NULL">Ninguno</option>
                                    <?php
                                    $resultado_fuentes = mysqli_query($conn, $fuentes_query);
                                    while ($fuente = mysqli_fetch_assoc($resultado_fuentes)):
                                        ?>
                                        <option
                                        value="<?= $fuente['fuenteId'] ?>"
                                        <?= ($fuente['fuenteId'] == $result['id_canal10']) ? "selected" : "" ?>>
                                            <?= $fuente['fuenteNombre'] ?> (<?= $fuente['paisNombre'] ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- CTA -->
                        <button id="edit" type="button" id="editar" name="editar" class="btn btn-primary" onclick="editarPartido()">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>