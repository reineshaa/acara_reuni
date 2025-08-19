<?php

header('Content-Type: application/json');
include("helper.php");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include("../../connect.php");

    $read = $connect->query("SELECT * FROM peserta");
    $result = $read->fetch_all(MYSQLI_ASSOC);

    $array_api = response_json(200, "Berhasil mengambil data user", $result);
}
else{
    http_response_code(405);

    $array_api = response_json(405, "Metode tidak diizinkan");
}

echo json_encode($array_api);

?>