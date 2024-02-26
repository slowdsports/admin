<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../../../../inc/conn.php');
if (!isset($_POST['filtrarLiga'])) {
    $apiLeague = $_GET['filtrarLiga'];
} else {
    $apiLeague = $_POST['filtrarLiga'];
}

$i = 0;
if ($apiLeague) {
    // Games Info
    $apiUrl = "https://api.sofascore.com/api/v1/stage/" . $apiLeague . "/substages";
    $data = file_get_contents($apiUrl);
    $jsonData = json_decode($data, true);

    // Verificamos si hay datos válidos obtenidos de la API
    if (isset($jsonData['stages']) && is_array($jsonData['stages'])) {
        foreach ($jsonData['stages'] as $stage) {
            // Aquí necesitas usar $stage en lugar de $event
            $i++;
            $id = $stage['id'];
            $tipo = $stage['uniqueStage']['category']['name'];
            $etapa = $stage['description'];
            $fecha = date('Y-m-d H:i:s', $stage['startDateTimestamp']);
            $ciudad = $stage['stageParent']['description'];
            // Realizar operaciones con $country si es necesario
            $game_insert = "INSERT INTO `motor`(`id`, `tipo`, `etapa`, `fecha_hora`, `ciudad`) VALUES ($id, $tipo, $etapa, $fecha, '$ciudad')";
            mysqli_query($conn, $game_insert);
        }
        if ($game_insert) {
            echo "Se agregaron " . $i . " carreras de " . $tipo;
        } else {
            echo "Error al agregar las carreras: " . mysqli_error($conn);
        }
    } else {
        echo "No se encontraron datos válidos para esa liga.";
    }
}