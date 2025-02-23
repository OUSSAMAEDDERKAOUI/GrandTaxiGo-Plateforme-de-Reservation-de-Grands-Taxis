<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrandTaxiGo - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="flex items-center justify-center h-16 px-4 bg-blue-600">
                    <img src="https://cdn-icons-png.flaticon.com/512/4306/4306892.png" alt="GrandTaxiGo Logo" class="h-8 w-auto">
                    <span class="ml-2 text-xl font-bold text-white">GrandTaxiGo</span>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-2 py-4 space-y-2">
                    <a href="{{route('passenger.announcements')}}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg {{ request()->is('passenger/announcements*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                        Annonces des chauffeurs
                    </a>
                    <a href="{{route('passenger.trips')}}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg {{ request()->is('passenger/trips*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        Historique des trajets
                    </a>
                </nav>

                <!-- User Profile -->
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
        <div class="flex-1">
            <!-- Top Navigation -->
            <div class="bg-white shadow">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <h1 class="text-2xl font-semibold text-gray-900">@yield('header')</h1>
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
