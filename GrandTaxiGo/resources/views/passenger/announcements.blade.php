@extends('layouts.passenger')

@section('title', 'Annonces des chauffeurs')

@section('header', 'Annonces des chauffeurs')

@section('content')
<div x-data="announcementsPage()">
    <!-- Search and Filter Section -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <form action="{{route('filtered.drivers')}}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-24">

            <div>
                <label class="block text-sm font-medium text-gray-700 mt-3"></label>
                <input 
                name="location"
                    type="text" 
                    placeholder="Rechercher par lieu de depart"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mt-3 "></label>
               <button 
             
               type="submit" 
                class="w-32 bg-blue-700 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"">
                Rechercher
               </button>
            </div>
        </div>

        </form>
    </div>

    <!-- Announcements Grid -->
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($announcements as $announcement)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Image (if available) -->
                @if ($announcement->image)
                    <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}" class="w-full h-48 object-cover">
                @endif
    
                <!-- Content -->
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $announcement->title }} </h3>
                        <span 
                            class="px-2 py-1 text-xs font-semibold rounded-full 
                            @if($announcement->status === 'open') bg-green-100 text-green-800
                            @elseif($announcement->status === 'reserved') bg-yellow-100 text-yellow-800
                            @elseif($announcement->status === 'completed') bg-blue-100 text-blue-800
                            @elseif($announcement->status === 'cancelled') bg-red-100 text-red-800
                            @endif"
                        >
                            {{ ucfirst($announcement->status) }}
                        </span>
                    </div>
    
                    <p class="text-gray-600 mb-4">{{ $announcement->description }}</p>
    
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm">
                            <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-gray-700">Départ: {{ $announcement->trip_start }}</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-gray-700">Arrivée: {{ $announcement->trip_end }}</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <span class="text-gray-700">Places max: {{ $announcement->max_passengers }}</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-gray-700">Départ: {{ \Carbon\Carbon::parse($announcement->departure_date)->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-gray-700">Expire le: {{ \Carbon\Carbon::parse($announcement->expiration_date)->format('d M Y') }}</span>
                        </div>
                    </div>
    
                    <button id="openReservationModal" data-annonce="{{ $announcement->id }}" data-driver="{{ $announcement->driver_id }}"
                        class="openReservationModal w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        Réserver maintenant
                    </button>
                </div>
            </div>
            @endforeach
    </div>
    
    <!-- Booking Modal -->
    
<!-- Modal Structure -->
<div 
    id="bookingModal" 
    class="bookingModal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden"
>
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-gray-900">Réserver un trajet</h3>
                <button id="close_reservation"  class="text-gray-400 hover:text-gray-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form class="space-y-4" method="POST" action="{{route('reservations.create')}}">
                @csrf
                <input name="announcement_id" type="hidden" id="id_annonce">
                <input name="driver_id" type="hidden" id="id_driver">
                

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Lieu de prise en charge
                    </label>
                    <input  name="pickup_location"
                        type="text" 
                        placeholder="Entrez l'adresse exacte"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        required
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nombre de passagers (max:4)</label>
                    <input name="passengers_nbr" type="number" x-model="currentAnnouncement.maxPassengers" min="1" max="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Informations supplémentaires
                    </label>
                    <textarea 
                        rows="3"
                        placeholder="Bagages, besoins spéciaux, etc."
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    ></textarea>
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <!-- Cancel Button -->
                    <button 
                        type="button" 
                        class="close_model px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                    >
                        Annuler
                    </button>
                    <!-- Confirm Button -->
                    <button 
                        type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Confirmer la réservation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>




document.getElementById('openReservationModal').onclick = function() {
    document.getElementById('bookingModal').classList.remove('hidden');
};


const closeButtons = document.querySelectorAll('.close_model, #close_reservation');
closeButtons.forEach(button => {
    button.onclick = function() {
        document.getElementById('bookingModal').classList.add('hidden');
    };
});


// const btnOpenModal = document.querySelectorAll('.openReservationModal');


// const modal = document.getElementById('bookingModal');

// btnOpenModal.forEach(btn => {
//     btn.addEventListener('click',function(){
//         modal.classList.remove('hidden');
//         document.getElementById('id_annonce').value = btn.dataset.annonce;
//         document.getElementById('id_driver').value = btn.dataset.driver;
//     });
    
    document.querySelectorAll('.openReservationModal').forEach(btn=>{
        btn.onclick=function(){
            document.getElementById('bookingModal').classList.remove('hidden');
            document.getElementById('id_annonce').value = btn.dataset.annonce;
            document.getElementById('id_driver').value = btn.dataset.driver;
        }
    })
  
// });


</script>
@endsection
