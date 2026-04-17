<?php
include 'db_config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM patients WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?status=deleted");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>