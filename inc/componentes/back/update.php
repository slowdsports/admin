<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../../../../inc/conn.php');
// Revisamos si hay formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Partido
    if (isset($_POST['partido'])) {
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
        $hbom = $_POST["hbom"];
        // HBO MAX
        if ($hbom !== "" || $hbom !== null) {
            $verifq = mysqli_query($conn,"SELECT hboId, partido FROM hbom WHERE partido='$id'");
            $verif = mysqli_fetch_assoc($verifq);
            if ($verif && isset($verif['hboId']))  {
                // YA EXISTE
                $hbo = "UPDATE `hbom` SET `url`='$hbom' WHERE partido=$id";
            } else {
                // NO EXISTE
                $hbo = "INSERT INTO `hbom` SET `url`='$hbom', `partido`='$id'";
            }
            if (mysqli_query($conn, $hbo)) {
                echo "Se ha agregado HBO MAX al juego #" . $id ."";
            } else {
                echo "Ha ocurrido un error al agregar HBO: " . mysqli_error($conn);
            }
        } else {}
        $sql = "UPDATE `partidos` SET `local`='$local', `visitante`='$visitante', `liga`='$liga', `fecha_hora`='$fecha', `starp`='$starp',`vix`='$vix', `canal1`=$canal1, `canal2`=$canal2, `canal3`=$canal3, `canal4`=$canal4, `canal5`=$canal5, `canal6`=$canal6, `canal7`=$canal7, `canal8`=$canal8, `canal9`=$canal9, `canal10`=$canal10 WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            echo "El juego #" . $id . " ha sido modificado satisfactoriamente";
        } else {
            echo "Ha ocurrido un error al editar el juego: " . mysqli_error($conn);
        }
    } // Canales
    elseif (isset($_POST['canales'])) {
        $id = $_POST["id"];
        $cNombre = $_POST["canalNombre"];
        $cImg = $_POST["canalImagen"];
        $cCategoria = $_POST["canalCategoria"];
        $starp = $_POST["starp"];
        $vix = $_POST["vix"];
        $hbom = $_POST["hbom"];
        $sql = "UPDATE `canales` SET `canalNombre`='$cNombre', `canalImg`='$cImg', `canalCategoria`='$cCategoria' WHERE canalId=$id";
        if (mysqli_query($conn, $sql)) {
            echo "El canal #" . $id . " ha sido modificado satisfactoriamente";
        } else {
            echo "Ha ocurrido un error al editar el canal: " . mysqli_error($conn);
        }
    } // Fuentes
    elseif (isset($_POST['fuentes'])) {
        $id = $_POST["id"];
        $fNombre = $_POST["fuenteNombre"];
        $cPadre = $_POST["canalPadre"];
        $fUrl = $_POST["fuenteUrl"];
        $key1 = $_POST["key1"];
        $key2 = $_POST["key2"];
        $pais = $_POST["pais"];
        $tipo = $_POST["tipo"];
        $sql = "UPDATE `fuentes` SET `fuenteId`='$id', `fuenteNombre`='$fNombre', `canal`='$cPadre', `canalUrl`='$fUrl', `key`='$key1', `key2`='$key2', `pais`='$pais', `tipo`='$tipo' WHERE fuenteId=$id";
        if (mysqli_query($conn, $sql)) {
            echo "La fuente " . $fNombre . " ha sido modificada satisfactoriamente";
        } else {
            echo "Error " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
