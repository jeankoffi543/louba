<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHolidayRequest;
use App\Models\Commentaire;
use App\Models\Demande;
use App\Models\Habilete;
use App\Models\Historique;
use App\Models\IndexTraitement;
use App\Models\PieceJointe;
use App\Models\PointEnrolement;
use App\Models\PublicHoliday;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PieceJointeController extends Controller
{
    public function index()
    {
    }

    public function update(Request $request,  $id)
    {
        try {
            $pj = PieceJointe::find($id);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function destroy($id)
    {

        try {
            $pj = PieceJointe::find($id);
            $pj->delete();
            return redirect()->route("demande.show", ['id' => $pj->demande_id])->with('success_message', 'Pièce jointe supprimée avec succès');

        } catch (Exception $e) {
            dd($e);
        }
    }

    public function add($id)
    {
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $request->validate([
                'url.*' => 'required|mimes:jpg,png,pdf',
            ]);
            if ($request->hasFile('url')) {
                $files = $request->file('url');
                $fileUrls = [];
                foreach ($files as $file) {
                    // Generate a unique filename
                    $filename = "Piece_jointe_" . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Store the file in the desired directory
                    $file->storeAs('public/documents', $filename);
                    $fileUrls[] = Storage::url('documents/' . $filename);
                }

                $data['url'] = implode(',', $fileUrls);
                $data['demande_id'] = intval($data['demande_id']);
                $data['user_id'] = auth()->user()->id;
                $data['libelle'] = $data['libelle'];
                PieceJointe::create($data);

                // Commentaire
                $historique = new Historique();
                $historique->description = "Enregistrement d'une pièce jointe";
                $historique->demande_id = intval($data['demande_id']);
                $historique->user_id = auth()->user()->id;
                $historique->save();

                if($request->commentaire){
                    $commentaire = new Commentaire();
                    $commentaire->description = $request->commentaire;
                    $commentaire->historique_id = $historique->id;
                    $commentaire->save();
                }

                return redirect()->route("demande.show", ['id' => $data['demande_id']])->with('success_message', 'Pièce jointe enregistrée avec succès');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}
