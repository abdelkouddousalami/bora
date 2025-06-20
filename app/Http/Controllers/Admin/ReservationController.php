<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user', 'fishingTour'])
            ->latest()
            ->paginate(10);
        return view('dashboard.reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        return view('dashboard.reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        return view('dashboard.reservations.edit', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
            'notes' => 'nullable|string|max:500',
        ]);

        $reservation->update($validated);

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservation updated successfully');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservation deleted successfully');
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        $reservation->update($validated);

        return redirect()->back()
            ->with('success', 'Reservation status updated successfully');
    }
}
