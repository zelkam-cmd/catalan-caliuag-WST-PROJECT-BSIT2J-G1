<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $service = $_POST['service'];

    $sql = "UPDATE patients SET name='$name', service='$service' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?msg=UpdatedSuccessfully");
    } else {
        echo "Error updating: " . $conn->error;
    }
}
?>