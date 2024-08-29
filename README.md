# Tugas_2_PWEB2-OOP
## Overview
Sistem Informasi Pembimbingan Akademik JKB (SIWALI JKB) adalah sistem manajemen pembimbingan akademik yang komprehensif yang dirancang untuk memperlancar proses pengelolaan kinerja mahasiswa, konseling, dan data akademik lainnya untuk institusi pendidikan tinggi.
## Features
### User Roles
Sistem ini mendukung empat peran pengguna yang berbeda:

1. Admin
2. Dosen Wali
3. Koordinator Program Studi
4. Mahasiswa
<br><br>
###  Role-Spesific Functionalities
Berikut adalah terjemahan dari informasi tersebut:<br><br>
1. Admin<br>
    + Dapat mengelola semua data dalam sistem, kecuali catatan kinerja mahasiswa dan sesi bimbingan.
    + Bertanggung jawab untuk manajemen pengguna, termasuk:
      - Membuat akun pengguna baru
      - Menetapkan peran (Dosen Wali, Koordinator Program Studi, atau Mahasiswa) kepada pengguna
2. Dosen Wali (Academic Advisor)<br>
    + Mengelola dan memasukkan IP semester (GPA) mahasiswa.
    + Mencatat mahasiswa yang telah mengundurkan diri (dropout) atau penerima beasiswa/tinjauan biaya kuliah (UKT) yang direvisi
    + Mencatat prestasi mahasiswa dan kegiatan organisasi
    + Mengelola catatan mahasiswa yang telah diberikan surat peringatan
    + Melacak tunggakan biaya kuliah
    + Melakukan bimbingan akademik secara daring (bimbingan perwalian)
3. Koordinator Program Studi (Program Coordinator)<br>
    + Menyetujui atau menolak laporan yang diajukan oleh Dosen Wali<br>
4. Mahasiswa (Student)<br>
    + Melihat IP semester (GPA) dan IPK (cumulative GPA)
    + Memasukkan prestasi mahasiswa dan kegiatan organisasi
    + Berpartisipasi dalam bimbingan akademik secara daring (bimbingan perwalian)

# ERD
![alt text](https://github.com/AlfitoAdityaProtic/Tugas_2_PWEB2-OOP/blob/main/asset/erd/erd.png?raw=true)
# Code 
1. koneksi.php <br><br>
    ```php
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
    ```
 <br><br>
2. Reports.php<br><br>
```php
   <?php 
require_once ('koneksi.php');
include('navbar.php');
class laporan extends database{
    public function __construct(){
        parent::__construct();
    }
    public function tampilData(){
        $tampil = "SELECT * FROM reports";
        $result = $this->conn->query($tampil);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
}
$data = new laporan();
$db = $data->tampilData();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>tampil Reports</title>
</head>
<body>
    <table style="font-family: verdana"  class="table table-bordered border-primary">
        <tr class="table-active table-success">
            <th class="text-center">No.</th>
			<th class="text-center">Id Reports</th>
			<th class="text-center">Id Warning</th>
			<th class="text-center">Id Gpas</th>
			<th class="text-center">Id Guidance</th>
			<th class="text-center">Id Achievements</th>
			<th class="text-center">Id Scholarship</th>
			<th class="text-center">Id Student Withdrawals</th>
			<th class="text-center">Id Tuition Arrears</th>
			<th class="text-center">Report Date</th>
			<th class="text-center">Status</th>
			<th class="text-center">Has Acc Academic Advisor</th>
			<th class="text-center">Has Acc Head Of Program</th>
        </tr>
        <?php
        $no =1;
        foreach($db as $row){
        ?>
        <tr>
            <td class="text-center"><?php echo $no++; ?></td>
            <td class="text-center"><?php echo $row['id_report']; ?></td>
            <td class="text-center"><?php echo $row['id_warnings']; ?></td>
            <td class="text-center"><?php echo $row['id_gpas']; ?></td>
            <td class="text-center"><?php echo $row['id_guidance']; ?></td>
            <td class="text-center"><?php echo $row['id_achievements']; ?></td>
            <td class="text-center"><?php echo $row['id_scholarship']; ?></td>
            <td class="text-center"><?php echo $row['id_student_withdrawals']; ?></td>
            <td class="text-center"><?php echo $row['id_tuition_arrears']; ?></td>
            <td class="text-center"><?php echo $row['report_date']; ?></td>
            <td class="text-center"><?php echo $row['status']; ?></td>
            <td class="text-center"><?php echo $row['has_acc_academic_advisor'] == 1?'Yes':'No' ?></td>
            <td class="text-center"><?php echo $row['has_acc_head_of_program'] == 1? "yes" : "no" ?></td>
        </tr>
        <?php 
        } 
        ?>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>    
```
<br><br>
3. Withdrawals.php <br><br>
```php
    <?php 
// menghubungkan ke database dan navbar
require_once('koneksi.php');
include('navbar.php');
// instansiasi objek
$data = new Withdrawals();
$a = $data->tampilData();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Withdrawals</title>
</head>
<body>
    <table style="font-family: verdana" class="table bg-blue">
        <tr class="table-active">
            <th class="text-center">No.</th>
            <th class="text-center">Id Student Withdrawals</th>
            <th class="text-center">Id Student</th>
            <th class="text-center">Withdrawal Type</th>
            <th class="text-center">Decree Number</th>
            <th class="text-center">Reason</th>
        </tr>
        <?php 
        $no = 1;
        foreach($a as $row){
            ?>
            <tr>
                <!-- membuat output dari database -->
                <td class="text-center"><?php echo $no++ ?></td>
                <td class="text-center"><?php echo $row['id_student_withdrawals'];?></td>
                <td class="text-center"><?php echo $row['id_student'];?></td>
                <td class="text-center"><?php echo $row['withdrawal_type'];?></td>
                <td class="text-center"><?php echo $row['decree_number'];?></td>
                <td class="text-center"><?php echo $row['reason'];?></td>
            </tr>
        <?php 
        }
        ?>
        
        
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
```
<br><br>
4. KoorProdi.php<br><br>
```php
    <?php 
// menghubungkan ke database dan navbar
require_once('koneksi.php');
require_once('navbar.php');
// membuat class KoorProdi yang mewarisi class Withdrawals
class KoorProdi extends Withdrawals{
    public function __construct() {
        parent::__construct();
    }
    // method yang menampilkan tabel student_withdrawals dengan syarat decree number = 300
    public function tampilData() {
        $sql = "SELECT * FROM student_withdrawals WHERE decree_number='300'";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
$data = new KoorProdi();
$a = $data->tampilData();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Withdrawals</title>
</head>
<body>
    <table style="font-family: verdana" class="table bg-blue">
        <tr class="table-active">
            <th class="text-center">No.</th>
            <th class="text-center">Id Student Withdrawals</th>
            <th class="text-center">Id Student</th>
            <th class="text-center">Withdrawal Type</th>
            <th class="text-center">Decree Number</th>
            <th class="text-center">Reason</th>
        </tr>
        <?php 
        $no = 1;
        foreach($a as $row){
            ?>
            <tr>
                <td class="text-center"><?php echo $no++ ?></td>
                <td class="text-center"><?php echo $row['id_student_withdrawals'];?></td>
                <td class="text-center"><?php echo $row['id_student'];?></td>
                <td class="text-center"><?php echo $row['withdrawal_type'];?></td>
                <td class="text-center"><?php echo $row['decree_number'];?></td>
                <td class="text-center"><?php echo $row['reason'];?></td>
            </tr>
        <?php 
        }
        ?>
        
        
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
```
<br><br>
5. WaliDosen.php <br><br>
```php
    <?php
// menghubungkan dengan file koneksi.php dan
require_once('koneksi.php');
require_once('navbar.php');
// membuat class DosenWali yang mewarisi class Withdrawals
class DosenWali extends Withdrawals{
    public function __construct() {
        parent::__construct();
    }
    // method yang menampilkan tabel student_withdrawals dengan syarat decree number = 100
    public function tampilData() {
        $sql = "SELECT * FROM student_withdrawals WHERE decree_number='100'";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
// instansiasi objek
$data = new DosenWali();
$a = $data->tampilData();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Withdrawals</title>
</head>
<body>
    <table style="font-family: verdana" class="table bg-blue">
        <tr class="table-active">
            <th class="text-center">No.</th>
            <th class="text-center">Id Student Withdrawals</th>
            <th class="text-center">Id Student</th>
            <th class="text-center">Withdrawal Type</th>
            <th class="text-center">Decree Number</th>
            <th class="text-center">Reason</th>
        </tr>
        <?php 
        $no = 1;
        foreach($a as $row){
            ?>
            <tr>
                <td class="text-center"><?php echo $no++ ?></td>
                <td class="text-center"><?php echo $row['id_student_withdrawals'];?></td>
                <td class="text-center"><?php echo $row['id_student'];?></td>
                <td class="text-center"><?php echo $row['withdrawal_type'];?></td>
                <td class="text-center"><?php echo $row['decree_number'];?></td>
                <td class="text-center"><?php echo $row['reason'];?></td>
            </tr>
        <?php 
        }
        ?>
        
        
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
```
<br><br>
6. Navbar.php <br><br>
```php
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title></title>
</head>
<body>
    <!-- hanya berisi navbar saja -->
<nav style="font-family: times-new-roman" class="navbar navbar-expand-lg bg-primary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tampil.php">Tampil Reports</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="WITHDRAWALS.PHP">Student Withdrawals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="waliDosen.PHP">Wali Dosen</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="KoorProdi.PHP">Koordinator Prodi</a>
        </li>
      </ul>
    </div>
  </div>
</nav><br><br>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
```
<br><br>

# Output
1. Tampil reports <br><br>
![alt text](https://github.com/AlfitoAdityaProtic/Tugas_2_PWEB2-OOP/blob/main/asset/output/tampil%20reports.png?raw=true) <br><br>
2. Tampil Student WithDrawal <br><br>
![alt text](https://github.com/AlfitoAdityaProtic/Tugas_2_PWEB2-OOP/blob/main/asset/output/tampil%20student%20withdrawal.png?raw=true) <br><br>
3. Tampil Wali Dosen <br><br>
![alt text](https://github.com/AlfitoAdityaProtic/Tugas_2_PWEB2-OOP/blob/main/asset/output/tampil%20walidosen.png?raw=true) <br><br>
4. Tampil Koordinator Program Studi <br><br>
![alt text](https://github.com/AlfitoAdityaProtic/Tugas_2_PWEB2-OOP/blob/main/asset/output/tampil%20prodi.png?raw=true) <br><br>

# Database
### Table Reports 
![alt text](https://github.com/AlfitoAdityaProtic/Tugas_2_PWEB2-OOP/blob/main/asset/database/Table%20Reports.png?raw=true)
### Table Student Withdrawal
![alt text](https://github.com/AlfitoAdityaProtic/Tugas_2_PWEB2-OOP/blob/main/asset/database/Table%20Student%20Withdrawal.png?raw=true)
# Installation
1. install csss bootstrap menggunakan cdn
```
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
```
2. install js bootstrap menggunakan cdn
```
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>   
```
# Contact
For any questions or concerns, please contact the project maintainers at :<br>
<br>
Email : alfitodwiaditya87@gmail.com <br>
Github : AlfitoAja
