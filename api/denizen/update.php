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
    
    $denizen = new denizen($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $denizen->id = $data->id;
    
    // Employee values
    $denizen->nama = $data->nama;
    $denizen->bulan = $data->bulan;
    // $denizen->tahun = $data->tahun;
    $denizen->pemakaian = $data->pemakaian;
    $denizen->tagihan = $data->tagihan;
    
    if ($denizen->updateDenizen()) {
        echo json_encode(['message' => 'Denizen updated successfully.']);
    } else {
        echo json_encode(['message' => 'Denizen could not be updated.']);
    }
?>