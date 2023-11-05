<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../../../../inc/conn.php');
// Revisamos si hay formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $local = $_POST["equipoLocal"];
    $visitante = $_POST["equipoVisitante"];
    $liga = $_POST["equipoLiga"];
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
    $starp = $_POST["starp"];
    $sql = "UPDATE `partidos` SET `local`='$local', `visitante`='$visitante', `liga`='$liga', `fecha_hora`='$fecha', `starp`='$starp',`vix`='$vix', `canal1`=$canal1, `canal2`=$canal2, `canal3`=$canal3, `canal4`=$canal4, `canal5`=$canal5, `canal6`=$canal6, `canal7`=$canal7, `canal8`=$canal8, `canal9`=$canal9, `canal10`=$canal10 WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "El juego #" . $id . " ha sido modificado satisfactoriamente";
    } else {
        echo "Ha ocurrido un error al editar el juego: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
