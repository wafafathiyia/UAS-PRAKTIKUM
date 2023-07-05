<?php
    class denizen{
        // Connection
        private $conn;
        // Table
        private $db_table = "denizen";
        // Columns
        public $id;
        public $nama;
    public $bulan;
    public $tahun;
    public $pemakaian;
    public $tagihan;
    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }
    // GET ALL
    public function getdenizens(){
        $sqlQuery = "SELECT id, nama, bulan, tahun, pemakaian, tagihan FROM " . $this->db_table;

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    // CREATE
    public function createdenizen(){
        $sqlQuery = "INSERT INTO
                    ". $this->db_table ."
                 SET
                    nama = :nama,
                    bulan = :bulan,
                    tahun = :tahun,
                    pemakaian = :pemakaian,
                    tagihan = :tagihan";
    $stmt = $this->conn->prepare($sqlQuery);

    // sanitize
    $this->nama=htmlspecialchars(strip_tags($this->nama));
    $this->bulan=htmlspecialchars(strip_tags($this->bulan));
    $this->tahun=htmlspecialchars(strip_tags($this->tahun));
    $this->pemakaian=htmlspecialchars(strip_tags($this->pemakaian));
    $this->tagihan=htmlspecialchars(strip_tags($this->tagihan));

    // bind data
    $stmt->bindParam(":nama", $this->nama);
    $stmt->bindParam(":bulan", $this->bulan);
    $stmt->bindParam(":tahun", $this->tahun);
    $stmt->bindParam(":pemakaian", $this->pemakaian);
    $stmt->bindParam(":tagihan", $this->tagihan);
    
    if($stmt->execute()){
        return true;
}
return false;
}
// READ single
public function getSingledenizen(){
    $sqlQuery = "SELECT
                id,
                nama,
                bulan,
                tahun,
                pemakaian,
                tagihan
            FROM
                ". $this->db_table ."
                WHERE
                    id = ?
                LIMIT 0,1";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $this->nama = $dataRow['nama'];
    $this->bulan = $dataRow['bulan'];
    $this->tahun = $dataRow['tahun'];
    $this->pemakaian = $dataRow['pemakaian'];
    $this->tagihan = $dataRow['tagihan'];
}
// UPDATE
public function updatedenizen(){
    $sqlQuery = "UPDATE
                ". $this->db_table ."
            SET
                nama = :nama,
                bulan = :bulan,
                tahun = :tahun,
                pemakaian = :pemakaian,
                tagihan = :tagihan
            WHERE
                id = :id";
            $stmt = $this->conn->prepare($sqlQuery);
            
            $this->nama=htmlspecialchars(strip_tags($this->nama));
            $this->bulan=htmlspecialchars(strip_tags($this->bulan));
            $this->tahun=htmlspecialchars(strip_tags($this->tahun));
            $this->pemakaian=htmlspecialchars(strip_tags($this->pemakaian));
            $this->tagihan=htmlspecialchars(strip_tags($this->tagihan));
            $this->id=htmlspecialchars(strip_tags($this->id));

            // bind data
            $stmt->bindParam(":nama", $this->nama);
            $stmt->bindParam(":bulan", $this->bulan);
            $stmt->bindParam(":tahun", $this->tahun);
            $stmt->bindParam(":pemakaian", $this->pemakaian);
            $stmt->bindParam(":tagihan", $this->tagihan);
            $stmt->bindParam(":id", $this->id);

            if($stmt->execute()){
             return true;
            }
            return false;
}
// DELETE
function deletedenizen(){
    $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id=htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
        }
}
?>
