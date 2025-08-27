<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');

if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    http_response_code(200);
    exit();
}

include("helper.php");

if($_SERVER['REQUEST_METHOD'] == 'PUT'){
    include("../../connect.php");

    if(isset($_GET['id'])){
        if($_GET['id'] != ""){
            $id = $_GET['id'];

            $search_id = $connect->query("SELECT * FROM peserta WHERE id='$id'");
            $user = $search_id->fetch_assoc();

            if($user == null){
                $array_api = response_json(404, "ID tidak ditemukan");
            }
            else{
                $input = json_decode(file_get_contents("php://input"));

                $nama = $input->nama;
                $kontak = $input->kontak;
                $angkatan = $input->angkatan;
                $acara = $input->acara;
                $lokasi = $input->lokasi;
                $tanggal = $input->tanggal;
                $status = $input->status;

                if($nama == "" || $kontak == "" || $angkatan == "" || $acara == "" || $lokasi == "" || $tanggal == "" || $status == ""){
                    $array_api = response_json(400, "content tidak boleh kosong");
                }
                else{
                    $update = $connect->query("UPDATE peserta SET nama = '$nama', kontak = '$kontak', angkatan = '$angkatan', acara = '$acara', lokasi = '$lokasi', tanggal = '$tanggal', status = '$status' WHERE id='$id'");
                    $array_api = response_json(200, "Berhasil update data user!");
                }
            }
        }
        else{
            $array_api = response_json(400, "ID tidak boleh kosong");
        }
    }
    else{
        $array_api = response_json(400, "ID belum dimasukkan");
    }
}
else{
    $array_api = response_json(400, "Metode tidak diizinkan");
}

echo json_encode($array_api);

?>