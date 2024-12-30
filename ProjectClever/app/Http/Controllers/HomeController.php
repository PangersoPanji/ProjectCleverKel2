<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {

        return view('home');
    }
}
