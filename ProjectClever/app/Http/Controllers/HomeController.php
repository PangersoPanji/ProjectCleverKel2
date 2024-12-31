<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $featuredServices = Service::with(['user', 'category'])
            ->where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::where('is_active', true)
            ->withCount('services')
            ->get();

        $topFreelancers = User::where('role', 'freelancer')
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('home', compact('featuredServices', 'categories', 'topFreelancers'));
    }
}