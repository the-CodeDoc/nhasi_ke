<?php

session_start();
include("includes/db.php");
if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']=== true){

}else{
    header("Location: login.php");
    exit;
}
include("includes/sidebar.php");
include("includes/header.php");
include("includes/main.php");


?>