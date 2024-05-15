<?php

session_start();
include("includes/db.php");
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
} else {
    header("Location: login.php");
    exit;
}
include("includes/db.php");
include("includes/sidebar.php");
include("includes/header.php");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashmaster.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Exams</title>

    <style>
        .reminder-btn {
            background-color: #add8e6;
            /* Light blue background */
            color: white;
            /* Text color */
            font-family: Arial, sans-serif;
            /* Nice font */
            font-size: 14px;
            /* Font size */
            padding: 8px 16px;
            /* Padding */
            border: none;
            /* Remove border */
            border-radius: 4px;
            /* Rounded corners */
            cursor: pointer;
            /* Cursor style */
            transition: background-color 0.3s;
            /* Smooth transition */
        }

        .reminder-btn:hover {
            background-color: #5cadff;
            /* Darker blue on hover */
        }
    </style>
</head>

<body>
    <div class="main-content">
        <main>
            <div class="page-header">
                <h1>Exams</h1>
            </div>
            <div class="page-content">
                <div class="records table-responsive">
                    <div class="record-header">
                        <div class="add">
                            <a href="addexam.php"><button>Add Exam</button></a>
                            <div class="import">
                                <a href="addexam.php" style="margin-left:100%;"><button>Import Exam</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <table width="100%">
                    <thead>
                        <tr>
                            <th style="text-align:center;">DATE</th>
                            <th style="text-align:center;">TIME</th>
                            <th style="text-align:center;">COURSE TITLE</th>
                            <th style="text-align:center;">COURSE CODE</th>
                            <th style="text-align:center;">NO. OF STUDENTS</th>
                            <th style="text-align:center;">VENUE</th>
                            <th style="text-align:center;">SPECIAL REQUIREMENTS </th>
                            <th style="text-align:center;">REMINDER</th>
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
                        $sql = "SELECT * FROM examination";
                        $result = $conn->query($sql);

                        //Display results
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr style='text-align:center;'>";
                                echo "<td>" . $row['date'] . "</td>";
                                echo "<td>" . $row['time'] . "</td>";
                                echo "<td>" . $row['course_title'] . "</td>";
                                echo "<td>" . $row['course_code'] . "</td>";
                                echo "<td>" . $row['No_of_students'] . "</td>";
                                echo "<td>" . $row['venue'] . "</td>";
                                echo "<td>" . $row['special_requirements'] . "</td>";
                                echo "<td><button class='reminder-btn' data-exam-id='" . $row['date'] . "'>Set Reminder</button></td>"; // Button to set reminder
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' style='text-align:center;'>No Exams Found</td></tr>";
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
    <!-- JavaScript code to handle the reminder button click event -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all reminder buttons
            var reminderButtons = document.querySelectorAll('.reminder-btn');

            // Add click event listener to each button
            reminderButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var examId = this.getAttribute('data-exam-id');

                    // Send AJAX request to set reminder
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'set_reminder.php?exam_id=' + examId, true);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Display success message or handle response
                            console.log('Reminder set successfully for exam ID: ' + examId);
                        }
                    };
                    xhr.send();
                });
            });
        });
    </script>
</body>

</html>