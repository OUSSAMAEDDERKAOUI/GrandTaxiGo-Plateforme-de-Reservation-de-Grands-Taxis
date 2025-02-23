@extends('layouts.driver')

@section('title', 'Mes annonces')
@section('header', 'Mes annonces')

@section('content')
<div x-data="announcementsPage">
    <!-- Create/Edit Announcement Modal -->
    <div id="showAnnouncementModal" class="fixed inset-0 z-50 overflow-y-auto hidden" >
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="relative bg-white rounded-lg max-w-2xl w-full">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4" x-text="editingAnnouncement ? 'Modifier l\'annonce' : 'Nouvelle annonce'"></h3>
                    <form  action="{{route("storeAnnouncement")}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Titre</label>
                                <input name="title" type="text" x-model="currentAnnouncement.title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="content" x-model="currentAnnouncement.content" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Lieu de départ</label>
                                    <input name="trip_start" type="text" x-model="currentAnnouncement.startLocation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Destination</label>
                                    <input name="trip_end" type="text" x-model="currentAnnouncement.endLocation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Date de départ</label>
                                    <input name="departure_date" type="datetime-local" x-model="currentAnnouncement.departureDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Date d'expiration</label>
                                    <input name="expires_at" type="datetime-local" x-model="currentAnnouncement.expirationDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nombre maximum de passagers</label>
                                <input name="max_passengers" type="number" x-model="currentAnnouncement.maxPassengers" min="1" max="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Image (optionnel)</label>
                                <input name="image" type="file" accept="image/*" class="mt-1 block w-full">
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button"  class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 border border-gray-300 rounded-md">Annuler</button>
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="reservationsModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="relative bg-white rounded-lg max-w-2xl w-full">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Réservations</h3>
                    <div id="reservationsList" class="space-y-4">
                        <!-- The dynamic content for reservations will go here -->
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button id="closeModal" class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 border border-gray-300 rounded-md">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    

    <!-- Main Content -->
    <div class="space-y-6">
        <!-- Actions -->
        <div class="flex justify-between items-center">
            <button id="createAnnouncement" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md">
                Nouvelle annonce
            </button>
            <div class="flex space-x-4">
                <select x-model="statusFilter" class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Tous les statuts</option>
                    <option value="open">Ouvert</option>
                    <option value="reserved">Réservé</option>
                    <option value="completed">Terminé</option>
                    <option value="cancelled">Annulé</option>
                </select>
                <input type="text" x-model="searchQuery" placeholder="Rechercher..." class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
        </div>

        <!-- Announcements Grid -->
            
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-12">
            @foreach ($announcements as $announcement)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="aspect-w-16 aspect-h-9">
                        @if ($announcement->image && Storage::exists('public/' . $announcement->image))
                            <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }} Image" class="object-cover rounded-t-lg">
                        @else
                            <img src="{{ asset('images/default-image.png') }}" alt="Default Image" class="object-cover rounded-t-lg">
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <h3 class="text-lg font-medium text-gray-900">{{ $announcement->title }}</h3>
                            <span class="bg-green-100 text-green-800 px-2 py-1 text-xs font-medium rounded-full">{{ $announcement->status }}</span>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">{{ $announcement->content }}</p>
                        
                        <div class="mt-4 space-y-2">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>{{ $announcement->trip_start }} → {{ $announcement->trip_end }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ $announcement->departure_date }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span>{{ $announcement->max_passengers }} passagers max</span>
                            </div>
                        </div>
        
                        @foreach ($announcement->reservations as $reservation)
                        {{-- <input  class="mt-2 text-sm text-gray-500">
                            {{ $reservation->id ?? 'No Title' }} 
                            <!-- Add more fields here with proper null checks -->
                        </input> --}}
                    @endforeach
                    
                    
                        
                        <div class="mt-4 flex justify-between">
                            <div class="space-x-2">
                                <button class="px-3 py-1 text-sm text-blue-600 hover:bg-blue-50 rounded-md">Modifier</button>
                                <button class="px-3 py-1 text-sm text-red-600 hover:bg-red-50 rounded-md">Supprimer</button>
                            </div>
                            <button 
                            class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-50 rounded-md view-reservations"
                            data-announcement-id="{{ $announcement->id }}">
                            Réservations
                        </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        
    </div>
</div>
<!-- Modal for displaying Reservations -->


@endsection

@section('scripts')
<script>
document.querySelectorAll('.view-reservations').forEach(button => {
    button.addEventListener('click', function () {
        const announcementId = this.getAttribute('data-announcement-id');
        
        const modal = document.getElementById('reservationsModal');
        modal.classList.remove('hidden');
        
        const reservationsList = document.getElementById('reservationsList');
        reservationsList.innerHTML = '<div class="text-center py-4 text-gray-500">Chargement...</div>';
        
        fetch(`/announcements/${announcementId}/reservations`)
            .then(response => response.json())
            .then(data => {
                reservationsList.innerHTML = '';
                
                if (data.reservations.length > 0) {
                    data.reservations.forEach(reservation => {
                        const reservationItem = document.createElement('div');
                        reservationItem.classList.add('bg-gray-50', 'p-4', 'rounded-lg');
                        
                        const reservationContent = `
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-sm text-gray-500">Lieu de prise en charge : ${reservation.pickup_location}</p>
                                    <p class="text-sm text-gray-500">Passagers: ${reservation.passenger_count}</p>
                                    <p class="text-sm text-gray-500">Statut: ${reservation.status}</p>
                        
                                </div>
                                <div class="flex space-x-2">
                                    <!-- Actions for pending booking -->
                                    ${reservation.status === 'pending' ? `
                                    <div>
                                        <form method="POST" action="/reservations/${reservation.id}/accept">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 text-sm text-white bg-green-600 hover:bg-green-700 rounded-md">Accepter</button>
                                        </form>
                                        <form method="POST" action="/reservations/${reservation.id}/reject">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 text-sm text-white bg-red-600 hover:bg-red-700 rounded-md">Refuser</button>
                                        </form>
                                        
                                    </div>
                                    ` : ''}
                                </div>
                            </div>
                        `;
                        reservationItem.innerHTML = reservationContent;
                        reservationsList.appendChild(reservationItem);
                    });
                } else {
                    reservationsList.innerHTML = '<div class="text-center py-4 text-gray-500">Aucune réservation pour cette annonce</div>';
                }
            });
    });
});

document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('reservationsModal').classList.add('hidden');
});


document.getElementById('createAnnouncement').onclick = function() {
    document.getElementById('showAnnouncementModal').classList.remove('hidden');
}

</script>
@endsection
