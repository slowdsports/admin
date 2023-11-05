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
                                <li class="breadcrumb-item active">Canales</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Canales</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <?php
            $consultaSQL = "SELECT canales.canalId, canales.canalNombre, canales.epg, canales.canalImg, canales.canalCategoria, fuentes.fuenteId, fuentes.fuenteNombre, fuentes.canal, fuentes.canalUrl, fuentes.key, fuentes.key2, fuentes.pais, fuentes.tipo, categorias.categoriaNombre
            FROM canales
            INNER JOIN fuentes ON canales.canalId = fuentes.canal
            INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId";
            if (isset($_GET['agregar'])) {
                include('inc/componentes/canales/agregar.php');
            } elseif (isset($_GET['editar'])) {
                $idEditar = mysqli_real_escape_string($conn, $_GET['editar']);
                $consultaSQL .= " WHERE fuenteId = '$idEditar'";
                $canales = mysqli_query($conn, $consultaSQL);
                $result = mysqli_fetch_array($canales);
                include('inc/componentes/canales/editar.php');
            } else {
                $consultaSQL .= " ORDER BY canalId ASC";
                $canales = mysqli_query($conn, $consultaSQL);
                include('inc/componentes/canales/mostrar.php');
            }
            ?>

        </div>
        <!-- container -->