<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use App\Models\Category;
use App\Models\Project;
class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_freelancers' => User::where('role', 'freelancer')->count(),
            'total_clients' => User::where('role', 'client')->count(),
            'total_services' => Service::count(),
            'total_categories' => Category::count(),
            'total_projects' => Project::count(),
            'recent_users' => User::latest()->take(5)->get(),
            'recent_services' => Service::with('user', 'category')->latest()->take(5)->get(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
}