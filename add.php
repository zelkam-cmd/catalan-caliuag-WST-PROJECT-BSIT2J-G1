<?php include 'db_config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - BrightSmile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-[#f0f9ff] min-h-screen flex flex-col">
    <?php include 'db_config.php'; ?>
    <?php include 'header.php'; ?>

    <main class="flex-grow flex items-center justify-center py-12 px-6">
        <div class="max-w-2xl w-full bg-white rounded-[2.5rem] shadow-2xl border border-blue-100 overflow-hidden">
            <div class="bg-[#0284c7] p-8 text-white">
                <h3 class="text-2xl font-bold">Register New Patient</h3>
                <p class="opacity-80">Please fill in the patient information accurately.</p>
            </div>
            
            <form action="add_patient.php" method="POST" class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">👤 Full Name</label>
                        <input type="text" name="name" placeholder="John Doe" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">📅 Age</label>
                        <input type="number" name="age" placeholder="25" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Gender</label>
                        <select name="gender" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none">
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">📞 Contact Number</label>
                        <input type="text" name="contact" placeholder="9123456789" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Appointment Date</label>
                        <input type="date" name="appointment_date" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">🩺 Treatment</label>
                        <input type="text" name="service" placeholder="Cleaning" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none" required>
                    </div>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-grow bg-[#0284c7] text-white py-4 rounded-2xl font-bold shadow-lg hover:bg-blue-700 transition">Register Patient</button>
                    <a href="index.php" class="px-8 py-4 bg-slate-100 text-slate-600 rounded-2xl font-bold hover:bg-slate-200 transition text-center">Cancel</a>
                </div>
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>
    </body>
    </html>