<?php

namespace App\Http\Controllers;

use App\Http\Requests\storePartnersRequest;
use App\Models\Partner;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PartnerController extends Controller
{
    public function index()
    {

        $partners = Partner::all();

        return view('admin.partners.index', compact('partners'));
    }

    public function store(storePartnersRequest $request)
    {
        try {


            $partner = new Partner();


            if ($request->hasFile('logo')) {
                $file      = $request->file('logo');
                $filename  = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $uuid   = (string) Str::uuid() . '.' . $extension;

                $file->storeAs('partners', $uuid);
                $partner->path = Storage::url('partners/' . $uuid);
            }

            $partner->name = $request->name;
            $partner->save();

            return redirect()->back()->with('success_message', 'Le partenaire a été ajouté');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function update(storePartnersRequest $request, Partner $partner)
    {

        if ($request->hasFile('logo')) {
            $explode = explode('storage', $partner->path);
            $pathLogo = last($explode);
            $checkFileExist = Storage::exists($pathLogo);
            if ($checkFileExist) {
                Storage::delete($pathLogo);
                $fileBaseLink = 'partners/';
                $file = $request->file('logo');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = (string)Str::uuid() . '.' . $extension;

                //move image to public/img folder
                $moveFile = $file->storeAs($fileBaseLink, $picture);

                $partner->path = Storage::url($fileBaseLink . '' . $picture);
                $partner->uuid = $picture;
            }
        }

        $partner->name = $request->name;
        $partner->save();

        return redirect()->back()->with('success_message', 'Le partenaire a été mis à jour');
    }


    public function deleteOldLogo($linkToDelete)
    {
        if (Storage::delete('public/' . $linkToDelete)) {

            Storage::delete('public/' . $linkToDelete);
        } else {
        }
    }
}
