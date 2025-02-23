<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrandTaxiGo - Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-image {
            background-image: url('https://images.unsplash.com/photo-1613455660724-d77d738de057?q=80&w=2000');
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
                <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Inscription GrandTaxiGo</h2>
                <p class="text-gray-600">Créez votre compte pour commencer</p>
            </div>

            <form id="registerForm" class="mt-8 space-y-6" method="POST" action="{{route('storeRegister')}}" enctype="multipart/form-data">
                @csrf

                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="userType">
                            Type d'utilisateur
                        </label>
                        <select id="userType" name="role" class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200" required>
                            <option value="passenger">🧑‍💼 Passager</option>
                            <option value="driver">🚖 Chauffeur</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="l_name">
                            Nom 
                        </label>
                        <input type="text" id="l_name" name="l_name" class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200" placeholder="Entrez votre nom complet" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="f_name">
                            Prenom 
                        </label>
                        <input type="text" id="f_name" name="f_name" class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200" placeholder="Entrez votre nom complet" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="f_name">
                            localisation 
                        </label>
                        <input type="text" id="location" name="location" class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200" placeholder="Entrez votre nom complet" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">
                            Email
                        </label>
                        <input type="email" id="email" name="email" class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200" placeholder="votre@email.com" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">
                            Mot de passe
                        </label>
                        <input type="password" id="password" name="password" class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200" placeholder="••••••••" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="password_confirmation">
                            Confirmer le mot de passe
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200" placeholder="••••••••" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="profile_picture">
                            Photo de profil
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-500 transition duration-200">
                            <div class="space-y-1 text-center">
                                <img id="preview" class="hidden mx-auto h-32 w-32 object-cover rounded-full mb-4 border-4 border-white shadow-lg">
                                <div class="flex text-sm text-gray-600">
                                    <label for="profile_picture" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Télécharger une photo</span>
                                        <input id="profile_picture" name="profile_picture" type="file" class="sr-only" accept="image/*" required>
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG jusqu'à 10MB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition duration-200 hover:scale-[1.02]">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-blue-500 group-hover:text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        S'inscrire
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Déjà inscrit? 
                        <a href="{{route('login')}}" class="font-medium text-blue-600 hover:text-blue-500 transition duration-200">
                            Connectez-vous ici
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerForm');
            const profilePhotoInput = document.getElementById('profile_photo');
            const preview = document.getElementById('preview');
            const dropZone = profilePhotoInput.closest('div.border-dashed');

            // Preview de la photo de profil
            profilePhotoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Effet de drag & drop
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults (e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, unhighlight, false);
            });

            function highlight(e) {
                dropZone.classList.add('border-blue-500', 'bg-blue-50');
            }

            function unhighlight(e) {
                dropZone.classList.remove('border-blue-500', 'bg-blue-50');
            }

            dropZone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const file = dt.files[0];
                
                if (file && file.type.startsWith('image/')) {
                    profilePhotoInput.files = dt.files;
                    const event = new Event('change');
                    profilePhotoInput.dispatchEvent(event);
                }
            }

            // Gestion de la soumission du formulaire
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                // Validation du formulaire
                const password = document.getElementById('password').value;
                const passwordConfirmation = document.getElementById('password_confirmation').value;

                if (password !== passwordConfirmation) {
                    alert('Les mots de passe ne correspondent pas.');
                    return;
                }

                // Animation de chargement sur le bouton
                const button = form.querySelector('button[type="submit"]');
                const originalText = button.innerHTML;
                button.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Inscription en cours...
                `;
                button.disabled = true;

                // Création du FormData pour l'envoi
                const formData = new FormData(form);

                try {
                    const response = await fetch('/api/register', {
                        method: 'POST',
                        body: formData
                    });

                    if (response.ok) {
                        const data = await response.json();
                        window.location.href = '/login?registered=true';
                    } else {
                        const error = await response.json();
                        alert(error.message || 'Une erreur est survenue lors de l\'inscription.');
                        button.innerHTML = originalText;
                        button.disabled = false;
                    }
                } catch (error) {
                    console.error('Erreur:', error);
                    alert('Une erreur est survenue lors de l\'inscription.');
                    button.innerHTML = originalText;
                    button.disabled = false;
                }
            });
        });
    </script>
</body>
</html>
