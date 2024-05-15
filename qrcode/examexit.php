<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start();
if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']=== true){

}else{
    header("Location: login.php");
    exit;
}
 include("includes/db.php");
 include("includes/sidebar.php");
 include("includes/header.php");
 

$base_url = 'http://localhost/HTML5-QR-CODE-SCANNER-MAIN/app/func/store2.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>EXIT</title>
</head>
<body>
<div class="main-content" style=top 50%>
 <main>
  <div class="page-header">
                <h1>Scan Student ID to SignOut</h1>
            </div>
            <br>
 <div class="scan-content">
 

<div id="qr-reader" style="width: 100%"></div>
	
<script>
      const html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { fps: 30, qrbox: 350 });
      let lastScanned;
      let reScan = true;

      const onScanSuccess = async (decodedText, decodedResult) => {
        if (decodedText !== lastScanned) {
          lastScanned = decodedText;
          await console.log(`Code scanned = ${decodedText}`, decodedResult);

          const baseurl = '<?php echo $base_url; ?>';
          const data = {
            'qrcode_values': decodedText,
          };

          const xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
              console.log(xmlhttp.responseText);
  const result = JSON.parse(xmlhttp.responseText);

  if (result.status === 'success' && result.qrcode_value) {
    const redirectUrl = result.redirect_url;

    const qrcodeValue = result.qrcode_value; // Access QR code value
    console.log(`QR Code Value: ${qrcodeValue}`);

    if (qrcodeValue !== null && qrcodeValue !== undefined) {
      // QR code is available, proceed with redirection and storage
      window.location.href = redirectUrl;
      window.localStorage.setItem('storedQrcode', qrcodeValue);
    } else {
      // Handle the case where QR code is not provided
      console.error("QR code value is missing in response.");
      // You might choose to display an error message or take other actions here
    }
  } else {
    // Handle error response (or missing QR code)
    console.error("Error fetching response or QR code not available:", result);
  }
              const swalConfig = {
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                confirmButtonText: 'Close',
              };

              if (result.status === 'error') {
                swalConfig.icon = 'error';
                swalConfig.title = 'Oops...';
              }
              else{
                swalConfig.icon = 'success';
                swalConfig.title = 'Success!';
                setTimeout(() => {
                                 Swal.close();
                                 }, 5000);
              }
           
              swalConfig.text = result.message;

              Swal.fire(swalConfig).then((result) => {
                if (result.isConfirmed) {
                  console.log("confirmed");
                }
                reScan = true;
                lastScanned = '';
              });
            }
          };

          xmlhttp.open("POST", baseurl, true);
          xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
          xmlhttp.send(JSON.stringify(data));
        }
      };

      html5QrcodeScanner.render(onScanSuccess);

      window.onload = async function(e) { 
        await document.getElementById("qr-reader").firstChild.firstChild.firstChild.remove();
        const el = document.createElement("span");
        el.innerHTML = "QR Code Scanner";
        await document.getElementById("qr-reader").firstChild.firstChild.appendChild(el);
      };
    </script>       
  </div>
 </div>
</main>



    </div>
    <!--<footer>
      <p>NUST, Copyright &copy; 2024</p>
    </footer>-->
</body>
</body>
</html>