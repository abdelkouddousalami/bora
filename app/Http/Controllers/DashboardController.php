<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Reservation;
use App\Models\FishingTour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function index(): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        
        if ($user->role === User::ROLE_ADMIN) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.reservations');
    }

    public function userReservations(): View
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
            
        return view('dashboard.user', compact('reservations'));
    }    public function adminDashboard(): View
    {
        // Basic statistics
        $totalUsers = User::where('role', User::ROLE_USER)->count();
        $totalReservations = Reservation::count();
        $totalTours = FishingTour::count();
        $totalServices = Service::count();

        // Revenue statistics
        $monthlyRevenue = Reservation::where('status', 'confirmed')
            ->whereNotNull('price')
            ->whereMonth('created_at', now()->month)
            ->sum('price');

        $totalRevenue = Reservation::where('status', 'confirmed')
            ->whereNotNull('price')
            ->sum('price');

        // Recent activity (last 10 records)
        $recentActivity = Reservation::with('user')
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($reservation) {
                return (object)[
                    'created_at' => $reservation->created_at,
                    'user' => $reservation->user,
                    'description' => 'Made a reservation for ' . ($reservation->fishingTour->name ?? 'a tour'),
                    'status' => $reservation->status,
                    'status_color' => match($reservation->status) {
                        'confirmed' => 'success',
                        'pending' => 'warning',
                        'cancelled' => 'danger',
                        default => 'secondary'
                    }
                ];
            });

        // Monthly reservations data for chart
        $monthlyReservations = Reservation::selectRaw('DATE_FORMAT(created_at, "%b") as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('created_at')
            ->pluck('count', 'month')
            ->toArray();

        // Popular tours data for chart
        $popularTours = FishingTour::withCount('reservations')
            ->orderByDesc('reservations_count')
            ->take(5)
            ->get()
            ->pluck('reservations_count', 'name')
            ->toArray();

        return view('dashboard.admin', compact(
            'totalUsers',
            'totalReservations',
            'totalTours',
            'totalServices',
            'monthlyRevenue',
            'totalRevenue',
            'recentActivity',
            'monthlyReservations',
            'popularTours'
        ));
    }    public function getUsers(): View
    {
        $users = User::where('role', User::ROLE_USER)
            ->withCount('reservations')
            ->latest()
            ->get();
            
        return view('dashboard.users', compact('users'));
    }

    public function adminReservations(): View
    {
        $reservations = Reservation::with('user')
            ->latest()
            ->paginate(10);
        
        return view('dashboard.admin.reservations', compact('reservations'));
    }

    public function updateReservationStatus(Request $request, Reservation $reservation): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:pending,confirmed,cancelled']
        ]);

        $reservation->update([
            'status' => $validated['status']
        ]);

        return back()->with('success', 'Reservation status updated successfully.');
    }

    public function deleteReservation(Reservation $reservation): RedirectResponse
    {
        $reservation->delete();
        return back()->with('success', 'Reservation deleted successfully.');
    }
}
