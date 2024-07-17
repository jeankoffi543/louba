<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Actuality;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContenuSiteWebController extends Controller
{


    public static function get_content_web_site($tagdur)
    {
        $contenusiteweb = DB::table('contenu_site')
            ->where('tagdur', $tagdur)
            ->first();
        return $contenusiteweb;
    }


    // ============================== begin article ================================


    public static function getdata_article($type)
    {
        return response()->json(DB::table('contenu_site')
            ->where('type', $type)
            ->get());
    }

    public static function get_one_articles($id)
    {
        $actualite = DB::table('contenu_site')
            ->where('id', $id)
            ->first();

        return response()->json($actualite);
    }

    public static function get_articles_paginate($type, Request $request)
    {
        $page = $request->page ?? 1;
        $size = $request->size ?? 4;
        $limit = $size;
        $offset = ($page * $limit) - $size;

        $query = DB::table('contenu_site')
            ->where('type', $type)
            ->orderBy('id', "DESC");
        $total = $query->count();
        $items = $query->skip($offset)->take($limit)->get();

        $data['total'] = $total;
        $data['items'] = $items;

        return response()->json($data);
    }


    public static function get4admin_article()
    {

        $articles = DB::table('contenu_site')->get();

        return view('admin.website_article', [
            'articles' => $articles,
        ]);
    }


    public static function modify4admin_articleGetId($id)
    {

        $article = DB::table('contenu_site')
            ->where('id', $id)
            ->first();

        return view('admin.website_article_md', ['article' => $article]);
    }


    public static function modify4admin_article(Request $request)
    {

        DB::table('contenu_site')
            ->where('id', $request->id)
            ->update([
                'titre' => $request->titre,
                'paragraphe1' => $request->paragraphe1,
                'paragraphe2' => $request->paragraphe2,
                'date_mise_a_jour' => date('Y-m-d H:i:s'),
            ]);

        return redirect('article');
    }


    public static function modifyimage4admin_article(Request $request)
    {

        $file1 = $request->file('newimage');
        $extension_ban = ['php'];
        if (in_array($file1->getClientOriginalExtension(), $extension_ban)) {
            return redirect('slider')->with('flashMessage', "Mauvaise extension du fichier ");
        } else {
            //Move Uploaded File
            $namefile1 = time() . '-' . $file1->getClientOriginalName();
            $destinationPath = 'uploads/';
            $file1->move($destinationPath, $namefile1);
        }

        DB::table('contenu_site')
            ->where('id', $request->id)
            ->update([
                'image' => '/' . $destinationPath . $namefile1,
                'date_mise_a_jour' => date('Y-m-d H:i:s'),
            ]);

        return redirect('article');
    }


    // ============================== begin slider ================================




    // ============================================begin Actuality =============================================


    public static function index()
    {

        $actualitys = Actuality::all();

        return view('admin.website.actuality.index', [
            'actualitys' => $actualitys,
        ]);
    }
    public function create()
    {


        return view('admin.website.actuality.create');
    }

    public function edit(Actuality $actuality)
    {


        return view('admin.website.actuality.edit', compact('actuality'));
    }


    public static function delete(Actuality $actuality)
    {




        try {

            $mainImg = $actuality->image;
            $bgImg = $actuality->imagebg;


            $baseUrl = env('APP_URL') . '/storage';

            $pathMain = str_replace($baseUrl, '', $mainImg);
            $pathBG = str_replace($baseUrl, '', $bgImg);
            $mainFileExists = Storage::exists($pathMain);
            $bgFileExists = Storage::exists($pathMain);


            if ($mainFileExists) {
                Storage::delete($pathMain);
            }

            if ($bgFileExists) {
                Storage::delete($pathBG);
            }


            $actuality->delete();
            return redirect()->back()->with('success_message', 'Actualité retiré');
        } catch (Exception $e) {
            dd($e);
        }
    }


    public static function add4admin_actuality(Request $request)
    {

        try {
            $file1 = $request->file('newimage1');
            $file2 = $request->file('newimage2');


            $extension_ban = ['php'];
            if (in_array($file1->getClientOriginalExtension(), $extension_ban) or in_array($file2->getClientOriginalExtension(), $extension_ban)) {
                return redirect('actuality')->with('flashMessage', "Mauvaise extension du fichier ");
            } else {
                //Move Uploaded File
                $namefile1 = time() . '-' . $file1->getClientOriginalName();
                $destinationPath = 'actualities/';
                $file1->storeAs($destinationPath, $namefile1);

                $namefile2 = time() . '-' . $file2->getClientOriginalName();
                $destinationPath = 'actualities/';
                $file2->storeAs($destinationPath, $namefile2);
            }

            Actuality::create([
                'titre' => $request->titre,
                'description' => $request->paragraphe1,
                'full_description' => $request->complete_description,
                'date_of_publish' => $request->date_of_publish,
                'author' => $request->author,
                'source' => $request->source,
                'image' => Storage::url($destinationPath . "" . $namefile1),
                'imagebg' => Storage::url($destinationPath . "" . $namefile2),
            ]);

            return redirect('actuality')->with('success_message', 'Actualité enregistré');
        } catch (Exception $e) {
            dd($e);
        }
    }


    public static function modify4admin_actuality(Request $request, Actuality $actuality)
    {

        $mainImg = $actuality->image;
        $bgImg = $actuality->imagebg;


        $baseUrl = env('APP_URL') . '/storage';

        $pathMain = str_replace($baseUrl, '', $mainImg);
        $mainFileExists = Storage::exists($pathMain);

        $pathBgMain = str_replace($baseUrl, '', $bgImg);
        $bgFileExists = Storage::exists($pathMain);

        $file1 = $request->file('newimage1');
        $file2 = $request->file('newimage2');

        //Verifier que l'user a uploader une nouvelle image de couverture

        if ($request->hasFile('newimage1')) {

            if ($mainFileExists) {
                Storage::delete($pathMain);
            }
            $mainFile      = $file1;
            $filename  = $mainFile->getClientOriginalName();
            $extension = $mainFile->getClientOriginalExtension();
            $uuid   = (string) Str::uuid() . '.' . $extension;

            $mainFile->storeAs('actualities', $uuid);
            $mainImg = Storage::url('actualities/' . $uuid);

            // $mainImg = Storage::url($destinationPath . $namefile1);
        }


        //Verifier que l'user a ajouter une nouvelle image arrière plan

        if ($request->hasFile('newimage2')) {

            if ($bgFileExists) {
                Storage::delete($pathBgMain);
            }
            $bgFile      = $file2;
            $filename  = $bgFile->getClientOriginalName();
            $extension = $bgFile->getClientOriginalExtension();
            $uuid2   = (string) Str::uuid() . '.' . $extension;

            $bgFile->storeAs('actualities', $uuid2);
            $bgImg = Storage::url('actualities/' . $uuid2);

            // $mainImg = Storage::url($destinationPath . $namefile1);
        }





        $actuality->titre = $request->titre;
        $actuality->date_of_publish = $request->date_of_publish;
        $actuality->description = $request->paragraphe1;
        $actuality->full_description = $request->complete_description;
        $actuality->author = $request->author;
        $actuality->source = $request->source;
        $actuality->image = $mainImg;
        $actuality->imagebg = $bgImg;
        $actuality->update();

        return redirect()->route('actuality')->with('success_message', 'Actualité mise à jour avec succès');
    }


    public static function modifyimage4admin_actuality(Request $request)
    {

        $file1 = $request->file('newimage');
        $extension_ban = ['php'];
        if (in_array($file1->getClientOriginalExtension(), $extension_ban)) {
            return redirect('actuality')->with('flashMessage', "Mauvaise extension du fichier ");
        } else {
            //Move Uploaded File
            $namefile1 = time() . '-' . $file1->getClientOriginalName();
            $destinationPath = 'actualities/';
            $file1->storeAs($destinationPath, $namefile1);
        }

        DB::table('actuality')
            ->where('id', $request->id)
            ->update([
                'image' => Storage::url($destinationPath . $namefile1),
                'date_mise_a_jour' => date('Y-m-d H:i:s'),
            ]);

        return redirect('actuality');
    }


    public static function modifysecondimage4admin_actuality(Request $request)
    {

        $file1 = $request->file('newimage');
        $extension_ban = ['php'];
        if (in_array($file1->getClientOriginalExtension(), $extension_ban)) {
            return redirect('actuality')->with('flashMessage', "Mauvaise extension du fichier ");
        } else {
            //Move Uploaded File
            $namefile1 = time() . '-' . $file1->getClientOriginalName();
            $destinationPath = 'actualities/';
            $file1->storeAs($destinationPath, $namefile1);
        }

        DB::table('actuality')
            ->where('id', $request->id)
            ->update([
                'imagebg' => Storage::url($destinationPath . $namefile1),
                'date_mise_a_jour' => date('Y-m-d H:i:s'),
            ]);

        return redirect('actuality');
    }


    // =============================== begin reclammation =======================================

    public static function getdata_reclammation()
    {
        return DB::table('reclammation')->get();
    }

    public static function get4admin_reclammation()
    {

        $reclammations = DB::table('reclammation')->get();

        return view('admin.website_reclammation', [
            'reclammations' => $reclammations,
        ]);
    }


    public static function add4admin_reclammation(Request $request)
    {
        DB::table('reclammation')->insert([
            'nom_prenom' => $request->nom_prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'sujet' => $request->sujet,
            'message' => $request->message,
        ]);

        return view('visiteur.contact', ['flashmessage' => 'Votre requete a ete pris en compte avec succes']);
    }

    public static function send_request(Request $request)
    {
        try {
            DB::table('reclammation')->insert([
                'nom_prenom' => $request->nom_prenom,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'sujet' => $request->sujet,
                'message' => $request->message,
            ]);

            return response()->json([
                "message" => 'Votre requete a été prise en compte avec succès'
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "message" => 'Votre requête à échoué '
            ]);
        }
    }


    //Page a propos

    public function aboutUs()
    {
        $about = AboutUs::all();
        return view('admin.website.about.index', compact('about'));
    }

    public function aboutUs_create()
    {
        return view('admin.website.about.create');
    }

    public function aboutUs_edit(AboutUs $aboutUs)
    {

        return view('admin.website.about.edit', compact('aboutUs'));
    }

    public function aboutUs_store(Request $request)
    {


        try {
            $file1 = $request->file('newimage1');


            $extension_ban = ['php'];
            if (in_array($file1->getClientOriginalExtension(), $extension_ban)) {
                return redirect('actuality')->with('flashMessage', "Mauvaise extension du fichier ");
            } else {
                //Move Uploaded File
                $namefile1 = time() . '-' . $file1->getClientOriginalName();
                $destinationPath = 'about/';
                $file1->storeAs($destinationPath, $namefile1);
            }

            AboutUs::create([
                'full_description' => $request->complete_description,
                'image' => Storage::url($destinationPath . "" . $namefile1),
            ]);

            return redirect()->route('aboutUs')->with('success_message', 'Contenue de la page a propos a été enregistré');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function aboutUs_update(Request $request, AboutUs $aboutUs)
    {

        $mainImg = $aboutUs->image;


        $baseUrl = env('APP_URL') . '/storage';

        $pathMain = str_replace($baseUrl, '', $mainImg);
        $mainFileExists = Storage::exists($pathMain);

        $file1 = $request->file('newimage1');

        //Verifier que l'user a uploader une nouvelle image de couverture

        if ($request->hasFile('newimage1')) {

            if ($mainFileExists) {
                Storage::delete($pathMain);
            }
            $mainFile      = $file1;
            $filename  = $mainFile->getClientOriginalName();
            $extension = $mainFile->getClientOriginalExtension();
            $uuid   = (string) Str::uuid() . '.' . $extension;

            $mainFile->storeAs('about', $uuid);
            $mainImg = Storage::url('about/' . $uuid);

            // $mainImg = Storage::url($destinationPath . $namefile1);
        }



        $aboutUs->full_description = $request->complete_description;

        $aboutUs->image = $mainImg;
        $aboutUs->update();

        return redirect()->route('aboutUs')->with('success_message', 'Page a propos mis à jour');
    }
}
