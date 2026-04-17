<?php 
include 'db_config.php'; 
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM patients WHERE id=$id");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Patient - BrightSmile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-[#f8fafc] min-h-screen flex flex-col">
    <?php include 'db_config.php'; ?>
    <?php include 'header.php'; ?>

    <main class="flex-grow flex items-center justify-center py-12 px-6">
        <div class="max-w-xl w-full bg-white p-10 rounded-[2.5rem] shadow-2xl border border-blue-50">
            <h2 class="text-3xl font-bold mb-2 text-slate-900">Edit Patient Profile</h2>
            <p class="text-slate-500 mb-8 font-medium">Update the information for <?php echo $row['name']; ?></p>
            
            <form action="update_process.php" method="POST" class="space-y-5">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Full Name</label>
                    <input type="text" name="name" value="<?php echo $row['name']; ?>" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Age</label>
                    <input type="number" name="age" value="<?php echo $row['age']; ?>" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Treatment</label>
                    <input type="text" name="service" value="<?php echo $row['service']; ?>" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                
                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-grow bg-blue-600 text-white py-4 rounded-2xl font-bold shadow-lg hover:bg-blue-700 transition">Save Changes</button>
                    <a href="index.php" class="px-8 py-4 bg-slate-100 text-slate-600 rounded-2xl font-bold hover:bg-slate-200 transition text-center">Cancel</a>
                </div>
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>