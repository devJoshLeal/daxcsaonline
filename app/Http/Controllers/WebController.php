<?php

namespace App\Http\Controllers;

use App\Services\WebTokenService;
use Inertia\Inertia;


class WebController extends Controller
{
    public function dashboard(){
        return Inertia::render('Dashboard');
    }
    //Renders Orders View
    public function orders(){
        $webToken=WebTokenService::manageToken();
        return Inertia::render('Orders',["token"=>$webToken]);
    }
}
