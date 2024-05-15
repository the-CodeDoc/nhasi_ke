<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect the user to the login page or any other desired page
    header("Location: login.php");
    exit;
} else {
    // If the user is not logged in, redirect them to the login page
    header("Location: login.php");
    exit;
}
?>
