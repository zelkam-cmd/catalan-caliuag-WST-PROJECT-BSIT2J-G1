<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $service = $_POST['service'];
    $appointment_date = $_POST['appointment_date']; // New field

    $sql = "INSERT INTO patients (name, age, gender, contact, service, appointment_date) 
            VALUES ('$name', $age, '$gender', '$contact', '$service', '$appointment_date')";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_patients.php?status=success");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>