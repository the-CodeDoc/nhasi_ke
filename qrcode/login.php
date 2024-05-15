<?php
// Start the session
session_start();

// Include database connection
include("includes/db.php");

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  // Redirect the user to the dashboard or any other authenticated page
  header("Location: index.php");
  exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $staff_id = $_POST['staff_id'];
  $pass = $_POST['pass'];

  // SQL statement
  $query = "SELECT staff_id, password, name FROM users WHERE staff_id = ? AND password = ?";
  $stmt = $con->prepare($query);
  $stmt->bind_param("ss", $staff_id, $pass);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  if ($row) {
    // Authentication successful, set session variables
    $_SESSION['loggedin'] = true;
    $_SESSION['staff_id'] = $staff_id;
    $_SESSION['name'] = $row['name'];

    // Redirect to dashboard or any other authenticated page
    Header("Location: index.php");
    exit;
  } else {
    // Authentication failed, display error message using SwalFire
    echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Invalid staff number or password!'
                    });
                });
              </script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nust Examination Board | Welcome</title>
  <link rel="stylesheet" href="css/login.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="icon" href="img/logo_nust_png.png">
</head>

<body>
  <div class="container-big">
    <div class="headers">
      <header>
        <img src="img/logo_nust_png.png" width="80px" height="80px">
        <h1>NATIONAL UNIVERSITY OF SCIENCE AND TECHNOLOGY</h1>
        <b><small>"Think in other terms"</small></b>
      </header>
    </div>
    <section id="showcase">
      <div class="container">
        <h1>Digitalizing Exam Attendance</h1>
      </div>
      <div class="dark">
        <fieldset>
          <BR>
          <i>Managing Exams Seamlessly</i>
          <br><br>
          <form class="login" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="staff_id" id="staff_id" placeholder="Staff ID Number" required>
            <br><br>
            <input type="password" name="pass" id="pass" placeholder="Password" required>
            <br><br>
            <i>Login using your credentials</i><br><br>
            <div class="add"><button class="button_1" type="submit">Login</button></div>
          </form>
        </fieldset>
      </div>
    </section>
  </div>
</body>

</html>