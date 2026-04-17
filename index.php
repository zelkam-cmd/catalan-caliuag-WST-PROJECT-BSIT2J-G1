<?php include 'db_config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrightSmile Dental Clinic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { display: ['Outfit', 'sans-serif'] },
                    colors: { dental: { 50: '#f0f9ff', 600: '#0284c7', 700: '#0369a1' } }
                }
            }
        }
    </script>
</head>
<body class="bg-dental-50 font-sans">
    <nav class="bg-white border-b p-6 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="bg-dental-600 p-2 rounded-lg text-white">🩺</div>
                <h1 class="text-xl font-bold">BrightSmile</h1>
            </div>
            <div class="space-x-6 text-slate-600 font-medium">
                <a href="index.php">Home</a>
                <a href="#database">View Patients</a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
            <div>
                <span class="bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-xs font-bold">WELCOME TO BRIGHTSMILE</span>
                <h2 class="text-6xl font-bold mt-4 mb-6 leading-tight">Modern Dental Care <br><span class="text-dental-600">for Your Family</span></h2>
                <div class="flex gap-4">
                    <a href="#add.php" class="bg-dental-600 text-white px-8 py-4 rounded-2xl font-bold shadow-lg hover:bg-dental-700 transition">
                        + Register New Patient
                    </a>
                    <a href="#view_patients.php" class="bg-white text-dental-700 border border-blue-100 px-8 py-4 rounded-2xl font-bold hover:bg-blue-50 transition">
                        Manage Database
                    </a>
                </div>
            </div>
            <img src="https://picsum.photos/seed/dentist/800/600" class="rounded-[3rem] shadow-2xl">
        </div>

        <div id="add-form" class="bg-white rounded-[2rem] shadow-xl border p-8 max-w-2xl mx-auto mb-20">
            <h3 class="text-2xl font-bold mb-6 text-center text-slate-800">Register New Patient</h3>
            <form action="add_patient.php" method="POST" class="grid grid-cols-2 gap-4">
                <input type="text" name="name" placeholder="Full Name" class="p-3 border rounded-xl" required>
                <input type="number" name="age" placeholder="Age" class="p-3 border rounded-xl" required>
                <select name="gender" class="p-3 border rounded-xl">
                    <option>Male</option>
                    <option>Female</option>
                </select>
                <input type="text" name="contact" placeholder="Contact Number" class="p-3 border rounded-xl">
                <input type="text" name="service" placeholder="Treatment (e.g. Cleaning)" class="p-3 border rounded-xl col-span-2" required>
                <button type="submit" class="col-span-2 bg-dental-600 text-white py-4 rounded-2xl font-bold">Register Patient</button>
            </form>
        </div>

        <div id="database" class="bg-white rounded-[2rem] shadow-xl border overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-blue-50 text-blue-700 font-bold uppercase text-xs">
                    <tr>
                        <th class="px-8 py-5">Patient</th>
                        <th class="px-8 py-5">Treatment</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-50">
                    <?php
                    $result = $conn->query("SELECT * FROM patients");
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td class='px-8 py-6'>
                                    <p class='font-bold'>".$row['name']."</p>
                                    <p class='text-xs text-slate-500'>Age: ".$row['age']." | ".$row['gender']."</p>
                                </td>
                                <td class='px-8 py-6'>
                                    <span class='bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold'>".$row['service']."</span>
                                </td>
                                <td class='px-8 py-6 text-right'>
                                    <a href='edit_patient.php?id=".$row['id']."' class='text-blue-600 mr-4'>Edit</a>
                                    <a href='delete_patient.php?id=".$row['id']."' class='text-red-500' onclick='return confirm(\"Delete?\")'>Delete</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' class='p-10 text-center text-slate-400'>No patients found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>