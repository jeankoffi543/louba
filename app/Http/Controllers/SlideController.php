<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class SlideController extends Controller
{
    public  function index()
    {
        $sliders = Slider::all();

        return view('admin.website.slide.index', [
            'sliders' => $sliders,
        ]);
    }

    public  function create()
    {
        return view('admin.website.slide.create');
    }


    public static function delete(Slider $slider)
    {

        try {

            $mainImg = $slider->image;
            $bgImg = $slider->image_bg;
            $baseUrl = env('APP_URL') . '/storage';
            $pathMain = str_replace($baseUrl, '', $mainImg);
            $mainFileExists = Storage::exists($pathMain);

            $pathBg = str_replace($baseUrl, '', $bgImg);
            $bgFileExists = Storage::exists($pathBg);

            //Verifier que l'user a uploader une nouvelle image de couverture
            if ($mainFileExists) {
                Storage::delete($pathMain);
            }
            if ($bgFileExists) {
                Storage::delete($pathBg);
            }

            $slider->delete();

            return redirect()->route('slider')->with('success_message', 'Le slider a été rétiré');
        } catch (Exception $e) {
            dd($e);
        }
    }


    public static function store(Request $request)
    {

        try {
            $image_bg = NULL;
            $image = NULL;

            $file1 = $request->file('image');
            $file2 = $request->file('imagebg');


            //Verifier que l'user a uploader une nouvelle image de couverture

            if ($request->hasFile('image')) {
                $mainFile      = $file1;
                $filename  = $mainFile->getClientOriginalName();
                $extension = $mainFile->getClientOriginalExtension();
                $uuid   = (string) Str::uuid() . '.' . $extension;

                $mainFile->storeAs('sliders/images', $uuid);
                $image = Storage::url('sliders/images/' . $uuid);

                // $mainImg = Storage::url($destinationPath . $namefile1);
            }


            //Verifier que l'user a ajouter une nouvelle image arrière plan

            if ($request->hasFile('imagebg')) {


                $bgFile      = $file2;
                $filename  = $bgFile->getClientOriginalName();
                $extension = $bgFile->getClientOriginalExtension();
                $uuid2   = (string) Str::uuid() . '.' . $extension;

                $bgFile->storeAs('sliders/backgrounds', $uuid2);
                $image_bg = Storage::url('sliders/backgrounds/' . $uuid2);

                // $mainImg = Storage::url($destinationPath . $namefile1);
            }

            Slider::create([
                'titre' => $request->titre,
                'description' => $request->description,
                'full_description' => $request->complete_description,
                'image' => $image,
                'image_bg' => $image_bg,
                'date_mise_a_jour' => date('Y-m-d H:i:s'),
            ]);

            return redirect()->route('slider')->with('success_message', 'Le slider a été ajouté');
        } catch (Exception $e) {
            dd($e);
        }
    }


    public  function edit(Slider $slider)
    {
        return view('admin.website.slide.edit', compact('slider'));
    }


    public  function update(Request $request, Slider $slider)
    {

        $image_to_upload = $slider->image;
        $image_bg_to_upload = $slider->image_bg;

        if ($request->hasFile('image')) {
            $explode = explode('storage', $slider->image);
            $pathImage = last($explode);
            $checkFileExist = Storage::exists($pathImage);


            if ($checkFileExist) {
                Storage::delete($pathImage);
                $fileBaseLink = 'sliders/images/';
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = (string)Str::uuid() . '.' . $extension;
                $moveFile = $file->storeAs($fileBaseLink, $picture);
                $image_to_upload = Storage::url($fileBaseLink . '' . $picture);
            }
        }
        if ($request->hasFile('image_bg')) {
            $explode = explode('storage', $slider->image_bg);
            $pathImage = last($explode);
            $checkFileExist = Storage::exists($pathImage);


            if ($checkFileExist) {
                Storage::delete($pathImage);
                $fileBaseLink = 'sliders/backgrounds/';
                $fileBg = $request->file('image_bg');
                $filename = $fileBg->getClientOriginalName();
                $extension = $fileBg->getClientOriginalExtension();
                $picture = (string)Str::uuid() . '.' . $extension;
                $moveFile = $fileBg->storeAs($fileBaseLink, $picture);
                $image_bg_to_upload = Storage::url($fileBaseLink . '' . $picture);
            }
        }

        $slider->image = $image_to_upload;
        $slider->image_bg = $image_bg_to_upload;
        $slider->titre = $request->titre;
        $slider->description = $request->description;
        $slider->full_description = $request->complete_description;
        $slider->date_mise_a_jour = date('Y-m-d H:i:s');
        $slider->update();

        return redirect()->route('slider')->with('success_message', 'Le slider a été mis à jour');
    }
}
