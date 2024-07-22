<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Models\Service;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ServiceController extends Controller
{

    public static function articleService($tag)
    {
        $article = DB::table('contenu_site')
            ->where('tagDur', $tag)
            ->first();
        return view('visiteur.service', ['article' => $article]);
    }


    public static function get_services()
    {
        $services = DB::table('service')->get();
        return $services;
    }


    public static function insert(Request $request)
    {
        DB::table('users')->insert([
            'nom' => $request->nom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => 123456,
            'id_role' => $request->id_role,
            'id_point_enrolement' => $request->id_point_enrolement,
        ]);

        return redirect(route('user'));
    }






    public static function index()
    {

        $services = DB::table('service')->get();


        return view('admin.services.index', [
            'services' => $services,
        ]);
    }


    public  function delete(Service $service)
    {
        try {

            $mainImg = $service->image;
            $baseUrl = env('APP_URL') . '/storage';
            $pathMain = str_replace($baseUrl, '', $mainImg);
            $mainFileExists = Storage::exists($pathMain);

            //Verifier que l'user a uploader une nouvelle image de couverture
            if ($mainFileExists) {
                Storage::delete($pathMain);
            }

            $service->delete();
            $service->pointEnrolements()->detach();

            return redirect()->route('services')->with('success_message', 'Le service a été rétiré');
        } catch (Exception $e) {
            dd($e);
        }
    }


    public  function store(StoreServiceRequest $request)
    {

        // dd($request->all());
        $imageUrl = NULL;
        if ($request->hasFile('newimage1')) {
            $file = $request->file('newimage1');
            $extension_ban = ['php', 'docx', 'doc'];
            if (in_array($file->getClientOriginalExtension(), $extension_ban)) {
                return redirect()->route('services')->with('error_message', "Mauvaise extension du fichier ");
            } else {


                $filename  = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $uuid   = (string) Str::uuid() . '.' . $extension;

                $file->storeAs('public/services', $uuid);
                $imageUrl = Storage::url('services/' . $uuid);
            }
        }

        Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'prix' => $request->prix,
            'form_type' => $request->form_type,
            'image' => $imageUrl,
            'is_public' => $request->is_public ? 1 : 0,
            'is_disable' => $request->is_disable ? 1 : 0,
        ]);

        return redirect()->route('services')->with('success_message', 'Le service à été crée.');
    }


    public static function edit(Request $request, Service $service)
    {

        $request->validate([
            'name' => 'required'
        ]);

        try {
            if ($request->hasFile('image')) {
                $explode = explode('storage', $service->image);
                $pathImg = 'public/' . last($explode);

                $checkFileExist = Storage::exists($pathImg);
                if ($checkFileExist) {
                    Storage::delete($pathImg);
                    $fileBaseLink = 'public/services/';
                    $file = $request->file('image');
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $picture = (string)Str::uuid() . '.' . $extension;

                    //move image to public/img folder
                    $moveFile = $file->storeAs($fileBaseLink, $picture);

                    $service->image = Storage::url($fileBaseLink . '' . $picture);
                }
            }

            $service->name = $request->name;
            $service->description = $request->description;
            $service->prix = $request->prix;
            $service->form_type = $request->form_type;
            $service->is_public = $request->is_public ? 1 : 0;
            $service->is_disable =  $request->is_disable ? 1 : 0;
            $service->update();


            return redirect()->route('services')->with('success_message', 'Le service a été mis à jour.');
        } catch (Exception $e) {
            dd($e);
        }
    }
}
