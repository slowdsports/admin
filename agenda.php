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
                                <li class="breadcrumb-item"><a href="?p=agenda">Dashboard</a></li>
                                <li class="breadcrumb-item active">Agenda</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Agenda</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <?php
            $consultaSQL = "SELECT p.id, p.local, p.visitante, p.liga, p.fecha_hora, p.tipo, p.starp, p.vix, 
            e1.equipoId AS id_local, e1.equipoNombre AS equipo_local,
            e2.equipoId AS id_visitante, e2.equipoNombre AS equipo_visitante,
            e3.ligaNombre AS partido_liga,
            f1.fuenteId AS id_canal1, f1.fuenteNombre AS nombre_canal1, f1.canal AS canal_canal1,
            p1.paisNombre AS pais_canal1,
            f2.fuenteId AS id_canal2, f2.fuenteNombre AS nombre_canal2, f2.canal AS canal_canal2,
            p2.paisNombre AS pais_canal2,
            f3.fuenteId AS id_canal3, f3.fuenteNombre AS nombre_canal3, f3.canal AS canal_canal3,
            p3.paisNombre AS pais_canal3,
            f4.fuenteId AS id_canal4, f4.fuenteNombre AS nombre_canal4, f4.canal AS canal_canal4,
            p4.paisNombre AS pais_canal4,
            f5.fuenteId AS id_canal5, f5.fuenteNombre AS nombre_canal5, f5.canal AS canal_canal5,
            p5.paisNombre AS pais_canal5,
            f6.fuenteId AS id_canal6, f6.fuenteNombre AS nombre_canal6, f6.canal AS canal_canal6,
            p6.paisNombre AS pais_canal6,
            f7.fuenteId AS id_canal7, f7.fuenteNombre AS nombre_canal7, f7.canal AS canal_canal7,
            p7.paisNombre AS pais_canal7,
            f8.fuenteId AS id_canal8, f8.fuenteNombre AS nombre_canal8, f8.canal AS canal_canal8,
            p8.paisNombre AS pais_canal8,
            f9.fuenteId AS id_canal9, f9.fuenteNombre AS nombre_canal9, f9.canal AS canal_canal9,
            p9.paisNombre AS pais_canal9,
            f10.fuenteId AS id_canal10, f10.fuenteNombre AS nombre_canal10, f10.canal AS canal_canal10,
            p10.paisNombre AS pais_canal10
            FROM partidos p
            JOIN equipos e1 ON p.local = e1.equipoId
            JOIN equipos e2 ON p.visitante = e2.equipoId
            JOIN ligas e3 ON p.liga = e3.ligaId
            LEFT JOIN fuentes f1 ON p.canal1 = f1.fuenteId
            LEFT JOIN paises p1 ON f1.pais = p1.paisId
            LEFT JOIN fuentes f2 ON p.canal2 = f2.fuenteId
            LEFT JOIN paises p2 ON f2.pais = p2.paisId
            LEFT JOIN fuentes f3 ON p.canal3 = f3.fuenteId
            LEFT JOIN paises p3 ON f3.pais = p3.paisId
            LEFT JOIN fuentes f4 ON p.canal4 = f4.fuenteId
            LEFT JOIN paises p4 ON f4.pais = p4.paisId
            LEFT JOIN fuentes f5 ON p.canal5 = f5.fuenteId
            LEFT JOIN paises p5 ON f5.pais = p5.paisId
            LEFT JOIN fuentes f6 ON p.canal6 = f6.fuenteId
            LEFT JOIN paises p6 ON f6.pais = p6.paisId
            LEFT JOIN fuentes f7 ON p.canal7 = f7.fuenteId
            LEFT JOIN paises p7 ON f7.pais = p7.paisId
            LEFT JOIN fuentes f8 ON p.canal8 = f8.fuenteId
            LEFT JOIN paises p8 ON f8.pais = p8.paisId
            LEFT JOIN fuentes f9 ON p.canal9 = f9.fuenteId
            LEFT JOIN paises p9 ON f9.pais = p9.paisId
            LEFT JOIN fuentes f10 ON p.canal10 = f10.fuenteId
            LEFT JOIN paises p10 ON f10.pais = p10.paisId";
            if (isset($_GET['agregar'])) {
                include('inc/componentes/agenda/agregar.php');
            } elseif (isset($_GET['editar'])) {
                $idEditar = mysqli_real_escape_string($conn, $_GET['editar']);
                $consultaSQL .= " WHERE id = '$idEditar'";
                $partidos = mysqli_query($conn, $consultaSQL);
                $result = mysqli_fetch_array($partidos);
                include('inc/componentes/agenda/editar.php');
            } elseif (isset($_GET['tipo'])) {
                $idEditar = mysqli_real_escape_string($conn, $_GET['tipo']);
                $consultaSQL .= " WHERE p.tipo = '$idEditar'";
                $partidos = mysqli_query($conn, $consultaSQL);
                include('inc/componentes/agenda/mostrar.php');
            } else {
                // Filtrar por liga
                if (isset($_GET['filtrarLiga'])) {
                    $idEditar = mysqli_real_escape_string($conn, $_GET['filtrarLiga']);
                    $consultaSQL .= " WHERE liga= '$idEditar'";
                }
                $consultaSQL .= " ORDER BY fecha_hora ASC";
                $partidos = mysqli_query($conn, $consultaSQL);
                include('inc/componentes/agenda/mostrar.php');
            }
            ?>

        </div>
        <!-- container -->