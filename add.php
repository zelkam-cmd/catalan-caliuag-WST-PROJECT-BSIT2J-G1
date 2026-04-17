<?php include 'db_config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Patient - BrightSmile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#f8fafc] min-h-screen flex flex-col font-[Outfit]">
    <nav class="bg-white border-b p-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="font-bold text-xl">BrightSmile</h1>
            <a href="index.php" class="text-blue-600 font-bold hover:underline">← Back to Home</a>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center py-12">
        <div class="max-w-2xl w-full bg-white rounded-[2.5rem] shadow-2xl border border-blue-50 overflow-hidden">
            <div class="bg-blue-600 p-8 text-white">
                <h3 class="text-2xl font-bold">Register New Patient</h3>
                <p class="opacity-80">Fill in the clinical details below.</p>
            </div>
            <form action="add_patient.php" method="POST" class="p-8 grid grid-cols-2 gap-6">
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-bold mb-2">Full Name</label>
                    <input type="text" name="name" placeholder="Juan Dela Cruz" class="w-full p-4 bg-slate-50 border rounded-2xl" required>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-bold mb-2">Age</label>
                    <input type="number" name="age" placeholder="20" class="w-full p-4 bg-slate-50 border rounded-2xl" required>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-bold mb-2">Treatment/Service</label>
                    <input type="text" name="service" placeholder="Cleaning, Braces, etc." class="w-full p-4 bg-slate-50 border rounded-2xl" required>
                </div>
                <button type="submit" class="col-span-2 bg-blue-600 text-white py-5 rounded-2xl font-bold shadow-lg hover:bg-blue-700 transition">Register Patient</button>
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>
    </body>
    </html>