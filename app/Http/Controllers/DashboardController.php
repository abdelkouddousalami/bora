<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation;
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
        // Get statistics
        $totalUsers = User::where('role', User::ROLE_USER)->count();
        $totalMessages = 0; // You'll need to implement message functionality
        $totalReservations = Reservation::count();        $monthlyRevenue = Reservation::where('status', 'confirmed')
            ->whereNotNull('price')
            ->whereMonth('created_at', now()->month)
            ->sum('price');

        $totalRevenue = Reservation::where('status', 'confirmed')
            ->whereNotNull('price')
            ->sum('price');        // Get all users
        $allUsers = User::where('role', User::ROLE_USER)
            ->withCount('reservations')
            ->latest()
            ->get();

        // Get latest users for stats card
        $latestUsers = $allUsers->take(5);

        // Get all reservations with user info
        $allReservations = Reservation::with('user')
            ->latest()
            ->get();

        // Get latest reservations for stats card
        $latestReservations = $allReservations->take(5);

        // Get user growth data for chart
        $userGrowth = User::where('role', User::ROLE_USER)
            ->selectRaw('DATE_FORMAT(created_at, "%b") as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('created_at')
            ->pluck('count', 'month')
            ->toArray();        // Get reservation status data for chart
        $reservationStats = Reservation::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();        $stats = [
            'total' => Reservation::count(),
            'total_users' => User::where('role', User::ROLE_USER)->count(),
            'active' => Reservation::where('status', 'confirmed')
                ->where('date', '>=', now())
                ->count(),
            'pending' => Reservation::where('status', 'pending')->count(),
            'cancelled' => Reservation::where('status', 'cancelled')->count(),
            'revenue' => $totalRevenue
        ];

        return view('dashboard.admin', compact(
            'totalUsers',
            'totalMessages',
            'totalReservations',
            'monthlyRevenue',
            'latestUsers',
            'allUsers',
            'latestReservations',
            'allReservations',
            'userGrowth',
            'reservationStats'
        ));
    }    public function getUsers(): View
    {
        $users = User::where('role', User::ROLE_USER)
            ->withCount('reservations')
            ->latest()
            ->get();
            
        return view('dashboard.users', compact('users'));
    }

    public function updateReservationStatus(Request $request, Reservation $reservation): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        $reservation->update($validated);

        return back()->with('success', __('Reservation status updated successfully.'));
    }

    public function deleteReservation(Reservation $reservation): RedirectResponse
    {
        $reservation->delete();
        return back()->with('success', __('Reservation deleted successfully.'));
    }
}
