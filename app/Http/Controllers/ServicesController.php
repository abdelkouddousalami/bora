<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\FishingTour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{    public function index()
    {
        $fishingTours = FishingTour::where('category', 'fishing')->get();
        $excursions = FishingTour::where('category', 'excursion')->get();
        $isAdmin = Auth::check() && Auth::user()->role === 'admin';
        
        return view('services', compact('fishingTours', 'excursions', 'isAdmin'));
    }
}
