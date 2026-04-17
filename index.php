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
    <?php include 'db_config.php'; ?>
    <?php include 'header.php'; ?>
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
                  $count_res = $conn->query("SELECT COUNT(id) as total FROM patients");
                  $total_p = $count_res->fetch_assoc()['total'];

                  $treat_res = $conn->query("SELECT COUNT(DISTINCT service) as total_s FROM patients");
                  $total_s = $treat_res->fetch_assoc()['total_s'];
                  ?>
                  <div>
                      <p class="text-3xl font-bold text-slate-900"><?php echo $total_p; ?></p>
                      <p class="text-sm text-slate-500 font-medium">Patients</p>
                  </div>
                  <div>
                      <p class="text-3xl font-bold text-slate-900"><?php echo $total_s; ?>+</p>
                      <p class="text-sm text-slate-500 font-medium">Treatments</p>
                  </div>
                  <div>
                      <p class="text-3xl font-bold text-slate-900">4.9/5</p>
                      <p class="text-sm text-slate-500 font-medium">Rating</p>
                  </div>
              </div>

              <div class="relative">
                  <img src="https://picsum.photos/seed/dentist/800/800" class="rounded-[3rem] shadow-2xl">
                  
                  <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-3xl shadow-xl border border-blue-50">
                      <div class="flex items-center gap-4 mb-4">
                          <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600 text-xl">
                              <i class="fa-regular fa-calendar-check"></i>
                          </div>
                          <div>
                              <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wider">Next Appointment</p>
                              <p class="font-bold text-slate-900">Today, 2:30 PM</p>
                          </div>
                      </div>
                      <div class="flex -space-x-2">
                          <img src="https://i.pravatar.cc/100?u=1" class="w-8 h-8 rounded-full border-2 border-white">
                          <img src="https://i.pravatar.cc/100?u=2" class="w-8 h-8 rounded-full border-2 border-white">
                          <img src="https://i.pravatar.cc/100?u=3" class="w-8 h-8 rounded-full border-2 border-white">
                          <div class="w-8 h-8 rounded-full bg-blue-50 border-2 border-white flex items-center justify-center text-[10px] font-bold text-blue-600">+12</div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>