<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../../config/databaseair.php';
    include_once '../../models/denizens.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new denizen($db);
    $data = json_decode(file_get_contents("php://input"));
    $item->nama = $data->nama;
    $item->bulan = $data->bulan;
    // $item->tahun = $data->tahun;
    $item->pemakaian = $data->pemakaian;
    $item->tagihan = $data->tagihan;
    
    if($item->createdenizen()){
        echo json_encode(['message'=>'denizen created successfully.']);
    } else{
        echo json_encode(['message'=>'denizen could not be created.']);
    }
?>
