<?php
// Connect to the MySQL database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'qrcode';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

// Check if image data is set and not empty
if(isset($_POST['image']) && !empty($_POST['image'])) {
    // Get the image data from the POST request
    $imageData = $_POST['image'];

    // Validate if it's base64 data
    if(preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
        $imageData = substr($imageData, strpos($imageData, ',') + 1);

        // Convert the image data from base64 to binary
        $imageData = base64_decode($imageData);

        // Generate a unique name for the image
        $imageName = uniqid() . '.png';

        // Directory to store images
        $directory = 'signature_image/';

        // Save the image data to a file
        if(file_put_contents($directory . $imageName, $imageData) !== false) {
            // Insert the image name into the images table
            $stmt = $conn->prepare('INSERT INTO images (image_data) VALUES (?)');
            $stmt->bind_param('s', $imageName);

            if ($stmt->execute()) {
              echo 'Image successfully inserted';
            } else {
              echo 'Error submitting image: ' . $stmt->error;
            }

            $stmt->close();
        } else {
            echo 'Error saving image.';
        }
    } else {
        echo 'Invalid image data.';
    }
} else {
    echo 'Image data not found.';
}

$conn->close();
?>
