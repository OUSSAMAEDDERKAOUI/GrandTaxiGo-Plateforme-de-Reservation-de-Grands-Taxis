<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrandTaxiGo - Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-image {
            background-image: url('https://images.unsplash.com/photo-1610647752706-3bb12232b3ab?q=80&w=2000');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-image min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-black/40 to-black/60">
        <div class="glass-effect p-8 rounded-2xl shadow-2xl max-w-md w-full space-y-8 transform hover:scale-[1.01] transition-all duration-300">
            <div class="text-center">
                <div class="flex justify-center mb-4">
                    <img src="https://cdn-icons-png.flaticon.com/512/4306/4306892.png" alt="GrandTaxiGo Logo" class="h-20 w-auto">
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Connexion GrandTaxiGo</h2>
                <p class="text-gray-600">Connectez-vous à votre compte</p>
            </div>

            <form id="loginForm" class="mt-8 space-y-6" action="{{"login"}}" method="POst">
                @csrf
                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">
                            Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <input type="email" id="email" name="email" class="appearance-none relative block w-full pl-10 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200" placeholder="votre@email.com" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">
                            Mot de passe
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="password" id="password" name="password" class="appearance-none relative block w-full pl-10 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200" placeholder="••••••••" required>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded transition duration-200">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Se souvenir de moi
                        </label>
                    </div>
                    <a href="/forgot-password" class="text-sm font-medium text-blue-600 hover:text-blue-500 transition duration-200">
                        Mot de passe oublié?
                    </a>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition duration-200 hover:scale-[1.02]">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-blue-500 group-hover:text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        Se connecter
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Pas encore de compte? 
                        <a href="{{route('showRegister')}}" class="font-medium text-blue-600 hover:text-blue-500 transition duration-200">
                            Inscrivez-vous ici
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
       
    </script>
</body>
</html>
