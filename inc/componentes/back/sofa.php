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

if ($apiLeague):
    // Season Info
    $apiSeason = "https://api.sofascore.com/api/v1/unique-tournament/" . $apiLeague . "/seasons";
    $data = file_get_contents($apiSeason);
    $jsonData = json_decode($data, true);
    $seasonId = $jsonData['seasons'][0]['id'];

    // Games Info
    $apiUrl = "https://api.sofascore.com/api/v1/unique-tournament/" . $apiLeague . "/season/" . $seasonId . "/events/next/0";
    $data = file_get_contents($apiUrl);
    if (!$data) {
        $apiUrl = "https://api.sofascore.com/api/v1/unique-tournament/" . $apiLeague . "/season/" . $seasonId . "/events/last/0";
        $data = file_get_contents($apiUrl);
    }
    $jsonData = json_decode($data, true);

    // Recorrer Data y guardar en DB
    foreach ($jsonData['events'] as $event) {
        // Country Info
        $country = $event['tournament']['uniqueTournament']['category']['slug'];

        // Verificar si el país ya existe
        $query = "SELECT * FROM `paises` WHERE `paisCodigo` = '$country'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            // Si no existe, insertar
            $country_insert = "INSERT INTO `paises`(`paisCodigo`, `paisNombre`) VALUES ('$country', '$country')";
            mysqli_query($conn, $country_insert);
        }

        // Tournament Info
        $tournament_id = $event['tournament']['uniqueTournament']['id'];
        $tournament_name = $event['tournament']['name'];
        $tournament_name = str_replace("'", "", $tournament_name);
        $tournament_sname = $event['tournament']['slug'];

        // Verificar si la liga ya existe
        $query = "SELECT * FROM `ligas` WHERE `ligaId` = $tournament_id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            // Volcado base de datos
            $tournament_insert = "INSERT INTO `ligas`(`ligaId`, `ligaNombre`, `ligaImg`, `ligaPais`, `season`) VALUES ($tournament_id, '$tournament_name', '$tournament_sname', '$country', '$seasonId')";
            mysqli_query($conn, $tournament_insert);

            // Obtener y guardar la imagen de la liga si no existe
            $ligaImgPath = "../../../../assets/img/ligas/sf/{$tournament_id}.png";
            $ligaImgPathDark = "../../../../assets/img/ligas/sf/dark/{$tournament_id}.png";
            if (!file_exists($ligaImgPath)) {
                $ligaImgUrl = "https://api.sofascore.app/api/v1/unique-tournament/{$tournament_id}/image";
                $ligaImg = file_get_contents($ligaImgUrl);
                file_put_contents($ligaImgPath, $ligaImg);
            }
            if (!file_exists($ligaImgPathDark)) {
                $ligaImgUrlDark = "https://api.sofascore.app/api/v1/unique-tournament/{$tournament_id}/image/dark";
                $ligaImgDark = file_get_contents($ligaImgUrlDark);
                file_put_contents($ligaImgPathDark, $ligaImgDark);
            }
        }

        // Teams Info
        $home_id = $event['homeTeam']['id'];
        $home_name = $event['homeTeam']['name'];
        $home_sname = $event['homeTeam']['shortName'];
        $home_name = str_replace("'", "", $home_name);

        // Verificar si el equipo local ya existe
        $query = "SELECT * FROM `equipos` WHERE `equipoId` = $home_id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            $home_insert = "INSERT INTO `equipos`(`equipoId`, `equipoNombre`, `equipoImg`, `equipoLiga`) VALUES ($home_id, '$home_name', null, $tournament_id)";
            mysqli_query($conn, $home_insert);

            // Obtener y guardar la imagen del equipo local si no existe
            $homeImgPath = "../../../../assets/img/equipos/sf/{$home_id}.png";
            if (!file_exists($homeImgPath)) {
                $homeImgUrl = "https://api.sofascore.app/api/v1/team/{$home_id}/image";
                $homeImg = file_get_contents($homeImgUrl);
                file_put_contents($homeImgPath, $homeImg);
            }
        }

        $away_id = $event['awayTeam']['id'];
        $away_name = $event['awayTeam']['name'];
        $away_sname = $event['awayTeam']['shortName'];
        $away_name = str_replace("'", "", $away_name);

        // Verificar si el equipo visitante ya existe
        $query = "SELECT * FROM `equipos` WHERE `equipoId` = $away_id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            $away_insert = "INSERT INTO `equipos`(`equipoId`, `equipoNombre`, `equipoImg`, `equipoLiga`) VALUES ($away_id, '$away_name', null, $tournament_id)";
            mysqli_query($conn, $away_insert);

            // Obtener y guardar la imagen del equipo visitante si no existe
            $awayImgPath = "../../../../assets/img/equipos/sf/{$away_id}.png";
            if (!file_exists($awayImgPath)) {
                $awayImgUrl = "https://api.sofascore.app/api/v1/team/{$away_id}/image";
                $awayImg = file_get_contents($awayImgUrl);
                file_put_contents($awayImgPath, $awayImg);
            }
        }

        // Game Info
        $i++;
        $game_id = $event['id'];
        date_default_timezone_set('Europe/Madrid');
        $date = date('Y-m-d H:i:s', $event['startTimestamp']);

        // Verificar si el partido ya existe
        $query = "SELECT * FROM `partidos` WHERE `id` = $game_id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            // Canales por defecto por liga
            switch ($tournament_id) {
                case 8:
                    $game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`, `canal3`) VALUES ($game_id, $home_id, $away_id, $tournament_id, '$date', '$sport', '314')";
                    break;
                case 54:
                    $game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`, `canal1`, `canal2`, `canal3`, `canal4`, `canal5`) VALUES ($game_id, $home_id, $away_id, $tournament_id, '$date', '$sport', '32', '33', '34', '35', '36')";
                    break;
                case 11535: case 11542:
                    $game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`, `canal1`) VALUES ($game_id, $home_id, $away_id, $tournament_id, '$date', '$sport', '332')";
                    break;
                case 7: case 679:
                    $game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`, `starp`, `vix`) VALUES ($game_id, $home_id, $away_id, $tournament_id, '$date', '$sport', '1', '1')";
                    break;
                case 17015: case 17: case 23: case 35: case 278: 
                    $game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`, `starp`) VALUES ($game_id, $home_id, $away_id, $tournament_id, '$date', '$sport', '1')";
                    break;
                case 11621: case 325: case 11536: case 11539: case 13475: case 279:
                    $game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`, `vix`) VALUES ($game_id, $home_id, $away_id, $tournament_id, '$date', '$sport', '1')";
                    break;
                case 36:
                    $game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`)
                    SELECT $game_id, $home_id, $away_id, $tournament_id, '$date', '$sport'
                    FROM dual
                    WHERE $home_id IN(2351, 2352) OR $away_id IN(2351, 2532)";
                    break;
                default:
                    $game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`) VALUES ($game_id, $home_id, $away_id, $tournament_id, '$date', '$sport')";
                    break;
            }

            // Tennis
            if ($sport == "tennis") {
                $game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`, `canal1`, `canal2`, `canal3`, `canal4`, `canal5`, `canal6`, `canal7`, starp) VALUES ($game_id, $home_id, $away_id, $tournament_id, '$date', '$sport', '49', '90', '314','315','144','145','146','1')";
            }

            mysqli_query($conn, $game_insert);
        }
    }

    if ($i > 0) {
        echo "Se agregaron " . $i . " partidos de " . $tournament_name;
    } else {
        echo "No se agregaron partidos nuevos.";
    }

endif;
?>
