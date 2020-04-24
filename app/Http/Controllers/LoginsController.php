<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flashy;
use App\utilisateurs;
use Auth;

class LoginsController extends Controller
{
    //
    public function index()
    {
        //
        return view('page_site.administrateur.login');
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        /*$this->validate($request,[
            'email' => 'required|min:3',
            'password' => 'required|min:6',
        ]);*/

        $resultat = Auth::attempt([
            'email' => $request ->email,
            'password' => $request ->password
        ]);

        $utilisateur = Auth()->user();
        if($resultat){
            //Flashy::success('log in succes yesssssss', 'http://your-awesome-link.com');
            flashy()->success('You have been logged in.', 'http://your-awesome-link.com');
            return view('page_site.administrateur.Acceuil',compact('utilisateur'));
        } else{
            flashy()->error('identifient invalide', 'http://your-awesome-link.com');
            return redirect()->back();
        }


    }
}
