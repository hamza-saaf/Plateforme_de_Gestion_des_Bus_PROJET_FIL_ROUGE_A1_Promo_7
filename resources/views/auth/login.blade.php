@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-8">
    <div class="max-w-md w-full bg-white shadow-xl rounded-xl overflow-hidden">
        <div class="bg-slate-700 p-6 text-center">
            <i class="fas fa-lock text-white text-4xl mb-4"></i>
            <h2 class="text-2xl font-bold text-white">Connexion à BusFlow</h2>
        </div>
        
        <form method="POST" action="{{ route('login') }}" class="p-8 space-y-6">
            @csrf
            
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Email Input --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email" name="email" id="email" required autocomplete="email"
                        placeholder="votre.email@exemple.com"
                        class="pl-10 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-4 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-slate-500"
                        value="{{ old('email') }}">
                </div>
            </div>

            {{-- Password Input --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" name="password" id="password" required
                        placeholder="••••••••"
                        class="pl-10 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-4 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-slate-500">
                </div>
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember"
                        class="h-4 w-4 text-slate-600 focus:ring-slate-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">
                        Se souvenir de moi
                    </label>
                </div>

                <div class="text-sm">
                    <a href="{{ route('password.request') }}" class="font-medium text-slate-600 hover:text-slate-500">
                        Mot de passe oublié ?
                    </a>
                </div>
            </div>

            {{-- Submit Button --}}
            <div>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-slate-600 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500">
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
                        <span class="px-2 bg-white text-gray-500">Ou connectez-vous avec</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-3 gap-3">
                    <div>
                        <a href="{{ route('login.google') }}" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Se connecter avec Google</span>
                            <i class="fab fa-google"></i>
                        </a>
                    </div>

                    <div>
                        <a href="{{ route('login.facebook') }}" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Se connecter avec Facebook</span>
                            <i class="fab fa-facebook"></i>
                        </a>
                    </div>

                    <div>
                        <a href="{{ route('login.apple') }}" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Se connecter avec Apple</span>
                            <i class="fab fa-apple"></i>
                        </a>
                    </div>
                </div>
            </div>
        </form>

        {{-- Registration Link --}}
        <div class="px-8 pb-8 text-center">
            <p class="text-sm text-gray-600">
                Pas encore de compte ? 
                <a href="{{ route('register') }}" class="font-medium text-slate-600 hover:text-slate-500">
                    Inscrivez-vous
                </a>
            </p>
        </div>
    </div>
</div>
@endsection