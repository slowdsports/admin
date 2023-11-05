<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../../../../inc/conn.php');
// Revisamos si hay formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Revisamos si lo que agregaremos es un partido
    if (isset($_POST['partido'])){
        $local = $_POST["equipoLocal"];
        $visitante = $_POST["equipoVisitante"];
        $liga = $_POST["equipoLiga"];
        $tipo = $_POST["partidoTipo"];
        $fecha = $_POST["partidoFecha"];
        $canal1 = $_POST["partidoCanal1"];
        $canal2 = $_POST["partidoCanal2"];
        $canal3 = $_POST["partidoCanal3"];
        $canal4 = $_POST["partidoCanal4"];
        $canal5 = $_POST["partidoCanal5"];
        $canal6 = $_POST["partidoCanal6"];
        $canal7 = $_POST["partidoCanal7"];
        $canal8 = $_POST["partidoCanal8"];
        $canal9 = $_POST["partidoCanal9"];
        $canal10 = $_POST["partidoCanal10"];
        $starp = $_POST["starp"];
        $vix = $_POST["vix"];
        $sql = "INSERT INTO `partidos`(`local`, `visitante`, `liga`, `fecha_hora`, `tipo`, `starp`, `vix`, `canal1`, `canal2`, `canal3`, `canal4`, `canal5`, `canal6`, `canal7`, `canal8`, `canal9`, `canal10`) VALUES ('$local','$visitante','$liga','$tipo','$fecha','$starp','$vix',$canal1,$canal2,$canal3,$canal4,$canal5,$canal6,$canal7,$canal8,$canal9,$canal10);";
        if (mysqli_query($conn, $sql)) {
            echo "El juego ha sido agregado correctamente";
        } else {
            echo "Ha ocurrido un error al agregar el juego: " . mysqli_error($conn);
        }
    }
    // Revisamos si lo que agregaremos es una liga
    elseif (isset($_POST['liga'])){
        $ligaId = $_POST["ligaId"];
        $ligaNombre = $_POST["ligaNombre"];
        $ligaImg = $_POST["ligaImg"];
        $ligaPais = $_POST["ligaPais"];
        $sql = "INSERT INTO `ligas`(`ligaId`, `ligaNombre`, `ligaImg`, `pais`) VALUES ('$ligaId','$ligaNombre','$ligaImg','$ligaPais');";
        if (mysqli_query($conn, $sql)) {
            echo "La liga ha sido agregada correctamente";
        } else {
            echo "Ha ocurrido un error al agregar la liga: " . mysqli_error($conn);
        }
    }
    // Revisamos si lo que agregaremos es un equipo
    elseif (isset($_POST['equipo'])) {
        $equipoId = $_POST['equipoId'];
        $equipoNombre = $_POST['equipoNombre'];
        $equipoImg = $_POST['equipoImg'];
        $equipoLiga = $_POST['equipoLiga'];
        $sql = "INSERT INTO `equipos`(`equipoId`, `equipoNombre`, `equipoImg`, `equipoLiga`) VALUES ('$equipoId','$equipoNombre','$equipoImg','$equipoLiga');";
        if (mysqli_query($conn, $sql)) {
            echo "El equipo ha sido agregado correctamente";
        } else {
            echo "Ha ocurrido un error al agregar el equipo: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
