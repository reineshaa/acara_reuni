<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');


include("helper.php");

if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    http_response_code(200);
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include("../../connect.php");

    $input = json_decode(file_get_contents("php://input"));
    $nama = $input->nama;
    $kontak = $input->kontak;
    $angkatan = $input->angkatan;
    $acara = $input->acara;
    $lokasi = $input->lokasi;
    $tanggal = $input->tanggal;
    $status = $input->status;
    
    if($input->nama != "" && $input->kontak != "" && $input->angkatan != "" && $input->acara != "" && $input->lokasi != "" && $input->tanggal != "" && $input->status != ""){

        $create = $connect->query("INSERT INTO peserta (nama, kontak, angkatan, acara, lokasi, tanggal, status) VALUES('$nama', '$kontak', '$angkatan', '$acara', '$lokasi', '$tanggal', '$status')");
        $array_api = response_json(201, "Berhasil menambah data user!");
    }
    else{
        $array_api = response_json(400, "Gagal menambah data user, formulir tidak lengkap");
    }
}
else{
    $array_api = response_json(400, "Metode tidak diizinkan");
}

echo json_encode($array_api);
?>