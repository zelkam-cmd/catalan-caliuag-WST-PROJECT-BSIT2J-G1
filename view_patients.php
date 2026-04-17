<?php include 'db_config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Database - BrightSmile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex flex-col">
    <?php include 'db_config.php'; ?>
    <?php include 'header.php'; ?>

    <main class="max-w-7xl mx-auto w-full px-6 py-12 flex-grow">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-4xl font-bold text-slate-900">Patient Database</h2>
                <p class="text-slate-500 font-medium">Manage and monitor all registered records.</p>
            </div>
            <a href="add.php" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold shadow-md hover:bg-blue-700 transition">+ Add New</a>
        </div>

        <div class="bg-white rounded-[2rem] shadow-xl border border-blue-50 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-8 py-5 text-slate-600 font-bold uppercase text-xs">Patient</th>
                        <th class="px-8 py-5 text-slate-600 font-bold uppercase text-xs">Treatment</th>
                        <th class="px-8 py-5 text-slate-600 font-bold uppercase text-xs text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php
                    $result = $conn->query("SELECT * FROM patients");
                    while($row = $result->fetch_assoc()): ?>
                    <tr class="hover:bg-blue-50/30 transition">
                        <td class="px-8 py-6">
                            <p class="font-bold text-slate-900"><?php echo $row['name']; ?></p>
                            <p class="text-xs text-slate-500">Age: <?php echo $row['age']; ?></p>
                        </td>
                        <td class="px-8 py-6">
                             <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold"><?php echo $row['service']; ?></span>
                        </td>
                        <td class="px-8 py-6 text-right space-x-4">
                            <a href="edit_patient.php?id=<?php echo $row['id']; ?>" class="text-blue-600 font-bold hover:underline">Edit</a>
                            <a href="delete_patient.php?id=<?php echo $row['id']; ?>" class="text-red-500 font-bold hover:underline" onclick="return confirm('Delete record?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include 'footer.php'; ?>
    </body>
</html>