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

// Query to count exams on the current date
$sqlCountExams = "SELECT COUNT(*) AS exam_count FROM exams WHERE DATE(date) = CURDATE()";
$resultCount = $conn->query($sqlCountExams);

$examCount = 0; // Default to 0 if no rows
if ($resultCount->num_rows > 0) {
    $row = $resultCount->fetch_assoc();
    $examCount = $row['exam_count'];
}

//Query to count Students that attended exam
$sqlCountAttendance = "SELECT COUNT(*) AS attendance_count FROM exam_log WHERE time_in <>''";
$resultAttend = $conn->query($sqlCountAttendance);

$attendanceCount = 0; // Default to 0 if no rows
if ($resultAttend->num_rows > 0) {
    $row = $resultAttend->fetch_assoc();
    $attendanceCount = $row['attendance_count'];
}

//Query to count Students remaining in exam room
$sqlCountRemaining = "SELECT COUNT(*) AS count_remaining FROM exam_log WHERE time_out ='' OR time_out IS NULL";
$resultRemain = $conn->query($sqlCountRemaining);

$sqlCountRemaining = 0; // Default to 0 if no rows
if ($resultRemain->num_rows > 0) {
    $row = $resultRemain->fetch_assoc();
    $CountRemaining = $row['count_remaining'];
}
?>

<body>
    <div class="main-content">
        <main>

            <div class="page-header">
                <h1>Exam Dashboard</h1>
                <small>Home / Dashboard</small>
            </div>

            <div class="page-content">

                <div class="analytics">

                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo $examCount; ?></h2>
                            <span class="material-icons-sharp">receipt_long</span>
                        </div>
                        <div class="card-progress">
                            <small>Exams Today</small>
                            <div class="card-indicator">
                                <div class="indicator one" style="width: 60%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo $attendanceCount; ?></h2>
                            <span class="las la-user-friends"></span>
                        </div>
                        <div class="card-progress">
                            <small>Total Attendance</small>
                            <div class="card-indicator">
                                <div class="indicator two" style="width: 80%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo $CountRemaining; ?></h2>
                            <span class="las la-user-friends"></span>
                        </div>
                        <div class="card-progress">
                            <small>Students Remaining</small>
                            <div class="card-indicator">
                                <div class="indicator three" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="records table-responsive">

                    <div class="record-header">
                        <h1>Exams Today</h1>
                    </div>

                    <div>
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">DATE</th>
                                    <th style="text-align:center;">TIME</th>
                                    <th style="text-align:center;">COURSE TITLE</th>
                                    <th style="text-align:center;">NO. OF STUDENTS</th>
                                    <th style="text-align:center;">VENUE</th>
                                    <th style="text-align:center;">SPECIAL REQUIREMENTS </th>
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
                                //Query for data collection
                                $sql = "SELECT invigilator, course_code ,session FROM exams WHERE DATE(date) = CURDATE()";
                                $result = $conn->query($sql);

                                //Display results
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
        <td  style='text-align:center;'>" . $row['invigilator'] . "</td>
        <td  style='text-align:center;'>" . $row['course_code'] . "</td>
        <td  style='text-align:center;'>" . $row['session'] . "</td>
        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='3' style='text-align:center;'>No Invigilators in Exam</tr></td>";
                                }
                                echo "</table>";

                                // Close connection
                                $conn = null;
                                ?>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </main>

    </div>
    <!--<footer>
      <p>NUST, Copyright &copy; 2024</p>
    </footer>-->
</body>