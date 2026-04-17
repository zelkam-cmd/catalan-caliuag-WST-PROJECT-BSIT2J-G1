<?php include 'db_config.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BrightSmile Dental Clinic</title>
    <link rel="stylesheet" href="src/index.css"> </head>
<body>
    <h1>BrightSmile Patient Management</h1>

    <form action="add_patient.php" method="POST">
        <input type="text" name="name" placeholder="Patient Name" required>
        <input type="text" name="service" placeholder="Service (e.g. Cleaning)">
        <button type="submit">Add Patient</button>
    </form>

    <h2>Patient List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Service</th>
        </tr>
        <?php
        $sql = "SELECT * FROM patients";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["name"]."</td>
                <td>".$row["service"]."</td>
                <td>
                    <a href='edit_patient.php?id=".$row["id"]."'>Edit</a> | 
                    <a href='delete_patient.php?id=".$row["id"]."' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>
            </tr>";
          }
        } else {
            echo "<tr><td colspan='3'>No patients found</td></tr>";
        }
        ?>
    </table>
</body>
</html>