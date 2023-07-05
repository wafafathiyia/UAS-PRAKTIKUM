<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-AllowHeaders, Authorization, X-Requested-With");
include_once '../../config/databaseair.php';
include_once '../../models/denizens.php';
$database = new Database();
$db = $database->getConnection();

    if(isset($_GET['id'])){ //cek id
        $item = new denizen($db);
        $item->id = isset($_GET['id']) ? $_GET['id'] : die();
    
        $item->getSingledenizen();
        if($item->nama != null){
        // create array
        $den_arr = array(
            "id" => $item->id,
            "nama" => $item->nama,
            "bulan" => $item->bulan,
            "tahun" => $item->tahun,
            "pemakaian" => $item->pemakaian,
            "tagihan" => $item->tagihan
        );
       
        http_response_code(200);
        echo json_encode($den_arr);
    }
    else{
        http_response_code(404);
        echo json_encode("denizen not found.");
        }
     }
     else {
            $items = new denizen($db);
            $stmt = $items->getdenizens();
            $itemCount = $stmt->rowCount();
        
            //echo json_encode($itemCount);
            if($itemCount > 0){
        
            $denizenArr = array();
            $denizenArr["body"] = array();
            $denizenArr["itemCount"] = $itemCount;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $d = array(
                    "id" => $id,
                    "nama" => $nama,
                    "bulan" => $bulan,
                    "tahun" => $tahun,
                    "pemakaian" => $pemakaian,  
                    "tagihan" => $tagihan
                );
                array_push($denizenArr["body"], $d);
            }
            echo json_encode($denizenArr);
        }
        else{
            http_response_code(404);
            echo json_encode(
                 array("message" => "No record found.")
            );
}
}
   ?>