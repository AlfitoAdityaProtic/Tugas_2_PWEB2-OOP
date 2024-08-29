<?php 
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
?>