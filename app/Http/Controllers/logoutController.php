<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\utilisateurs;
use Auth;

class logoutController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        auth()->logout();

        return view('page_site.contacte');

    }
}
