<?php

header('Content-Type: application/json');

include("helper.php");

if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    include("../../connect.php");

    if(isset($_GET['id'])){
        if($_GET['id'] != ""){
            $id = $_GET['id'];
            $search_id = $connect->query("SELECT * FROM peserta WHERE id='$id'");
            $user = $search_id->fetch_assoc();

            if($user != NULL){
                $delete = $connect->query("DELETE FROM peserta WHERE id='$id'");
        
                $array_api = response_json(200, "Berhasil menghapus data user!");
            
            }
            else{
                $array_api = response_json(404, "ID user tidak ditemukan");
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