<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrandTaxiGo Driver - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100" x-data="{ sidebarOpen: false }">
    <!-- Mobile Sidebar Toggle -->
    <div class="lg:hidden fixed top-0 left-0 w-full bg-white z-50 border-b">
        <div class="flex items-center justify-between p-4">
            <div class="flex items-center">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <img src="https://cdn-icons-png.flaticon.com/512/4306/4306892.png" alt="GrandTaxiGo Logo" class="h-8 w-auto ml-4">
            </div>
            <div class="flex items-center">
                <span class="text-gray-700 text-sm font-medium mr-4" x-text="getCurrentTime()"></span>
                <div class="relative" x-data="{ statusDropdownOpen: false }">
                    <button 
                        @click="statusDropdownOpen = !statusDropdownOpen"
                        class="flex items-center space-x-2 px-3 py-2 rounded-full text-sm font-medium"
                        :class="isAvailable ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                    >
                        <span class="w-2 h-2 rounded-full" :class="isAvailable ? 'bg-green-600' : 'bg-red-600'"></span>
                        <span x-text="isAvailable ? 'Disponible' : 'Non disponible'"></span>
                    </button>
                    <div 
                        x-show="statusDropdownOpen"
                        @click.away="statusDropdownOpen = false"
                        class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                    >
                        <div class="py-1">
                            <a href="#" @click.prevent="toggleAvailability(true)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Marquer comme disponible</a>
                            <a href="#" @click.prevent="toggleAvailability(false)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Marquer comme non disponible</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div 
        class="fixed inset-y-0 left-0 z-40 w-64 bg-white shadow transform lg:transform-none lg:opacity-100 duration-200"
        :class="{'translate-x-0 opacity-100': sidebarOpen, '-translate-x-full opacity-0': !sidebarOpen}"
    >
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 px-4 bg-blue-600 lg:h-20">
                <img src="https://cdn-icons-png.flaticon.com/512/4306/4306892.png" alt="GrandTaxiGo Logo" class="h-8 w-auto">
                <span class="ml-2 text-xl font-bold text-white">GrandTaxiGo</span>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-2 py-4 space-y-2 overflow-y-auto">
                <a href="{{route('driver.announcements')}}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg {{ request()->is('driver/announcements*') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                    </svg>
                    Mes annonces
                </a>
                <a href="{{route('driver.trips')}}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg {{ request()->is('driver/trips*') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    Historique des trajets
                </a>
                <a href="{{route('show.availability')}}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg {{ request()->is('driver/availability*') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Disponibilité
                </a>
            </nav>

            <!-- Driver Profile -->
            <div class="p-4 border-t">
                <div class="flex items-center space-x-3">
                    <img src="{{asset('storage/'.$profile[0]->profile_picture)}}" alt="Driver" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="text-sm font-medium text-gray-700">{{$profile[0]->f_name}} {{$profile[0]->l_name}}</p>
                        <p class="text-xs text-gray-500">{{$profile[0]->email}}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <form action="{{route("logout")}}" method="POST">
                        @csrf
                        <button name="logout"  class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Déconnexion
                        </button>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="lg:pl-64">
        <div class="min-h-screen">
            <!-- Top Navigation -->
            <div class="hidden lg:block bg-white shadow">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <h1 class="text-2xl font-semibold text-gray-900">@yield('header')</h1>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-700 text-sm font-medium" x-text="getCurrentTime()"></span>
                            <div class="relative" x-data="{ statusDropdownOpen: false }">
                                <button 
                                    @click="statusDropdownOpen = !statusDropdownOpen"
                                    class="flex items-center space-x-2 px-3 py-2 rounded-full text-sm font-medium"
                                    :class="isAvailable ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                                >
                                    <span class="w-2 h-2 rounded-full" :class="isAvailable ? 'bg-green-600' : 'bg-red-600'"></span>
                                    <span x-text="isAvailable ? 'Disponible' : 'Non disponible'"></span>
                                </button>
                                <div 
                                    x-show="statusDropdownOpen"
                                    @click.away="statusDropdownOpen = false"
                                    class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5"
                                >
                                    <div class="py-1">
                                        <a href="#" @click.prevent="toggleAvailability(true)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Marquer comme disponible</a>
                                        <a href="#" @click.prevent="toggleAvailability(false)" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Marquer comme non disponible</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main class="py-6 px-4 sm:px-6 lg:px-8">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        

        function logout() {
            if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
                window.location.href = '/login';
            }
        }
    </script>

    @yield('scripts')
</body>
</html>
