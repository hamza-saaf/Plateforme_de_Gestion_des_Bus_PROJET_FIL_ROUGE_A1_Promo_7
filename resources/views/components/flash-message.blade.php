@if (session('success'))
    <div x-data="{ show: true }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 4000)"
         class="fixed top-4 right-4 z-50 p-4 rounded-lg bg-green-100 border border-green-400 text-green-700">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    </div>
@endif

@if (session('error'))
    <div x-data="{ show: true }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 4000)"
         class="fixed top-4 right-4 z-50 p-4 rounded-lg bg-red-100 border border-red-400 text-red-700">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
        </div>
    </div>
@endif

@if (session('warning'))
    <div x-data="{ show: true }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 4000)"
         class="fixed top-4 right-4 z-50 p-4 rounded-lg bg-yellow-100 border border-yellow-400 text-yellow-700">
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            {{ session('warning') }}
        </div>
    </div>
@endif

@if (session('info'))
    <div x-data="{ show: true }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 4000)"
         class="fixed top-4 right-4 z-50 p-4 rounded-lg bg-blue-100 border border-blue-400 text-blue-700">
        <div class="flex items-center">
            <i class="fas fa-info-circle mr-2"></i>
            {{ session('info') }}
        </div>
    </div>
@endif

@if (session('status'))
    <div x-data="{ show: true }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 4000)"
         class="fixed top-4 right-4 z-50 p-4 rounded-lg bg-blue-100 border border-blue-400 text-blue-700">
        <div class="flex items-center">
            <i class="fas fa-info-circle mr-2"></i>
            {{ session('status') }}
        </div>
    </div>
@endif