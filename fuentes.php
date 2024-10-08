<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="?p=home">Dashboard</a></li>
                                <li class="breadcrumb-item active">Fuentes</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Fuentes</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <?php
            if (isset($_GET['reportes'])) {
                $consultaSQL = "SELECT canales.canalId, canales.canalNombre, canales.canalImg, canales.canalCategoria, COUNT(reportes.id) AS totalReportes, MAX(reportes.fecha) AS ultimaFecha, fuentes.fuenteId, fuentes.fuenteNombre, categorias.categoriaNombre, fuentes.pais, paises.paisNombre
                FROM reportes
                INNER JOIN fuentes ON reportes.fuente = fuentes.fuenteId
                INNER JOIN canales ON fuentes.canal = canales.canalId
                INNER JOIN paises ON fuentes.pais = paises.paisId
                INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
                GROUP BY canales.canalId, canales.canalNombre, canales.canalImg, canales.canalCategoria, fuentes.fuenteId, fuentes.fuenteNombre, categorias.categoriaNombre, fuentes.pais, paises.paisNombre
                ORDER BY ultimaFecha DESC";
                $reportes = mysqli_query($conn, $consultaSQL);
                include('inc/componentes/fuentes/reportes.php');

            } else {
                $consultaSQL = "SELECT canales.canalId, canales.canalNombre, canales.epg, canales.canalImg, canales.canalCategoria, fuentes.fuenteId, fuentes.fuenteNombre, fuentes.canal, fuentes.canalUrl, fuentes.key, fuentes.key2, fuentes.comentario, fuentes.pais, fuentes.tipo, fuentes.status, categorias.categoriaNombre, paises.paisId, paises.paisNombre, paises.paisCodigo
                FROM fuentes
                INNER JOIN canales ON fuentes.canal = canales.canalId
                INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
                INNER JOIN paises ON fuentes.pais = paises.paisId";
                if (isset($_GET['agregar'])) {
                    include('inc/componentes/fuentes/agregar.php');
                } elseif (isset($_GET['editar'])) {
                    $idEditar = mysqli_real_escape_string($conn, $_GET['editar']);
                    $consultaSQL .= " WHERE fuenteId = '$idEditar'";
                    $canales = mysqli_query($conn, $consultaSQL);
                    $result = mysqli_fetch_array($canales);
                    include('inc/componentes/fuentes/editar.php');
                } else {
                    $consultaSQL .= " ORDER BY fuenteId ASC";
                    $canales = mysqli_query($conn, $consultaSQL);
                    include('inc/componentes/fuentes/mostrar.php');
                }
            }
            ?>

        </div>
        <!-- container -->
