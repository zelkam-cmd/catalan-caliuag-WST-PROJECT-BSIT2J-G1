<?php
include 'db_config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // This is the SQL command to remove the record
    $sql = "DELETE FROM patients WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to your main page after deleting
        header("Location: index.php?msg=DeletedSuccessfully");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>