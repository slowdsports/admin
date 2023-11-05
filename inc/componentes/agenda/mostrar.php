<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <div class="d-flex justify-content-start">
                            <form method="get">
                                <div class="form-group">
                                    <input type="hidden" name="p" value="agenda">
                                    <label for="filtrarLiga">Filtrar por Liga</label>
                                    <select id="filtrarLiga" name="filtrarLiga" class="form-control select2" data-toggle="select2">
                                    <?php
                                    $filtroLiga = $_GET['filtrarLiga'];
                                    $lgQuery = mysqli_query($conn, "SELECT * FROM ligas");
                                    while($league = mysqli_fetch_array($lgQuery)):
                                        // Teams
                                        $ligaId = $league['ligaId'];
                                        $ligaNombre = $league['ligaNombre'];
                                        $ligaPais = $league['ligaPais'];
                                        ?>
                                        <option
                                        value="<?= $ligaId ?>"
                                        <?= ($ligaId == $filtroLiga) ? "selected" : "" ?>>
                                            <?= $ligaNombre ?> (<?= $ligaPais ?>)
                                        </option>
                                    <?php endwhile; ?>
                                    </select>
                                    <div class="col-8">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            Filtrar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-end flex-wrap gap-2">
                            <button type="button" id="auto" class="btn btn-outline-success" data-id="<?=$filtroLiga?>" onclick="agregarPartidosAuto()">
                                <i class="ri-money-pound-circle-line me-1"></i>
                                Automático
                            </button>
                            <a href="?p=agenda&agregar" class="btn btn-outline-primary">
                                <i class="ri-paypal-line me-1"></i>
                                Manual
                            </a>
                            <button type="button" class="btn btn-outline-danger" id="borrarPartidos" data-id="<?=$filtroLiga?>" onclick="borrarPartidos()">
                                <i class="ri-equalizer-line me-1"></i>
                                Borrar
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Local</th>
                            <th>Visita</th>
                            <th>Liga</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        while ($result = mysqli_fetch_array($partidos)):
                            ?>
                            <tr id="partido-<?= $result['id'] ?>">
                                <td class="table-user">
                                    <img src="https://api.sofascore.app/api/v1/team/<?= $result['id_local']; ?>/image"
                                        alt="table-user" class="me-2 rounded-circle">
                                    <?= $result['equipo_local']; ?>
                                </td>
                                <td class="table-user">
                                    <img src="https://api.sofascore.app/api/v1/team/<?= $result['id_visitante']; ?>/image"
                                        alt="table-user" class="me-2 rounded-circle">
                                    <?= $result['equipo_visitante']; ?>
                                </td>
                                <td class="table-user">
                                    <img src="https://api.sofascore.app/api/v1/unique-tournament/<?= $result['liga']; ?>/image/dark"
                                        alt="table-user" class="me-2 rounded-circle">
                                    <?= $result['partido_liga']; ?>
                                </td>
                                <td>
                                    <?= $result['fecha_hora']; ?>
                                </td>
                                <td>
                                    <div class="btn-group mb-2">
                                        <a href="?p=agenda&editar=<?= $result['id'] ?>"
                                            class="btn btn-outline-primary">Editar</a>
                                        <button type="button" class="btn btn-outline-danger eliminarPartido"
                                            data-id="<?= $result['id'] ?>" onclick="eliminarPartido()">Borrar</button>
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