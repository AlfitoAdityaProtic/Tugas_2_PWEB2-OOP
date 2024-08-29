<?php 
// pembuatan class database dan menghubungkan database
class Database{
    private $host = "localhost";
    private $user ="root";
    private $pass = "";
    private $db = "siwali-jkb";
    protected $conn;

  public function __construct (){
    $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
    if($this->conn->connect_error){
        die("Koneksi Database Gagal : " . $this->conn->connect_error);
    }
  }
  public function __destruct(){
    $this->conn->close();
  }
}
// pembuatan class Withdrawals yang mewarisi class database proses inheritance
class Withdrawals extends database{
  public function __construct() {
      parent::__construct();
  }
  // method yang menampilkan tabel student_withdrawals
  public function tampilData() {
      $sql = "SELECT * FROM student_withdrawals";
      $result = $this->conn->query($sql);
      return $result->fetch_all(MYSQLI_ASSOC);
  }
}

?>