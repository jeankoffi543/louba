<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TypeDocument;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProduitController extends Controller
{

    public function index()
    {
        return view('admin.produit', [
            'produits' => Product::all(),
        ]);
    }


    public static function getlabel($id)
    {
        $type_documents = Product::find($id);
        return $type_documents->nom_type_document;
    }








    public  function insert(Request $request)
    {

        try {



            $request->validate([
                'nom' => 'required|unique:products,nom',
                'form_type' => 'required|in:passport,cni,birth_act',
            ], $this->messages());

            $product = new Product();
            if ($request->hasFile('image')) {
                $file      = $request->file('image');
                $filename  = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $uuid   = (string) Str::uuid() . '.' . $extension;

                // $file->storeAs('products', $uuid);
                $file->storeAs('public/products', $uuid);
                $product->image = Storage::url('products/' . $uuid);
            }

            $product->nom = $request->nom;
            $product->prix = $request->prix;
            $product->description = $request->description;
            $product->flow_enable = $request->flow_enable;
            $product->select_service_is_required = $request->select_service_is_required;
            $product->is_active = $request->activation;

            $product->save();

            return redirect()->route("products")->with('success_message', 'Produit enregistrer');
        } catch (Exception $e) {
            dd($e);
        }
    }


    public function messages()
    {
        return [
            'nom.required' => 'Le champ nom est obligatoire.',
            'nom.unique' => 'Le nom du produit doit être unique.',
        ];
    }

    //
    public  function update(Request $request, Product $product)
    {

        try {

            $baseUrl = "http://localhost:8000/storage";
            $path = str_replace($baseUrl, '', $product->image);

            $fileExists = Storage::exists($path);
            if ($request->hasFile('image')) {

                if ($fileExists) {
                    Storage::delete($path);
                }


                $file      = $request->file('image');
                $filename  = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $uuid   = (string) Str::uuid() . '.' . $extension;

                $file->storeAs('products', $uuid);
                $product->image = Storage::url('products/' . $uuid);
            }

            $product->nom = $request->nom;
            $product->prix = $request->prix;
            $product->description = $request->description;
            $product->is_active = $request->activation;
            $product->flow_enable = $request->flow_enable;
            $product->select_service_is_required = $request->select_service_is_required;
            $product->form_type = $request->form_type;
            $product->update();

            return redirect()->route("products")->with('success_message', 'Produit mis à jour');
        } catch (Exception $e) {
            dd($e);
        }
    }



    public function deleteFile($fileLink)
    {

        if (Storage::delete('public/' . $fileLink)) {

            Storage::delete('public/' . $fileLink);
        } else {
        }
    }
}
