<?php include 'db_config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - BrightSmile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50">
    <nav class="bg-white border-b p-6 mb-10">
        <div class="max-w-7xl mx-auto flex justify-between">
            <h1 class="font-bold text-xl">BrightSmile</h1>
            <a href="index.php" class="text-blue-600 font-bold">← Back to Home</a>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto bg-white rounded-[2rem] shadow-xl border p-8">
        <h3 class="text-2xl font-bold mb-6 text-center text-slate-800">Register New Patient</h3>
        <form action="add_patient.php" method="POST" class="grid grid-cols-2 gap-4">
            <input type="text" name="name" placeholder="Full Name" class="p-3 border rounded-xl" required>
            <input type="number" name="age" placeholder="Age" class="p-3 border rounded-xl" required>
            <select name="gender" class="p-3 border rounded-xl">
                <option>Male</option>
                <option>Female</option>
            </select>
            <input type="text" name="contact" placeholder="Contact Number" class="p-3 border rounded-xl">
            <input type="text" name="service" placeholder="Treatment" class="p-3 border rounded-xl col-span-2" required>
            <button type="submit" class="col-span-2 bg-blue-600 text-white py-4 rounded-2xl font-bold hover:bg-blue-700 transition">Register Patient</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>
    