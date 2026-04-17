<?php 
include 'db_config.php'; 
include 'header.php';

// Fetch the specific patient data
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM patients WHERE id=$id");
$row = $result->fetch_assoc();
?>

<main class="flex-grow flex items-center justify-center py-12 px-6">
    <div class="max-w-2xl w-full bg-white rounded-[2.5rem] shadow-2xl border border-blue-100 overflow-hidden">
        <div class="bg-[#0284c7] p-8 text-white">
            <h3 class="text-2xl font-bold">Edit Patient Profile</h3>
            <p class="opacity-80">Please fill in the patient information accurately.</p>
        </div>
        
        <form action="update_process.php" method="POST" class="p-8 space-y-6">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">👤 Full Name</label>
                    <input type="text" name="name" value="<?php echo $row['name']; ?>" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">📅 Age</label>
                    <input type="number" name="age" value="<?php echo $row['age']; ?>" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Gender</label>
                    <select name="gender" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="Male" <?php if($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                        <option value="Other" <?php if($row['gender'] == 'Other') echo 'selected'; ?>>Other</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">📞 Contact Number</label>
                    <input type="text" name="contact" value="<?php echo $row['contact']; ?>" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Appointment Date</label>
                    <input type="date" name="appointment_date" value="<?php echo $row['appointment_date']; ?>" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">🩺 Treatment</label>
                    <input type="text" name="service" value="<?php echo $row['service']; ?>" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-grow bg-[#0284c7] text-white py-4 rounded-2xl font-bold shadow-lg hover:bg-blue-700 transition">Update Profile</button>
                <a href="view_patients.php" class="px-8 py-4 bg-slate-100 text-slate-600 rounded-2xl font-bold hover:bg-slate-200 transition text-center">Cancel</a>
            </div>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>