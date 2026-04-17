<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $service = $_POST['service'];

    $sql = "INSERT INTO patients (name, age, gender, contact, service) 
            VALUES ('$name', $age, '$gender', '$contact', '$service')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?status=success");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>