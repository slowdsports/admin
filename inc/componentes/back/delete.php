<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../../../../inc/conn.php');
// Revisamos si hay formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Revisamos si lo que eliminaremos es un partido
    if (isset($_POST['partido'])){
        $id = $_POST["id"];
        $sql = "DELETE FROM `partidos` WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            echo "El juego " . $id . " ha sido eliminado correctamente";
        } else {
            echo "Ha ocurrido un error al eliminar el juego: " . mysqli_error($conn);
        }
        // Borrar partidos por Liga
    } elseif (isset($_POST['borrarPartidos'])) {
        $filtrarLiga = $_POST["filtrarLiga"];
        $sql = "DELETE FROM `partidos` WHERE liga=$filtrarLiga";
        if (mysqli_query($conn, $sql)) {
            echo "Los juegos de La liga " . $filtrarLiga . " han sido eliminados correctamente";
        } else {
            echo "Ha ocurrido un error al eliminar los juegos: " . mysqli_error($conn);
        }
        // Revisamos si lo que eliminaremos es una liga
    }
    // elseif (isset($_POST['liga'])) {
    //     $ligaId = ["id"];
    //     $sql = "DELETE FROM `ligas` WHERE ligaId=$ligaId";
    // }
}
mysqli_close($conn);
?>
