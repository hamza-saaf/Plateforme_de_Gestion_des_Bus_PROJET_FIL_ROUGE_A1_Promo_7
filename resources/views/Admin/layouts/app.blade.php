<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - BusFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="bg-blue-800 text-white w-64 flex flex-col">
            <div class="p-4">
                <div class="flex items-center">
                    <i class="fas fa-bus text-2xl"></i>
                    <span class="ml-3 text-lg font-medium">BusFlow Admin</span>
                </div>
            </div>

            @include('Admin.partials.nav')

            <div class="mt-auto p-4">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Admin"
                        class="w-8 h-8 rounded-full">
                    <div class="ml-3">
                        <p class="text-sm font-medium">Admin</p>
                        <a href="#" class="text-xs text-blue-200 hover:text-white">Déconnexion</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="flex flex-col flex-1 overflow-hidden">
            @include('Admin.partials.header')

            <main class="flex-1 overflow-y-auto bg-gray-100 p-4 sm:p-6 md:p-8">
                @yield('content')
            </main>
        </div>
    </div>
    
    @stack('scripts')
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const notifBtn = document.getElementById("notificationBtn");
        const notifDropdown = document.getElementById("notificationDropdown");

        if (notifBtn && notifDropdown) {
            notifBtn.addEventListener("click", function() {
                notifDropdown.classList.toggle("hidden");
            });

            document.addEventListener("click", function(event) {
                if (!notifBtn.contains(event.target) && !notifDropdown.contains(event.target)) {
                    notifDropdown.classList.add("hidden");
                }
            });
        }
    });
    </script>
</body>
</html>
