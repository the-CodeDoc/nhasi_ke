<?php
session_start();
include("includes/db.php");
if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']=== true){

}else{
    header("Location: login.php");
    exit;
}
include("includes/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashmaster.css">
    <link rel="icon" href="img/logo_nust_png.png">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Students Examlog</title>
</head>
<body>
    <div class="container" style="width:100%; left: 0;">
<div class="main-content" style="margin:0 10% 0 7%;">
           <main>
            <div class="page-content">
            <div class="records table-responsive">
            <div class="record-header">
            <div class="add">
               <button onclick="printPage()">Print</button>
                   <script>
                      function printPage(){
                        window.print();
                         }
                   </script>
                        </div>
                        </div>
                <table width="100%">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Course Code:</th>
                            <th style="padding:10px";>Student ID:</th>
                            <th style="text-align: center;">TIME IN:</th>
                            <th style="text-align: center;">TIME OUT:</th>
                            <th style="text-align: center;">SIGNATURE:</th>
                            <th style="text-align: center;">Date:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           
                          // Connect to the database
                         $host = 'localhost';
                         $user = 'root';
                         $password = '';
                         $dbname = 'qrcode';

                         $conn = new mysqli($host, $user, $password, $dbname);

                         if ($conn->connect_error) {
                         die('Connection failed: ' . $conn->connect_error);
                         }

                         $sql = "SELECT * FROM exam_log WHERE student_id <> ''";                      
                         $result = mysqli_query($conn, $sql);
                         
                         if($result) {
                             while($row = mysqli_fetch_assoc($result)) {
                                 echo "<tr>";
                                 echo "<td>".$row['course_code']."</td>";
                                 echo "<td>".$row['student_id']."</td>";
                                 echo "<td>".$row['time_in']."</td>";
                                 echo "<td>".$row['time_out']."</td>";
                                 echo "<td><img src='data:image/jpeg;base64,".base64_encode($row['signature'])."' /></td>";
                                 echo "<td>".$row['date']."</td>";
                                 echo "</tr>";
                             }
                         } else {
                            echo "<script type='text/javascript'>alert('Error: " . mysqli_error($conn) . "');</script>";
                        }
                     ?>
                    </tbody>
                   </table>
                    </div>
                    
            </div>
        </main>   
     </div>  
     </div> 
</body>
</html>