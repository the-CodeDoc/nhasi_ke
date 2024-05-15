<?php

session_start();
include("includes/db.php");
include("includes/sidebar.php");
include("includes/header.php");

?>

<body>
    <div class="main-content">
        <main>
            <div class="main-content"></div>
            <div class="page-content"></div>
            <div class="container">
                <h1 color="blue">Exam Details</h1>
                <form method="post">
                    <fieldset>
                        <div class="field-box">
                            <label for="course_title">Course Title</label>
                            <input type="text" name="course_title" placeholder="eg WEB DEVELOPMENT" id="course_title">

                            <label for="course_code">Course Code</label>
                            <input type="text" name="course_code" placeholder="eg SCS2110" id="course_code">

                            <label for="students" name="students">No. of Students</label>
                            <select id="stuts" name="students">
                                <option value="50">50</option>
                                <option value="75">75</option>
                                <option value="100">120</option>
                            </select>

                            <label for="venue">Venue:</label>
                            <select name="venue" id="venue">
                                <option value="">CEREMONIAL HALL</option>
                                <option value="">ZAS, HARARE</option>
                            </select>

                            <label for="req">SPECIAL REQUIREMENTS:</label>
                            <select name="req" id="req">
                                <option value="">Bond Paper</option>
                                <option value="">Statistical Data Booklet</option>
                                <option value="">Graph Paper</option>
                            </select>

                            <label for="date">Date:</label>
                            <input type="date" name="date" placeholder="eg 18-Mar-2024" id="date">


                            <label for="session">Session:</label>
                            <input type="radio" name="session" id="session" value="MORNING">0900-1200
                            <input type="radio" name="session" id="session" value="AFTERNOON">1400-1700

                            <button type="save" name="save">Done..</button>
                        </div>
                    </fieldset>
                </form>
            </div>
    </div>
    //full Code of php file for mySql database connection with html form
    <?php
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $database_name = "qrcode";

    $conn = mysqli_connect($server_name, $username, $password, $database_name);
    //now check the connection
    if (!$conn) {
        die("Connection Failed:" . mysqli_connect_error());
    }
    $sql = "SELECT * FROM `examination`";
    $result = mysqli_query($conn, $sql);

    if (isset($_POST['save'])) {
        $course_title = $_POST['course_title'];
        $course_code = $_POST['course_code'];
        $students = $_POST['students'];
        $venue = $_POST['venue'];
        $req = $_POST['req'];
        $date = $_POST['date'];
        $session = $_POST['session'];

        $sql_query = "INSERT INTO examination (course_title,course_code,No_of_students,venue,special_requirements,date,time)
        VALUES ('$course_title','$course_code','$students','$venue','$req','$date','$session')";

        if (mysqli_query($conn, $sql_query)) {
            echo "New Details Entry inserted successfully !";
        } else {
            echo "Error: " . $sql . "" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    ?>
    </div>
    </main>
    </div>
</body>

</html>