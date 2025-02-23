@extends('layouts.driver')

@section('title', 'Gérer ma disponibilité')
@section('header', 'Gérer ma disponibilité')

@section('content')
<div x-data="availabilityPage">
    <div class="max-w-4xl mx-auto">
    @if($availability==false)
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Statut actuel</h2>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <span class="w-3 h-3 rounded-full bg-red-500"></span> 
                    <span class="text-gray-700">Non disponible</span> 
                </div>
                <form action="{{route('change.availability')}}" method="POST">
                    @csrf
                    <button 
                    class="px-4 py-2 text-sm font-medium rounded-md bg-green-100 text-green-700 hover:bg-green-200">
                    Marquer comme disponible
                </button>
                </form>
                
            </div>
        </div>
@elseif($availability==true)
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Statut actuel</h2>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <span class="w-3 h-3 rounded-full bg-green-500"></span> 
                    <span class="text-gray-700">disponible</span> 
                </div>
                <form action="{{route('change.availability')}}" method="POST">
                    @csrf
                    <button 
                    class="px-4 py-2 text-sm font-medium rounded-md bg-red-100 text-red-700 hover:bg-red-200">
                    Marquer comme non disponible
                </button>
                </form>
                
            </div>
        </div>
@endif 

        <!-- Weekly Schedule -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Horaires hebdomadaires</h2>
            
            <!-- Schedule Form -->
            <div class="space-y-6">
                <template x-for="(schedule, day) in weeklySchedule" :key="day">
                    <div class="border-b border-gray-200 pb-4 last:border-b-0 last:pb-0">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <input 
                                    type="checkbox" 
                                    :id="'enabled-' + day"
                                    x-model="schedule.enabled"
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                >
                                <label :for="'enabled-' + day" class="text-gray-700 font-medium" x-text="getDayName(day)"></label>
                            </div>
                            <button 
                                @click="addTimeSlot(day)"
                                x-show="schedule.enabled"
                                class="text-sm text-blue-600 hover:text-blue-700"
                            >
                                + Ajouter un créneau
                            </button>
                        </div>
                        
                        <div x-show="schedule.enabled" class="space-y-3">
                            <template x-for="(slot, index) in schedule.timeSlots" :key="index">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 grid grid-cols-2 gap-4">
                                        <div>
                                            <label :for="'start-' + day + '-' + index" class="block text-sm font-medium text-gray-700">Début</label>
                                            <input 
                                                type="time" 
                                                :id="'start-' + day + '-' + index"
                                                x-model="slot.start"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            >
                                        </div>
                                        <div>
                                            <label :for="'end-' + day + '-' + index" class="block text-sm font-medium text-gray-700">Fin</label>
                                            <input 
                                                type="time" 
                                                :id="'end-' + day + '-' + index"
                                                x-model="slot.end"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            >
                                        </div>
                                    </div>
                                    <button 
                                        @click="removeTimeSlot(day, index)"
                                        class="text-red-600 hover:text-red-700"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Save Button -->
            <div class="mt-6">
                <button 
                    @click="saveSchedule"
                    class="w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md"
                >
                    Enregistrer les modifications
                </button>
            </div>
        </div>

        <!-- Break Time Settings -->
        <div class="bg-white rounded-lg shadow-sm p-6 mt-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Paramètres de pause</h2>
            <div class="space-y-4">
                <div>
                    <label class="flex items-center">
                        <input 
                            type="checkbox" 
                            x-model="breakSettings.autoBreak"
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                        >
                        <span class="ml-2 text-gray-700">Activer les pauses automatiques</span>
                    </label>
                </div>
                <div x-show="breakSettings.autoBreak" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Durée de pause après chaque trajet</label>
                        <div class="mt-1 flex items-center space-x-2">
                            <input 
                                type="number" 
                                x-model="breakSettings.duration"
                                min="0"
                                class="block w-24 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                            <span class="text-gray-500">minutes</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pause déjeuner</label>
                        <div class="mt-1 grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs text-gray-500">Début</label>
                                <input 
                                    type="time" 
                                    x-model="breakSettings.lunchBreak.start"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                >
                            </div>
                            <div>
                                <label class="block text-xs text-gray-500">Fin</label>
                                <input 
                                    type="time" 
                                    x-model="breakSettings.lunchBreak.end"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('availabilityPage', () => ({
        isAvailable: true,
        weeklySchedule: {
            monday: { enabled: true, timeSlots: [{ start: '09:00', end: '17:00' }] },
            tuesday: { enabled: true, timeSlots: [{ start: '09:00', end: '17:00' }] },
            wednesday: { enabled: true, timeSlots: [{ start: '09:00', end: '17:00' }] },
            thursday: { enabled: true, timeSlots: [{ start: '09:00', end: '17:00' }] },
            friday: { enabled: true, timeSlots: [{ start: '09:00', end: '17:00' }] },
            saturday: { enabled: false, timeSlots: [] },
            sunday: { enabled: false, timeSlots: [] }
        },
        breakSettings: {
            autoBreak: true,
            duration: 15,
            lunchBreak: {
                start: '12:00',
                end: '13:00'
            }
        },

        init() {
            // Load saved schedule from storage if exists
            const savedSchedule = localStorage.getItem('weeklySchedule');
            if (savedSchedule) {
                this.weeklySchedule = JSON.parse(savedSchedule);
            }

            const savedBreakSettings = localStorage.getItem('breakSettings');
            if (savedBreakSettings) {
                this.breakSettings = JSON.parse(savedBreakSettings);
            }
        },

        toggleAvailability() {
            this.isAvailable = !this.isAvailable;
            Alpine.store('driver').setAvailability(this.isAvailable);
        },

        getDayName(day) {
            const days = {
                monday: 'Lundi',
                tuesday: 'Mardi',
                wednesday: 'Mercredi',
                thursday: 'Jeudi',
                friday: 'Vendredi',
                saturday: 'Samedi',
                sunday: 'Dimanche'
            };
            return days[day];
        },

        addTimeSlot(day) {
            this.weeklySchedule[day].timeSlots.push({
                start: '09:00',
                end: '17:00'
            });
        },

        removeTimeSlot(day, index) {
            this.weeklySchedule[day].timeSlots.splice(index, 1);
        },

        saveSchedule() {
            // Save to localStorage (in a real app, this would be an API call)
            localStorage.setItem('weeklySchedule', JSON.stringify(this.weeklySchedule));
            localStorage.setItem('breakSettings', JSON.stringify(this.breakSettings));

            // Show success message
            alert('Vos horaires ont été enregistrés avec succès !');
        }
    }));
});
</script>
@endsection
