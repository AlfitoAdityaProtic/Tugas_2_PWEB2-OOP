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