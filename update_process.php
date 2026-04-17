<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $service = $_POST['service'];
    $appointment_date = $_POST['appointment_date'];

    // Updated SQL to include all fields
    $sql = "UPDATE patients SET 
            name='$name', 
            age=$age, 
            gender='$gender', 
            contact='$contact', 
            service='$service', 
            appointment_date='$appointment_date' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_patients.php?status=updated");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>