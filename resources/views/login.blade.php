<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion-BusFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="max-w-md w-full bg-white shadow-xl rounded-xl overflow-hidden">
            <div class="bg-blue-700 p-6 text-center">
                <i class="fas fa-bus text-white text-4xl mb-4"></i>
                <h2 class="text-2xl font-bold text-white">Connexion à BusFlow</h2>
            </div>
            
            <form method="POST" action="{{ route('login') }}" class="p-8 space-y-6">
                @csrf
                
                {{-- Email Input --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            required 
                            autocomplete="email"
                            placeholder="votre.email@exemple.com"
                            class="pl-10 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                            value="{{ old('email') }}"
                        >
                        @error('email')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Password Input --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            required 
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="pl-10 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror"
                        >
                        @error('password')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Remember Me Checkbox --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            id="remember" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                        >
                        <label for="remember" class="ml-2 block text-sm text-gray-900">
                            Se souvenir de moi
                        </label>
                    </div>

                    <div class="text-sm">
                        {{-- {{ route('password.request') }} --}}
                        <a href="" class="font-medium text-blue-600 hover:text-blue-500">
                            Mot de passe oublié ?
                        </a>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div>
                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Se connecter
                    </button>
                </div>

                {{-- Social Login --}}
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">
                                Ou continuez avec
                            </span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-3 gap-3">
                        <div>
                            {{-- {{ route('login.google') }} --}}
                            <a href="" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Se connecter avec Google</span>
                                <i class="fab fa-google"></i>
                            </a>
                        </div>

                        <div>
                            {{-- {{ route('login.facebook') }} --}}
                            <a href="" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Se connecter avec Facebook</span>
                                <i class="fab fa-facebook"></i>
                            </a>
                        </div>

                        <div>
                            {{-- {{ route('login.apple') }} --}}
                            <a href="" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Se connecter avec Apple</span>
                                <i class="fab fa-apple"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>

            {{-- Registration Link --}}
            <div class="px-8 pb-8 text-center">
                <p class="mt-2 text-sm text-gray-600">
                    Pas encore de compte ? 
                    {{-- {{ route('register') }} --}}
                    <a href="" class="font-medium text-blue-600 hover:text-blue-500">
                        Créez un compte
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>