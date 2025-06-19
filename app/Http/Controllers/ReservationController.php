<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservation');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'tour_type' => 'required|string',
            'date' => 'required|date|after:today',
            'guests' => 'required|integer|min:1',
            'message' => 'nullable|string',
        ]);

        // Set the user_id if user is authenticated
        if (Auth::check()) {
            $validated['user_id'] = Auth::id();
        }
        
        $validated['status'] = 'pending';
        
        $reservation = Reservation::create($validated);

        return redirect()->back()->with('success', trans('home.reservation.success_message'));
    }
}
