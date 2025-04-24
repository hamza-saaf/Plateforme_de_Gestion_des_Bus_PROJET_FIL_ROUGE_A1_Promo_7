@extends('Admin.layouts.app')

@section('content')
<!-- Section gestion des trajets -->
<div class="tab-content">
    <div class="flex justify-between mb-4">
        <h3 class="text-lg font-medium text-gray-900">Gestion des trajets</h3>
        <button type="button" onclick="openModal()" id="addRouteBtn"
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <i class="fas fa-plus mr-2"></i> Ajouter un trajet
        </button>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900">Trajets disponibles</h3>
            <div class="relative">
                <input type="text" placeholder="Rechercher des trajets..."
                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md pl-10">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Départ</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destination</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Places disponibles</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($trajets as $trajet)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $trajet->depart }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $trajet->destination }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $trajet->date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $trajet->price }} DH</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $trajet->available_seats }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="editTrajet({{ $trajet->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteTrajet({{ $trajet->id }})" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                Aucun trajet disponible
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal pour ajouter/éditer un trajet -->
    <div id="trajetModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium" id="modalTitle">Ajouter un trajet</h3>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="trajetForm" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Départ</label>
                        <input type="text" name="depart" id="depart" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <p class="error-message text-sm text-red-600 mt-1"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Destination</label>
                        <input type="text" name="destination" id="destination" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <p class="error-message text-sm text-red-600 mt-1"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="date" id="date" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <p class="error-message text-sm text-red-600 mt-1"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Prix</label>
                        <input type="number" name="price" id="price" required step="0.01" min="0"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <p class="error-message text-sm text-red-600 mt-1"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Places disponibles</label>
                        <input type="number" name="available_seats" id="available_seats" required min="1"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <p class="error-message text-sm text-red-600 mt-1"></p>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="button" onclick="closeModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 mr-2">
                        Annuler
                    </button>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openModal() {
        document.getElementById('trajetModal').classList.remove('hidden');
        document.getElementById('modalTitle').textContent = 'Ajouter un trajet';
        document.getElementById('trajetForm').reset();
        document.getElementById('trajetForm').action = "{{ route('admin.trajets.store') }}";
        document.getElementById('trajetForm').method = "POST";
        removeMethodField();
    }

    function closeModal() {
        document.getElementById('trajetModal').classList.add('hidden');
    }

    function removeMethodField() {
        const methodField = document.querySelector('input[name="_method"]');
        if (methodField) methodField.remove();
    }

    function editTrajet(id) {
        openModal();
        document.getElementById('modalTitle').textContent = 'Modifier le trajet';
        
        fetch(`/admin/trajets/${id}/edit`, {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('depart').value = data.depart;
            document.getElementById('destination').value = data.destination;
            document.getElementById('date').value = data.date;
            document.getElementById('price').value = data.price;
            document.getElementById('available_seats').value = data.available_seats;
            
            const form = document.getElementById('trajetForm');
            form.action = `/admin/trajets/${id}`;
            
            removeMethodField();
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'PUT';
            form.appendChild(methodField);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue lors de la récupération des données');
        });
    }

    function deleteTrajet(id) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce trajet ?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/trajets/${id}`;
            
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = document.querySelector('meta[name="csrf-token"]').content;
            
            const method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'DELETE';
            
            form.appendChild(csrf);
            form.appendChild(method);
            document.body.appendChild(form);
            form.submit();
        }
    }

    // Add event listener for form submission
    $('#trajetForm').submit(function(e) {
        e.preventDefault();
        
        // Reset error messages
        $('.error-message').text('');

        $.ajax({
            url: '/admin/trajets',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if(response.success) {
                    location.reload();
                }
            },
            error: function(xhr) {
                if(xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    // Display validation errors
                    $.each(errors, function(field, messages) {
                        $(`[name="${field}"]`).next('.error-message').text(messages[0]);
                    });
                } else {
                    alert('Une erreur est survenue lors de l\'enregistrement');
                }
            }
        });
    });
</script>
@endpush
@endsection