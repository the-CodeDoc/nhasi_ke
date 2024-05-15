<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Exam Dashboard</title>
    <link rel="stylesheet" href="css/dashmaster.css">
    <link rel="icon" href="img/logo_nust_png.png">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>


<div class="main-content" style="height":60px;>
       <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>
                
                <div class="header-menu">
                   <div class="add">
                      <!--<a href="#">-->
                        <button onclick="confirmLogout()"><span class="las la-power-off"></span>
                        <span>Logout</span></button>
                        </a>
                    </div>
                </div>
            </div>
        </header>  
      
</div>
</html>

<script>
function confirmLogout() {
    Swal.fire({
        title: 'Are you sure?',
        text: "Confirm Logout",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#11a8c3',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, log out!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "logout.php";
        }
    });
}
</script>

<!--<script> function confirmLogout(){
 var logout = confirm("ARE YOU SURE YOU WANT TO LOG OUT?");
 if(logout){
    window.location.href="logout.php";
 }
 }
</script>-->
