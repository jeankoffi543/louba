<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Dotenv\Dotenv;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class SocialController extends Controller
{
    public function index()
    {

        $socials = Social::all();

        return view('admin.socials.index', compact('socials'));
    }

    public function store(Request $request)
    {

        try {



            $social = new Social();


            if ($request->hasFile('image')) {
                $file      = $request->file('image');
                $filename  = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $uuid   = (string) Str::uuid() . '.' . $extension;

                $file->storeAs('socials', $uuid);
                $social->image = Storage::url('socials/' . $uuid);
            }

            $social->name = $request->name;
            $social->link = $request->link;
            $social->save();

            return redirect()->back()->with('success_message', 'Le réseau social a été ajouté');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function update(Request $request, Social $social)
    {



        $baseUrl = env('APP_URL').'/storage';

        $path = str_replace($baseUrl, '', $social->image);
        $fileExists = Storage::exists($path);

        if ($request->hasFile('image')) {


            if ($fileExists) {
                Storage::delete($path);
            }


            $file      = $request->file('image');
            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $uuid   = (string) Str::uuid() . '.' . $extension;

            $file->storeAs('socials', $uuid);
            $social->image = Storage::url('socials/' . $uuid);
        }

        $social->name = $request->name;
        $social->save();

        return redirect()->back()->with('success_message', 'Le réseau social a été mis à jour');
    }


    public function deleteOldLogo($linkToDelete)
    {
        if (Storage::delete('public/' . $linkToDelete)) {

            Storage::delete('public/' . $linkToDelete);
        } else {
        }
    }
}
