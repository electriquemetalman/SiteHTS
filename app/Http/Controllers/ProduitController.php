<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produits;
use Flashy;
use Image;
use Auth;

class ProduitController extends Controller
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
            $produits = Produits::get();
            return view('page_site.administrateur.AjoutProduit',compact('utilisateur','produits'));
        }
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'logo' => 'required',
            'nom' => 'required',
            'detaille' => 'required',
            'version' => 'required',
        ]);

        $produit = new Produits();

        // debut ajouter une image
        $originalImage = $request->file('logo');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path() . '/storage/images/';
        $originalPath = storage_path() . '/app/public/images/';
        $thumbnailImage0 = Image::make($originalImage)->save($originalPath . time() . $originalImage->getClientOriginalName());
        $thumbnailImage0->resize(412,386);
        $thumbnailImage0->save($thumbnailPath . time() . $originalImage->getClientOriginalName());
        $image = time() . $originalImage->getClientOriginalName();
        $produit->image = $image;
        // fin ajouter image
        $produit->nom = request('nom');
        $produit->detail = request('detaille');
        $produit->version = request('version');

        $produit->save();

        $utilisateur = Auth()->user();
        $produits = Produits::get();
        flashy()->success('produit ajouter avec succes.', 'http://your-awesome-link.com');
        return view('page_site.administrateur.AjoutProduit',compact('utilisateur','produits'));
    }

    public function suprimer(Request $request)
    {
        if(auth()->guest()) {
            return redirect('/login')->withErrors([
                'pseudo' => "vous dever etre connecter pour voir cette page",
            ]);
        }else{
            $id = $request->idP;
            Produits::find($id)->delete();
            $utilisateur = Auth()->user();
            $produits = Produits::get();
            flashy()->success('produit suprimer avec succes.', 'http://your-awesome-link.com');
            return view('page_site.administrateur.AjoutProduit',compact('utilisateur','produits'));
        }
    }
}
