<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AnnouncementController extends Controller
{
    // Afficher toutes les annonces actives
    public function index()
    {
        $announcements = Announcement::where('expires_at', '>', now())
                                    ->orWhereNull('expires_at')
                                    ->get();

        return view('announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('announcements.create');
    }

    public function storeAnnouncement(Request $request)
    {
        // dd($request);
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'content' => 'required|string',
        //     'published_at' => 'required|date',
        //     'expires_at' => 'nullable|date|after_or_equal:published_at',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        //     'trip_start' => 'nullable|string|max:255',
        //     'trip_end' => 'nullable|string|max:255',
        // ]);

        // dd($request);

        $announcement = new Announcement();
        $announcement->title = $request->title;
        $announcement->centent = $request->content;
        $announcement->departure_date = $request->departure_date;
        $announcement->expires_at = $request->expires_at;
        $announcement->trip_start = $request->trip_start;
        $announcement->trip_end = $request->trip_end;
        $announcement->max_passengers = $request->max_passengers;

        $announcement->driver_id = Auth::id();

        if ($request->hasFile('image')) {
            $announcement->image =  $request->file('image')->store('image', 'public');
        }
        else {
            $announcement->image = null;  
        }
        // dd($announcement);
        $announcement->save();

        return redirect()->route('driver.announcements')->with('success', 'Annonce créée avec succès.');
    }

    

    // Supprimer une annonce
   



 








}

