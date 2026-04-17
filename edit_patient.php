<?php
include 'db_config.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM patients WHERE id=$id");
$row = $result->fetch_assoc();
?>

<form action="update_process.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="text" name="name" value="<?php echo $row['name']; ?>">
    <input type="text" name="service" value="<?php echo $row['service']; ?>">
    <button type="submit">Update Record</button>
</form>