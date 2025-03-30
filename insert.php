<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "pos";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category = $_POST['category'];
$name = $_POST['name'];
$price = $_POST['price'];

$targetDir = "uploads/";
$imageName = basename($_FILES["image"]["name"]);
$targetFilePath = $targetDir . $imageName;

if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
    $sql = "INSERT INTO stock (category, name, price, image) VALUES ('$category', '$name', '$price', '$targetFilePath')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "File upload failed!";
}

$conn->close();
?>

