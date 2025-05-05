<footer class="bg-white border-t">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="space-y-4">
                <h3 class="text-lg font-bold text-slate-700">BusFlow</h3>
                <p class="text-sm text-gray-500">
                    Voyagez en toute tranquillité avec BusFlow, votre compagnon de voyage de confiance.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Facebook</span>
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Instagram</span>
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Twitter</span>
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-600 tracking-wider uppercase mb-4">Navigation</h3>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-900">
                            Accueil
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('trajets') }}" class="text-gray-500 hover:text-gray-900">
                            Trajets
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="text-gray-500 hover:text-gray-900">
                            Inscription
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-900">
                            Connexion
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-600 tracking-wider uppercase mb-4">Support</h3>
                <ul class="space-y-4">
                    <li>
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            Centre d'aide
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            Contactez-nous
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            Politique de confidentialité
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-600 tracking-wider uppercase mb-4">Contact</h3>
                <ul class="space-y-4">
                    <li class="flex items-center text-gray-500">
                        <i class="fas fa-map-marker-alt w-5"></i>
                        <span>123 Rue Example, Ville, Pays</span>
                    </li>
                    <li class="flex items-center text-gray-500">
                        <i class="fas fa-phone w-5"></i>
                        <span>+212 5XX-XXXXXX</span>
                    </li>
                    <li class="flex items-center text-gray-500">
                        <i class="fas fa-envelope w-5"></i>
                        <span>contact@busflow.ma</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-8 border-t border-gray-200 pt-8">
            <p class="text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} BusFlow. Tous droits réservés.
            </p>
        </div>
    </div>
</footer>