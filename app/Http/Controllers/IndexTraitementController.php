<?php

namespace App\Http\Controllers;

use App\Http\Resources\IndexTraitementResource;
use App\Models\IndexTraitement;
use App\Models\Signalement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * @authenticated
 *
 * APIs pour gerer les types de signalement
 */
class IndexTraitementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $page = request('page', 1);
        $perPage = request('per_page', 5000);

        $statut = request('statut');
        $habilete_id = request('habilete_id');

        $query = DB::table('index_traitement');

        if ($habilete_id) {
            $query->where('habilete_id', $habilete_id);
        }
        $query->distinct()->select('signalement_id');
        $count = $query->count();


        $index = $query->paginate($perPage, ['*'], 'page', $page);
        $signalements = [];
        foreach ($index as $key => $value) {
            if ($statut) {
                $statutValues = explode(',', str_replace(' ', '', $statut));
                $signalements[] = Signalement::where('id', $value->signalement_id)->whereIn('statut', $statutValues)->first();
            } else {
                $signalements[] = Signalement::find($value->signalement_id);
            }
        }

        return response()->json([
            'error' => false,
            'data' => $signalements,
            'total' => $count,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // if(!Auth::check()){
        //     return response()->json([
        //         'error' => true,
        //         'data' => "Vous devez vous connecter à votre compte !",
        //     ]);
        // }

        $data = $request->all();
        $validator = Validator::make(
            $data,
            [
                'habilete_id' => 'int',
                'signalement_id' => 'exists:signalements,id',
            ]
        );
        if ($validator->passes()) {
            $type = IndexTraitement::create($data);

            if ($type) {

                return response()->json([
                    'error' => false,
                    'message' => "Index de traitement enregistré avec succès"
                ], 200);
            } else {

                return response()->json([
                    'error' => true,
                    'message' => "Une erreur est survenue lors de l'enregistrement. Veuillez réessayer !"
                ], 501);
            }
        } else {

            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ], 501);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $signalement_id)
    {
        if(!Auth::check()){
            return response()->json([
                'error' => true,
                'data' => "Vous devez vous connecter à votre compte !",
            ]);
        }
        
        $habilete_id = request('habilete_id');
        $query = DB::table('index_traitement')->where('signalement_id', $signalement_id);
        if($habilete_id){
            $query->where('habilete_id', $habilete_id);    
        }
        $data = $query->get();
        return response()->json([
            'error' => false,
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make(
            $data,
            [
                'habilete_id' => 'string',
                'signalement_id' => 'exists:classe_signalements,id',
            ]
        );

        if ($validator->passes()) {

            $type = IndexTraitement::find($data['id']);

            if ($request->habilete_id) {
                $type->habilete_id = $data['habilete_id'];
            }
            if ($request->signalement_id) {
                $type->signalement_id = $data['signalement_id'];
            }


            $status = $type->save();
            if ($status) {
                return response()->json([
                    'error' => false,
                    'message' => "Le type de signalement a été modifié"
                ], 200);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => "Une erreur est survenue. Veuillez réessayer !"
                ], 501);
            }
        } else {

            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $signalement_id)
    {
        $habilete_id = request('habilete_id');
        $query = DB::table('index_traitement')->where('signalement_id', $signalement_id);
        if($habilete_id){
            $query->where('habilete_id', $habilete_id);    
        }

        $status = $query->delete();
        if ($status) {
            return response()->json([
                'error' => false,
                'message' => "Suppression effectuée !",
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => "Une erreur est survenue. Veuillez réessayer !"
            ]);
        }
    }
}
