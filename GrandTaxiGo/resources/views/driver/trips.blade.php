@extends('layouts.driver')

@section('title', 'Historique des trajets')
@section('header', 'Historique des trajets')

@section('content')
<div x-data="tripsPage">
    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Date Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Période</label>
                <select 
                    x-model="filters.dateRange"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                >
                    <option value="today">Aujourd'hui</option>
                    <option value="week">Cette semaine</option>
                    <option value="month">Ce mois</option>
                    <option value="year">Cette année</option>
                    <option value="all">Tout</option>
                </select>
            </div>

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                <select 
                    x-model="filters.status"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                >
                    <option value="">Tous les statuts</option>
                    <option value="completed">Terminé</option>
                    <option value="cancelled">Annulé</option>
                    <option value="ongoing">En cours</option>
                </select>
            </div>

            <!-- Search -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                <input 
                    type="text"
                    x-model="filters.search"
                    placeholder="Nom du passager, lieu..."
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                >
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <!-- Total Trips -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total des trajets</p>
                    <p class="text-lg font-semibold text-gray-900">{{$allReservation}}</p> <!-- Replace 123 with dynamic value -->
                </div>
            </div>
        </div>
    
        <!-- Completed Trips -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Trajets terminés</p>
                    <p class="text-lg font-semibold text-gray-900">{{$completedReservation}}</p> <!-- Replace 45 with dynamic value -->
                </div>
            </div>
        </div>
    
        <!-- Cancelled Trips -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Trajets annulés</p>
                    <p class="text-lg font-semibold text-gray-900">{{$cancelledReservation}}</p> <!-- Replace 7 with dynamic value -->
                </div>
            </div>
        </div>
    
        <!-- Total Revenue -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Trajets Refusés</p>
                    <p class="text-lg font-semibold text-gray-900">{{$rejecteddReservation}}</p> <!-- Replace with dynamic value, e.g., formatCurrency(stats.totalRevenue) -->
                </div>
            </div>
        </div>
    </div>
    

    <!-- Trips Table -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date de départ
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Passager
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Trajet
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($reservations as $reservation)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if($reservation->announcement && $reservation->announcement->departure_date)
                                {{ $reservation->announcement->departure_date }}
                            @else
                                {{ $reservation->departure_time }} 
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    @if ($reservation->passenger->profile_picture)
                                        <img class="h-8 w-8 rounded-full" src="{{ asset('storage/' . $reservation->passenger->profile_picture) }}" alt="{{ $reservation->passenger->f_name }} {{ $reservation->passenger->l_name }}">
                                    @else
                                        <img class="h-8 w-8 rounded-full" src="https://via.placeholder.com/150" alt="Passager Name">
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $reservation->passenger->f_name }} {{ $reservation->passenger->l_name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                @if($reservation->announcement && $reservation->announcement->trip_end)
                                    {{ $reservation->announcement->trip_start }} → {{ $reservation->announcement->trip_end }}
                                @else
                                    {{ $reservation->pickup_location }} → {{ $reservation->destination }}
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ 
                                $reservation->status == 'completed' ? 'bg-green-100 text-green-800' : 
                                ($reservation->status == 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ $reservation->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if($reservation->status == 'pending')
                            <div class="flex gap-4">
                                <form method="POST" action="{{ route('accept.reservation', $reservation->id) }}">
                                    @csrf
                                    <button class="text-green-600 hover:text-green-900 font-medium">
                                        Accepter
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('reject.reservation', $reservation->id) }}">
                                    @csrf
                                    <button class="text-red-600 hover:text-red-900 font-medium">
                                        Rejeter
                                    </button>
                                </form>

                            </div>
                               
                            @elseif($reservation->status == 'confirmed')
                                <form method="POST" action="{{ route('complet.reservation', $reservation->id) }}">
                                    @csrf
                                    <button class="text-blue-600 hover:text-blue-900 font-medium">
                                        Compléter
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>

                    @endforeach
                </tbody>
                @if (session('error'))
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-red-500">
                        {{ session('error') }}
                    </td>
                </tr>
            @endif
            </table>
            
        </div>
    </div>
    
    <!-- Trip Details Modal -->
    <div x-show="showTripModal" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showTripModal = false"></div>
            <div class="relative bg-white rounded-lg max-w-2xl w-full">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Détails du trajet</h3>
                    <template x-if="selectedTrip">
                        <div class="space-y-4">
                            <!-- Trip Info -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Date</p>
                                    <p class="text-sm text-gray-900" x-text="formatDate(selectedTrip.date)"></p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Statut</p>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                        :class="{
                                            'bg-green-100 text-green-800': selectedTrip.status === 'completed',
                                            'bg-red-100 text-red-800': selectedTrip.status === 'cancelled',
                                            'bg-yellow-100 text-yellow-800': selectedTrip.status === 'ongoing'
                                        }"
                                        x-text="selectedTrip.status">
                                    </span>
                                </div>
                            </div>

                            <!-- Passenger Info -->
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-2">Passager</p>
                                <div class="flex items-center">
                                    <img class="h-10 w-10 rounded-full" :src="selectedTrip.passengerAvatar" :alt="selectedTrip.passengerName">
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900" x-text="selectedTrip.passengerName"></p>
                                        <p class="text-sm text-gray-500" x-text="selectedTrip.passengerPhone"></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Trip Route -->
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-2">Itinéraire</p>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="3" stroke-width="2"/>
                                        </svg>
                                        <p class="text-sm text-gray-900" x-text="selectedTrip.startLocation"></p>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        </svg>
                                        <p class="text-sm text-gray-900" x-text="selectedTrip.endLocation"></p>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500 mt-2" x-text="selectedTrip.distance + ' km'"></p>
                            </div>

                            <!-- Payment Info -->
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-2">Paiement</p>
                                <p class="text-lg font-semibold text-gray-900" x-text="formatCurrency(selectedTrip.amount)"></p>
                                <p class="text-sm text-gray-500" x-text="selectedTrip.paymentMethod"></p>
                            </div>
                        </div>
                    </template>
                    <div class="mt-6 flex justify-end">
                        <button @click="showTripModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 border border-gray-300 rounded-md">
                            Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>

</script>
@endsection
