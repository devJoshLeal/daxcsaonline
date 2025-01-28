<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class WebController extends Controller
{
    public function dashboard(Request $request){
        return Inertia::render('Dashboard');
    }
    public function orders(){
        return Inertia::render('Orders');
    }
}
