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
    // https://api.sofascore.com/api/v1/unique-tournament/270/seasons
    $data = file_get_contents($apiSeason);
    $jsonData = json_decode($data, true);
    $seasonId = $jsonData['seasons'][0]['id'];
    // Games Info
    $apiUrl = "https://api.sofascore.com/api/v1/unique-tournament/" . $apiLeague . "/season/" . $seasonId . "/events/next/0";
    $data = file_get_contents($apiUrl);
    if (!$data) {
        $apiUrl = "https://api.sofascore.com/api/v1/unique-tournament/" . $apiLeague . "/season/" . $seasonId . "/events/last/0";
    }
    $jsonData = json_decode($data, true);
    // Recorrer Data y guardar en DB
    foreach ($jsonData['events'] as $event) {
        // Country Info
        $country = $event['tournament']['uniqueTournament']['category']['slug'];
        $country_insert = "INSERT INTO `paises`(`paisCodigo`, `paisNombre`) VALUES ('$country', '$country')";
        mysqli_query($conn, $country_insert);
        $country = $event['tournament']['uniqueTournament']['category']['slug'];
        // Tournament Info
        $tournament_id = $event['tournament']['uniqueTournament']['id'];
        $tournament_name = $event['tournament']['name'];
        $tournament_sname = $event['tournament']['slug'];
        $sport_id = $event['tournament']['uniqueTournament']['category']['sport']['id'];
        $sport = $event['tournament']['uniqueTournament']['category']['sport']['slug'];
        // Volcado base de datos
        $tournament_insert = "INSERT INTO `ligas`(`ligaId`, `ligaNombre`, `ligaImg`, `ligaPais`, `season`) VALUES ($tournament_id, '$tournament_name', '$tournament_sname', '$country', '$seasonId')";
        mysqli_query($conn, $tournament_insert);
        // Teams Info
        $home_id = $event['homeTeam']['id'];
        $home_name = $event['homeTeam']['name'];
        $home_sname = $event['homeTeam']['shortName'];
        $home_insert = "INSERT INTO `equipos`(`equipoId`, `equipoNombre`, `equipoImg`, `equipoLiga`) VALUES ($home_id, '$home_name', null, $tournament_id)";
        mysqli_query($conn, $home_insert);
        $away_id = $event['awayTeam']['id'];
        $away_name = $event['awayTeam']['name'];
        $away_sname = $event['awayTeam']['shortName'];
        $home_name = str_replace("'", "", $home_name);
        $away_name = str_replace("'", "", $away_name);
        $away_insert = "INSERT INTO `equipos`(`equipoId`, `equipoNombre`, `equipoImg`, `equipoLiga`) VALUES ($away_id, '$away_name', null, $tournament_id)";
        mysqli_query($conn, $away_insert);
        // Game Info
        $i++;
        $game_id = $event['id'];
        $date = date('Y-m-d H:i:s', $event['startTimestamp']);
        // Canales por defecto por liga
        // Liga PRO [Ecuador]
        switch ($tournament_id) {
            // Liga Costa Rica (FUTV)
            case 11535:
                $game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`, `canal1`) VALUES ($game_id, $home_id, $away_id, $tournament_id, '$date', '$sport', '248')";
            break;
            // Primera Uruguay (VTV, VTV+)
            case 278:
                $game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`, `canal1`, `canal2`, `starp`) VALUES ($game_id, $home_id, $away_id, $tournament_id, '$date', '$sport', '346', '356', '1')";
            break;
            // Liga Guate (Canal 7)
            case 11619:
                $game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`, `canal1`) VALUES ($game_id, $home_id, $away_id, $tournament_id, '$date', '$sport', '178')";
            break;
            // UCL + UEL (Star + Vix)
            case 7: case 679:
                $game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`, `starp`, `vix`) VALUES ($game_id, $home_id, $away_id, $tournament_id, '$date', '$sport', '1', '1')";
            break;
            // Conference + Premier + Serie A + Bundesliga (Star)
            case 17015: case 17: case 23: case 35: 
                $game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`, `starp`) VALUES ($game_id, $home_id, $away_id, $tournament_id, '$date', '$sport', '1')";
            break;
            // Liga MX + Brasileirao + Betplay + Copa de La Liga + FIFA WC u17 (Vix)
            case 11621: case 325: case 11536: case 13475: case 279:
                $game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`, `vix`) VALUES ($game_id, $home_id, $away_id, $tournament_id, '$date', '$sport', '1')";
            break;
            // Celtic & Rangers
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
            $game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`, `canal1`, `canal2`, `canal3`, `canal4`, `canal5`, `canal6`, `canal7`, `canal8`, `canal9`, starp) VALUES ($game_id, $home_id, $away_id, $tournament_id, '$date', '$sport', '227', '228', '80','185','186','187','31','106','222','1')";
        }
        //$game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`) VALUES ($game_id, $home_id, $away_id, $tournament_id, '$date', '$sport')";
        mysqli_query($conn, $game_insert);
    }
    if ($game_insert) {
        echo "Se agregaron " . $i . " partidos de " . $tournament_name;
    } else {
        echo "Error al agregar los partidos: " . mysqli_error($conn);
    }
endif;
?>