<?php 
include 'db_config.php'; 
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM patients WHERE id=$id");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 p-10">
    <div class="max-w-xl mx-auto bg-white p-8 rounded-3xl shadow-lg">
        <h2 class="text-2xl font-bold mb-6">Edit Patient Profile</h2>
        <form action="update_process.php" method="POST" class="space-y-4">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            
            <label class="block text-sm font-bold">Full Name</label>
            <input type="text" name="name" value="<?php echo $row['name']; ?>" class="w-full p-3 border rounded-xl">
            
            <label class="block text-sm font-bold">Age</label>
            <input type="number" name="age" value="<?php echo $row['age']; ?>" class="w-full p-3 border rounded-xl">
            
            <label class="block text-sm font-bold">Treatment</label>
            <input type="text" name="service" value="<?php echo $row['service']; ?>" class="w-full p-3 border rounded-xl">
            
            <div class="flex gap-4 pt-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold">Save Changes</button>
                <a href="index.php" class="bg-gray-100 px-6 py-3 rounded-xl font-bold text-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>