@extends('layouts.passenger')

@section('title', 'Historique des trajets')

@section('header', 'Historique des trajets')

@section('content')
<div x-data="tripsHistory()">

    <div class="bg-white rounded-lg shadow p-6 mb-6">
            <form action="" method="POST">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                    <input 
                    name="location"
                        type="text" 
                        placeholder="Rechercher par lieu..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Période</label>
                    <select 
                    name="availability"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                        <option value="all">Toutes les périodes</option>
                        <option value="today">Aujourd'hui</option>
                        <option value="week">Cette semaine</option>
                        <option value="month">Ce mois</option>
                        <option value="year">Cette année</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select 
                        x-model="statusFilter"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                        <option value="">Tous les statuts</option>
                        <option value="completed">Terminé</option>
                        <option value="cancelled">Annulé</option>
                        <option value="pending">En attente</option>
                        <option value="ongoing">En cours</option>
                    </select>
                </div>
            </div>
        </form>
 
    </div>

    <!-- Trips Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                            <div class="flex items-center space-x-1">
                                <span>Date</span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Départ
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Destination
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                            <div class="flex items-center space-x-1">
                                <span>Statut</span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
             
               </thead>
            @forEach($reservations as $reservation)
               <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">

                         @if($reservation->announcement && $reservation->announcement->departure_date)
                                  {{ $reservation->announcement->departure_date }}
                         @else
                                  {{ $reservation->departure_time }} 
                        @endif

                                
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                      {{$reservation->pickup_location}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if($reservation->announcement && $reservation->announcement->trip_end)
                            {{ $reservation->announcement->trip_end }}
                   @else
                            {{ $reservation->destination }} 
                  @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                {{ $reservation->status == 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $reservation->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $reservation->status == 'confirmed' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $reservation->status == 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $reservation->status == 'cancelled' ? 'bg-gray-100 text-gray-800' : '' }}">
                                {{$reservation->status}}
                            </span>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 
                                {{ $reservation->status == 'completed' ? 'hidden' : '' }}
                                {{ $reservation->status == 'rejected' ? 'hidden' : '' }}
                                {{ $reservation->status == 'cancelled' ? 'hidden' : '' }}">
                            <form method="POST" action="{{route("cancel.reservation",$reservation->id)}}">
                                @csrf
                                <button class="text-red-600 hover:text-red-900 font-medium">
                                    cancel
                                </button>
                            </form>
                           
                        </td>
                    </tr>
                                                           
                </tbody>
           
                @endforeach
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
    

    
</div>
@endsection

@section('scripts')
<script>

</script>
@endsection
