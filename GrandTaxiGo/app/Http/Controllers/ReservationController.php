<?php



namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Announcement;
use App\Models\Passenger;
use App\Models\Reservation;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{









public function accept($id){
    $reservation=Reservation::with('Announcement')->findOrFail($id);
    $now = Carbon::now();
    if($reservation->announcement && $reservation->announcement->departure_date){
        if ($now->greaterThanOrEqualTo($reservation->Announcement->departure_date)) {
        
            return redirect()->back()->with('error', 'Vous ne pouvez plus annuler la réservation, l\'heure de départ est déjà passée.');
        }
    }
    elseif ($now->greaterThanOrEqualTo($reservation->departure_time)) {
        
            return redirect()->back()->with('error', 'Vous ne pouvez plus annuler la réservation, l\'heure de départ est déjà passée.');
        }
    $reservation->update(['status'=>"confirmed"]);
    return to_route('driver.trips')->with('message','la reservation est acceptée');
}


public  function complet($id){
    $reservation=Reservation::with('Announcement')->findOrFail($id);
    $now = Carbon::now();
    if($reservation->announcement && $reservation->announcement->departure_date){
        if ($now>($reservation->Announcement->departure_date)) {
        
            return redirect()->back()->with('error', "Vous ne pouvez pas marquer cette réservation comme complétée, l'heure de départ est dans le futur.");
        }
    }
    elseif ($now>($reservation->departure_time)) {
        
        return redirect()->back()->with('error', "Vous ne pouvez pas marquer cette réservation comme complétée, l'heure de départ est dans le futur.");
    }
    $reservation->update(['status'=>'completed']);
    return to_route('driver.trips')->with('message','la reservation est completée');
}

public function reject($id)
{
    $reservation = Reservation::findOrFail($id);
    $reservation->update(['status' => 'rejected']);
    
    return redirect()->route('driver.announcements')->with('status', 'Réservation refusée.');
}


public function showPassengerReservations(){
    $reservations=Reservation::with('Announcement')->where('passenger_id',Auth::id())->get();
    $profile=user::where('id',auth()->id())->get();

return view('passenger.trips',compact('reservations','profile'));

}

public function showDriverReservations(){

    $reservations=Reservation::with('Passenger','Announcement')->where('driver_id',Auth::id())->get();
    $allReservation=Reservation::all()->count();
    $completedReservation=Reservation::where('status','completed')->count();
    $rejecteddReservation=Reservation::where('status','rejected')->count();
    $cancelledReservation=Reservation::where('status','cancelled')->count();
    $profile=user::where('id',auth()->id())->get();

return view('driver.trips',compact('reservations','profile','allReservation','cancelledReservation','rejecteddReservation','completedReservation'));

}




    public function index()
    {
        $reservations = auth()->user()->reservations;

        return view('/driver/announcements', compact('reservations'));
    }


    // Annuler une réservation (par un passager)
    // public function cancelRsv(Reservation $reservation)
    // {
    //     if (auth()->user()->can('cancel_reservation')) {
    //         if ($reservation->departure_time > now()->addHour()) {
    //             $reservation->cancel();
    //         } else {
    //             return response()->json(['error' => 'La réservation ne peut plus être annulée.'], 400);
    //         }
    //     } else {
    //         return response()->json(['error' => 'Vous n\'avez pas la permission d\'annuler cette réservation.'], 403);
    //     }
        // if ($reservation->passenger_id !== auth()->id() || $reservation->status === 'completed') {
        //     return redirect()->route('reservations.index')->with('error', 'Impossible d\'annuler cette réservation.');
        // }

        // $reservation->update(['status' => 'cancelled']);

        // return redirect()->route('reservations.index')->with('success', 'Réservation annulée.');
    // }

 


  
}


