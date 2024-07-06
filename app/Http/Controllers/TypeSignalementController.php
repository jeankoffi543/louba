<?php

namespace App\Http\Controllers;

use App\Http\Resources\TypeSignalementResource;
use App\Models\TypeSignalement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


/**
 * @authenticated
 *
 * APIs pour gerer les types de signalement
 */
class TypeSignalementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = TypeSignalement::count();
        $query = TypeSignalement::query();
        $libelle = request('libelle');
        if ($libelle) {
            $query->where('libelle', 'like', '%' . $libelle . '%');
        }
        if (request('per_page') === null || request('per_page') === "null") {
            $types = TypeSignalement::get();
        } else {
            $page =  request('page', 1);
            $perPage = request('per_page', 5);
            $types = $query->paginate($perPage, ['*'], 'page', $page);
        }

        $data = TypeSignalementResource::collection($types);
        return response()->json([
            'error' => false,
            'data' => $data,
            'total' => $count,
        ]);
    }

    public function index2()
    {
        $types = TypeSignalement::get();
        $data = TypeSignalementResource::collection($types);
        return response()->json([
            'error' => false,
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make(
            $data,
            [
                'libelle' => 'required|string',
                'description' => 'required|string',
                'classe_signalement_id' => 'required|exists:classe_signalements,id',
            ]
        );

        if ($validator->passes()) {
            $type = TypeSignalement::create($data);

            if ($type) {

                return response()->json([
                    'error' => false,
                    'message' => "Le type de signalement a été enregistré"
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
    public function show(string $id)
    {
        $data = TypeSignalement::find($id);
        if (!$data)
            return response()->json([
                'error' => false,
                'data' => [],
            ], 200);
        $type = new TypeSignalementResource($data);
        return response()->json([
            'error' => false,
            'data' => $type,
        ], 200);
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
                'libelle' => 'required|string',
                'description' => 'required|string',
                'classe_signalement_id' => 'required|exists:classe_signalements,id',
            ]
        );

        if ($validator->passes()) {

            $type = TypeSignalement::find($id);

            if ($request->libelle) {
                $type->libelle = $data['libelle'];
            }
            if ($request->classe_signalement_id) {
                $type->classe_signalement_id = $data['classe_signalement_id'];
            }
            if ($request->description) {
                $type->description = $data['description'];
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
    public function destroy(string $id)
    {
        $type = TypeSignalement::find($id);

        //Verifier si la categorie à supprimer existe
        if (!$type) {
            return response()->json([
                'error' => true,
                'message' => "Type de signelement introuvable!"
            ]);
        }

        $status = $type->delete();
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
