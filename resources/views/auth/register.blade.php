@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-8">
    <div class="max-w-md w-full bg-white shadow-xl rounded-xl overflow-hidden">
        <div class="bg-slate-700 p-6 text-center">
            <i class="fas fa-user-plus text-white text-4xl mb-4"></i>
            <h2 class="text-2xl font-bold text-white">Créer un compte BusFlow</h2>
        </div>
        
        <form method="POST" action="{{ route('register') }}" class="p-8 space-y-6">
            @csrf
            
            {{-- Name Input --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input type="text" name="name" id="name" required autocomplete="name"
                        placeholder="Votre nom complet"
                        class="pl-10 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-4 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-slate-500 @error('name') border-red-500 @enderror"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Email Input --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email" name="email" id="email" required autocomplete="email"
                        placeholder="votre.email@exemple.com"
                        class="pl-10 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-4 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-slate-500 @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}">
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
                    <input type="password" name="password" id="password" required autocomplete="new-password"
                        placeholder="••••••••"
                        class="pl-10 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-4 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-slate-500 @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Confirm Password Input --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirmer le mot de passe</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        placeholder="••••••••"
                        class="pl-10 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-4 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-slate-500">
                </div>
            </div>

            {{-- Terms Acceptance --}}
            <div class="flex items-center">
                <input type="checkbox" name="terms" id="terms" required
                    class="h-4 w-4 text-slate-600 focus:ring-slate-500 border-gray-300 rounded">
                <label for="terms" class="ml-2 block text-sm text-gray-900">
                    J'accepte les <a href="#" class="text-slate-600 hover:text-slate-500">conditions d'utilisation</a>
                    et la <a href="#" class="text-slate-600 hover:text-slate-500">politique de confidentialité</a>
                </label>
            </div>

            {{-- Submit Button --}}
            <div>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-slate-600 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500">
                    Créer mon compte
                </button>
            </div>

            {{-- Social Registration --}}
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Ou inscrivez-vous avec</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-3 gap-3">
                    <div>
                        <a href="{{ route('register.google') }}" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">S'inscrire avec Google</span>
                            <i class="fab fa-google"></i>
                        </a>
                    </div>

                    <div>
                        <a href="{{ route('register.facebook') }}" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">S'inscrire avec Facebook</span>
                            <i class="fab fa-facebook"></i>
                        </a>
                    </div>

                    <div>
                        <a href="{{ route('register.apple') }}" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">S'inscrire avec Apple</span>
                            <i class="fab fa-apple"></i>
                        </a>
                    </div>
                </div>
            </div>
        </form>

        {{-- Login Link --}}
        <div class="px-8 pb-8 text-center">
            <p class="mt-2 text-sm text-gray-600">
                Déjà inscrit ? 
                <a href="{{ route('login') }}" class="font-medium text-slate-600 hover:text-slate-500">
                    Connectez-vous
                </a>
            </p>
        </div>
    </div>
</div>
@endsection