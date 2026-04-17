<?php include 'db_config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrightSmile Dental Clinic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
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
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-dental-50 min-h-screen flex flex-col">
    <nav class="bg-white border-b border-blue-50 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                <i data-lucide="stethoscope" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-xl font-bold text-slate-900 leading-none">BrightSmile</h1>
                <p class="text-[10px] uppercase tracking-[0.2em] text-slate-400 font-bold mt-1">Dental Clinic</p>
            </div>
        </div>

        <div class="flex items-center space-x-2">
            <a href="index.php" class="flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-bold transition-all bg-blue-50 text-blue-600">
                <i data-lucide="home" class="w-4 h-4"></i>
                Home
            </a>

            <a href="add.php" class="flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-bold transition-all text-slate-500 hover:text-blue-600 hover:bg-blue-50/50">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Add Patient
            </a>

            <a href="view_patients.php" class="flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-bold transition-all text-slate-500 hover:text-blue-600 hover:bg-blue-50/50">
                <i data-lucide="users" class="w-4 h-4"></i>
                View Patients
            </a>
        </div>
    </div>
</nav>

<script>
    lucide.createIcons();
</script>

    <main class="max-w-7xl mx-auto px-6 py-20 flex-grow">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-8">
                <div>
                    <span class="bg-blue-100 text-blue-700 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">
                        Welcome to BrightSmile
                    </span>
                    <h2 class="text-6xl md:text-7xl font-bold mt-6 mb-6 leading-[1.1] text-slate-900">
                        Modern Dental Care <br><span class="text-dental-600">for Your Family</span>
                    </h2>
                    <p class="text-xl text-slate-600 max-w-lg leading-relaxed">
                        Manage your patients with ease using our advanced PHP & MySQL management system. Fast, secure, and reliable.
                    </p>
                </div>
                
                <div class="flex flex-wrap gap-5">
                    <a href="add.php" class="bg-dental-600 text-white px-10 py-5 rounded-[2rem] font-bold shadow-xl shadow-blue-200 hover:bg-dental-700 hover:-translate-y-1 transition-all">
                        + Register New Patient
                    </a>
                    <a href="view_patients.php" class="bg-white text-dental-700 border-2 border-blue-100 px-10 py-5 rounded-[2rem] font-bold hover:bg-blue-50 hover:-translate-y-1 transition-all">
                        Manage Database
                    </a>
                </div>

                <div class="grid grid-cols-3 gap-8 pt-10 border-t border-blue-100">
                  <?php
                  $count_query = "SELECT COUNT(id) as total FROM patients";
                  $count_result = $conn->query($count_query);
                  $count_row = $count_result->fetch_assoc();
                  $total_patients = $count_row['total'];
                  ?>
                  
                  <div>
                      <p class="text-3xl font-bold text-slate-900"><?php echo $total_patients; ?></p>
                      <p class="text-sm text-slate-500 font-medium">Active Patients</p>
                  </div>
                  
                  <?php
                  $service_query = "SELECT COUNT(DISTINCT service) as total_services FROM patients";
                  $service_result = $conn->query($service_query);
                  $service_row = $service_result->fetch_assoc();
                  $total_services = $service_row['total_services'];
                  ?>
                  
                  <div>
                      <p class="text-3xl font-bold text-slate-900"><?php echo $total_services; ?></p>
                      <p class="text-sm text-slate-500 font-medium">Treatments Run</p>
                  </div>
                  
                  <div>
                      <p class="text-3xl font-bold text-slate-900">4.9/5</p>
                      <p class="text-sm text-slate-500 font-medium">User Rating</p>
                  </div>
              </div>
            </div>

            <div class="relative">
                <div class="absolute -inset-4 bg-blue-200/30 blur-3xl rounded-full"></div>
                <img src="https://picsum.photos/seed/dentist/800/800" alt="Clinic" class="relative rounded-[3rem] shadow-2xl object-cover aspect-square">
                <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-3xl shadow-xl border border-blue-50 hidden md:block">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600 text-xl">📅</div>
                        <div>
                            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Next Appointment</p>
                            <p class="font-bold text-slate-900">Today, 2:30 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>