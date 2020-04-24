<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services;
use Flashy;
use Image;
use Auth;

class ServiceController extends Controller
{
    //
    public function index()
    {
        if(auth()->guest()) {
            return redirect('/login')->withErrors([
                'pseudo' => "vous dever etre connecter pour voir cette page",
            ]);
        }else{
            $utilisateur = Auth()->user();
            $services = Services::get();
            return view('page_site.administrateur.AjoutService',compact('utilisateur','services'));
        }
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'logo' => 'required',
            'titre' => 'required',
            'detaille' => 'required',
        ]);

        $utilisateur = auth()->user();
        $service = new Services();

        // debut ajouter une image
        $originalImage = $request->file('logo');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path() . '/storage/images/';
        $originalPath = storage_path() . '/app/public/images/';
        $thumbnailImage0 = Image::make($originalImage)->save($originalPath . time() . $originalImage->getClientOriginalName());
        $thumbnailImage0->resize(412,386);
        $thumbnailImage0->save($thumbnailPath . time() . $originalImage->getClientOriginalName());
        $image = time() . $originalImage->getClientOriginalName();
        $service->image = $image;
        // fin ajouter image
        $service->titre = request('titre');
        $service->detail = request('detaille');

        $service->save();

        //return redirect()->back();
        $utilisateur = Auth()->user();
        $services = Services::get();
        flashy()->success('service ajouter avec succes.', 'http://your-awesome-link.com');
        return view('page_site.administrateur.AjoutService',compact('utilisateur','services'));
    }

    public function suprimer(Request $request)
    {
        if(auth()->guest()) {
            return redirect('/login')->withErrors([
                'pseudo' => "vous dever etre connecter pour voir cette page",
            ]);
        }else{
            $id = $request->idS;
            Services::find($id)->delete();
            $utilisateur = Auth()->user();
            $services = Services::get();
            flashy()->success('service suprimer avec succes.', 'http://your-awesome-link.com');
            return view('page_site.administrateur.AjoutService',compact('utilisateur','services'));
        }
    }
}
