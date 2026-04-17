<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Outfit', 'sans-serif'] },
                    colors: { dental: { 50: '#f0f9ff', 600: '#0284c7', 700: '#0369a1' } }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .nav-link-active { background-color: #f0f9ff; color: #0369a1; border-radius: 9999px; }
    </style>
</head>
<body class="bg-dental-50 min-h-screen flex flex-col">
    <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
    
    <nav class="bg-white border-b border-dental-100 p-6 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="index.php" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-dental-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                    <i class="fa-solid fa-stethoscope text-xl"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-slate-900 leading-none">BrightSmile</h1>
                    <p class="text-[10px] uppercase tracking-widest text-dental-600 font-bold">Dental Clinic</p>
                </div>
            </a>
            
            <div class="hidden md:flex items-center space-x-2">
                <a href="index.php" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold transition <?php echo ($current_page == 'index.php') ? 'nav-link-active' : 'text-slate-500 hover:text-dental-600'; ?>">
                    <i class="fa-solid fa-house"></i> Home
                </a>
                <a href="add.php" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold transition <?php echo ($current_page == 'add.php') ? 'nav-link-active' : 'text-slate-500 hover:text-dental-600'; ?>">
                    <i class="fa-solid fa-plus"></i> Add Patient
                </a>
                <a href="view_patients.php" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold transition <?php echo ($current_page == 'view_patients.php') ? 'nav-link-active' : 'text-slate-500 hover:text-dental-600'; ?>">
                    <i class="fa-solid fa-users"></i> View Patients
                </a>
            </div>
        </div>
    </nav>
    </body>
</html>