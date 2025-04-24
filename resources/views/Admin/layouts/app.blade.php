<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BusFlow')</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af',
                        secondary: '#1e293b'
                    }
                }
            }
        }
    </script>
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="bg-gray-100">
    <!-- Navigation latérale -->
    <div class="flex h-screen overflow-hidden">
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-blue-800 text-white">
                <div class="flex items-center justify-center h-16 bg-blue-900">
                    <span class="text-2xl font-bold">BusFlow</span>
                </div>
                {{-- nav --}}
                @include('Admin.partials.nav')
                <div class="px-4 py-4 bg-blue-900">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-circle text-2xl"></i>
                        </div>
                        <div class="ml-3">
                            <div class="text-sm font-medium">Admin</div>
                            <a href="#" class="text-xs text-blue-200 hover:text-white">Déconnexion</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="flex flex-col flex-1 overflow-hidden">
            {{-- header --}}
            @include('Admin.partials.header')

            <main class="flex-1 overflow-y-auto bg-gray-100 p-4 sm:p-6 md:p-8">
                @yield('content')
            </main>
        </div>
    </div>
    
    @stack('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const links = document.querySelectorAll("#sidebarNav .nav-link");
            links.forEach(link => {
                link.addEventListener("click", function(e) {
                    e.preventDefault();
                    links.forEach(l => l.classList.remove("bg-blue-700"));
                    this.classList.add("bg-blue-700");
                    const activeTab = this.getAttribute("data-tab");
                    console.log("Tab actif :", activeTab);
                });
            });
        });


        function setActiveTab(tabName) {
            document.querySelectorAll(".tab-title").forEach(span => {
                span.classList.add("hidden");
                if (span.dataset.tab === tabName) {
                    span.classList.remove("hidden");
                }
            });
        }
        document.addEventListener("DOMContentLoaded", () => {
            setActiveTab("dashboard");
            document.querySelectorAll("[data-tab]").forEach(link => {
                link.addEventListener("click", function() {
                    setActiveTab(this.dataset.tab);
                });
            });
            const notifBtn = document.getElementById("notificationBtn");
            const notifDropdown = document.getElementById("notificationDropdown");

            notifBtn.addEventListener("click", function() {
                notifDropdown.classList.toggle("hidden");
            });
            document.addEventListener("click", function(event) {
                if (!notifBtn.contains(event.target) && !notifDropdown.contains(event.target)) {
                    notifDropdown.classList.add("hidden");
                }
            });
        });
    </script>
</body>

</html>
