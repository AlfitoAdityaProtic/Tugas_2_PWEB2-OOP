<?php 
require_once ('koneksi.php');
include('navbar.php');
class laporan extends database{
    public function __construct(){
        parent::__construct();
    }
    public function tampilDataReports(){
        $tampil = "SELECT * FROM reports";
        $result = $this->conn->query($tampil);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
}
$data = new laporan();
$db = $data->tampilDataReports();
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