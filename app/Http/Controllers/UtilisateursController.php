<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\utilisateurs;
use Image;

class UtilisateursController extends Controller
{
    //
    public function index()
    {
        //
        return view('page_site.administrateur.register');
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        //$nom = 'nom';
        //$nom = 'email';
        $this->validate($request,[
            'nom' => 'required|min:3',
            'email' => 'required|min:3',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ]);


        $utilisateur = new utilisateurs();
        $utilisateur->nom = request('nom');
        $utilisateur->email = request('email');
        $utilisateur->password = bcrypt(request('password'));
        // debut ajouter une image
        $originalImage = $request->file('image');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path() . '/storage/images/';
        $originalPath = storage_path() . '/app/public/images/';
        $thumbnailImage0 = Image::make($originalImage)->save($originalPath . time() . $originalImage->getClientOriginalName());
        $thumbnailImage0->resize(412,386);
        $thumbnailImage0->save($thumbnailPath . time() . $originalImage->getClientOriginalName());
        $image = time() . $originalImage->getClientOriginalName();
        $utilisateur->image = $image;
        // fin ajouter image

        $utilisateur->save();

        return view('page_site.administrateur.login');
    }
}
