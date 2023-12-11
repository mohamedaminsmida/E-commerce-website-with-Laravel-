<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Commande;
use App\Models\Client;
use App\Models\Produit;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\Vue;

class ProductController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function AddCart(Request $request, $id)
    {
        $request->session()->flush();
        //dd($id);
        $productId = $id; //$request->input('product_id');
        $produit = Produit::findorfail($productId);
        $quantite = 0; //$request->input('quantity', 1);
        $tprix = 0;
        $cartItems = $request->session()->get('cart', []);
        $carts = [];
        if (empty($cartItems)) {
            $cartItems[$productId] = array(
                "quantite" => 1,
                'prix' => $produit->prix,
                'nom' => $produit->nom,
                'description' => $produit->description,
                'image' => $produit->image,
            );
        } else {
            if (array_key_exists($productId, $cartItems))
                $cartItems[$productId]['quantite'] = $cartItems[$productId]['quantite'] + 1;
            else {
                $cartItems[$productId] = array(
                    "quantite" => 1,
                    'prix' => $produit->prix,
                    'nom' => $produit->nom,
                    'description' => $produit->description,
                    'image' => $produit->image,
                );
            }
        }
        //dd($cartItems);
        // if (isset($cartItems[$productId])) {
        //     $cartItems[$productId]['quantite'] = $quantite +  1;
        //     $cartItems[$productId]['totalprix'] = $tprix + $produit->prix;
        // } else {
        //     $cartItems[$productId]['quantite'] = $quantite;
        //     $cartItems[$productId]['nom'] = $produit->nom;
        //     $cartItems[$productId]['prix'] = $produit->prix;
        //     $cartItems[$productId]['description'] = $produit->description;
        //     $cartItems[$productId]['image'] = $produit->image;
        // }

        // $request->session()->put(['cart', $cartItems], ['totalprix', $tprix]);
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice = $totalPrice + $item['prix'] * $item['quantite'];
        }
        $request->session()->put('cart', $cartItems);
        //dd($request->session()->get('cart', []));
        // return View('home');
        //dd($cartItems);
        $produitsdd = Produit::all();
        return redirect()->route('cart.show');
        //return view('carte', ['produits' => $produitsdd, 'cartItems' => $cartItems,'totalprice'=>$totalPrice]);
        return response()->json(['result' => $cartItems, 'produits' => $produitsdd, 'totalprice' => $totalPrice]);
        //dd('$totalPrice');
    }

    public function cart(Request $request)
    {

        $cartItems = $request->session()->get('cart', []);
        $produitsdd = Produit::all();
        // dd($cartItems);
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice = $totalPrice + $item['prix'] * $item['quantite'];
        }
        //dd($totalPrice);
        return view('carte', ['produits' => $produitsdd, 'cartItems' => $cartItems, 'totalprice' => $totalPrice]);
    }





    public function Add(Request $request, $id, $quantite)
    {
        //$request->session()->flush();
        //dd($id);
        $productId = $id; //$request->input('product_id');
        $produit = Produit::findorfail($productId);
        //$request->input('quantity', 1);
        $tprix = 0;
        $cartItems = $request->session()->get('cart', []);
        $carts = [];
        //check if quantite equal 0 unset from cart
        @$cartItems[$productId]['quantite'] = $quantite;
        // dd($quantite);
        $totalPrice = 0;
        $totalquantity = 0;
        foreach ($cartItems as $item) {
            $totalPrice = $totalPrice + $item['prix'] * $item['quantite'];
        }
        foreach ($cartItems as $item) {
            $totalquantity = $totalquantity  + $item['quantite'];
        }
        $request->session()->put('cart', $cartItems);
        //dd($cartItems);
        return response()->json(['result' => $cartItems, 'totalprice' => $totalPrice, 'totalquantity' => $totalquantity]);
    }



    public function home()
    {
        return View('home');
    }

    public function affichercarte(Request $request)
    {
        $cartItems = $request->session()->get('cart', []);
        //dd($cartItems);
        return View('carte', ['cartItems' => $cartItems]);
    }
    public function forgotpassword()
    {
        return View('forgotpassword');
    }
    public function register()
    {
        return View('register');
    }
    public function afficher()
    {
        return View('afficher');
    }
    public function affichertable()
    {
        $produitsdd = Produit::all();
        return View('table', ['produits' => $produitsdd]);
    }
    public function afficherproduits(Request $request)
    {
        $cartItems = $request->session()->get('cart', []);
        // dd($cartItems);
        $produitsdd = Produit::all();
        return View('storehomepage', ['produits' => $produitsdd, 'cartItems' => $cartItems]);
    }
    public function ajouterproduit()
    {
        return View('addproduct');
    }
    public function loginsubmit(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $data['name'] = $request->name;
        $data['password'] = $request->password;
        $alldata = $request->only('email', 'password');
        if (Auth::attempt($alldata)) {
            return redirect()->intended(route('home'));
        }
        return redirect()->route('login')->with('faild', 'sorry this account does not exist in our database !');
    }
    public function registerSubmit(Request $request)
    {
        //dd($request->get('exampleFirstName'));
        $request->validate([
            'FirstName' => 'required',
            'LastName' => 'required',
            'Email' => 'required',
            'Password' => 'required',
            'secondPassword' => 'required',
        ]);
        $data['firstname'] = $request->FirstName;
        $data['lastname'] = $request->LastName;
        $data['email'] = $request->Email;
        $data['password'] = $request->Password;
        $data['password2'] = $request->secondPassword;
        $user = User::create($data);
        if (!$user) {
            return redirect()->route('register')->with('failed', 'session has failed');
        }
        return redirect()->route('login')->with('success ', 'user has been created successfully ! ');
    }
    public function ajouter(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prix' => 'required',
            'quantite' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);

        $data['nom'] = $request->nom;
        $data['prix'] = $request->prix;
        $data['quantite'] = $request->quantite;
        $data['image'] = $request->image;
        $data['description'] = $request->description;
        $produit = Produit::create($data);

        return redirect()->back()->with("success", "produit created");

        $produit = new Produit();
        $produit->nom = $request->nom;

        $produit->save();
    }

    public function modificationProduit($id)
    {
        // $produit = Produit::find($id);

        // $produit = Produit::where('id', $id)->get();

        // dd($produit[0]);
        // $produit = Produit::where('id', $id)->first();
        // dd($produit);
        $produit = Produit::findorfail($id);
        return View('produit_edit', compact('produit'));
    }
    public function modificationProduitPost(Request $request, $id)
    {
        //validate
        $produit = Produit::find($id);
        // $produit->update($data);
        $produit->nom = $request->input('nom');
        $produit->prix = $request->input('prix');
        $produit->quantite = $request->input('quantite');
        if ($request->has('image') && $request->image != "")
            $produit->image = $request->input('image');

        $produit->description = $request->input('description');
        $produit->save();
        return redirect()->route('table');
    }

    public function DeleteProduct($id)
    {
        Produit::destroy($id);
        return redirect()->back()->with('success', '');
    }

    public function MoreDetail(Request $request, $id)
    {
        $cartItems = $request->session()->get('cart', []);
        $produit = Produit::findorfail($id);
        $allproduit = Produit::all();
        $data = ([
            'produit' => 'allproduit'
        ]);
        // dd($request->session()->all());
        return View('detail', compact('produit', 'allproduit'));
    }



    public function affichercommande()
    {
        return View('commande');
    }
   }
