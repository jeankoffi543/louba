<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClasseSignalementCollection;
use App\Http\Resources\ClasseSignalementResource;
use App\Models\ClasseSignalement;
use App\Models\Habilete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @authenticated
 *
 * APIs pour gerer les classe de signalement
 */

class ClasseSignalementController extends Controller
{
    /**
     * Afficher la liste des classes de signalement
     */
    public function index()
    {

        $query = ClasseSignalement::query();
        $count = ClasseSignalement::count();
       
        if(request('per_page') === null || request('per_page') === "null"){
            $types = $query->get();
        }else{
            $page =  request('page', 1);
            $perPage = request('per_page', 5);                
            $types = $query->paginate($perPage, ['*'], 'page', $page);
        }

        $data = ClasseSignalementResource::collection($types);
        return response()->json([
            'error' => false,
            'data' => $data,
            'total' => $count,
        ]);
   
    }

    /**
     * Afficher la liste des classes de signalement avec les habileté (workflow)
     */
    public function circuit_traitement()
    {
        $classes = ClasseSignalement::get();
        $data = new ClasseSignalementCollection($classes);
        return response()->json([
            'error' => false,
            'data' => $data
        ]);
    }

    /**
     * Enregistrer une classe de signalement
     */
    public function store(Request $request)
    {
        $data = $request->all() ;
        $validator = Validator::make(
            $data,
            [
                'libelle'=> 'required|string',
                'habiletes' => 'nullable|array',
                'habiletes.*' => 'nullable|array',
                'habiletes.*.*' => 'nullable|numeric',
            ]
        );

        if( $validator->passes() ){
            // dd($data);
            $classe = ClasseSignalement::create($data);
            if( $classe ){
                
                return response()->json([
                    'error' => false,
                    'message' =>"La classe de signalement a été enregistré" 
                ],200);

            }else{

                return response()->json([
                    'error' => true,
                    'message' => "Une erreur est survenue lors de l'enregistrement. Veuillez réessayer !"
                ],501);
               
            }
            
        }else{

            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ],501);

        }
    }

    /**
     * Details de classe de signalement
     */
    public function show(string $id)
    {
        $data = ClasseSignalement::find($id);
        if( ! $data )
        return response()->json([
            'error' => false,
            'data' => [],
        ],200);
        $classe = new ClasseSignalementResource($data);
        return response()->json([
            'error' => false,
            'data' => $classe,
        ],200);
    }

    /**
     * Modifier une classe de signalement
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all() ;
        $validator = Validator::make(
            $data,
            [
                'libelle'=> 'required|string',
                'habiletes' => 'nullable|array',
                'habiletes.*' => 'nullable|array',
                'habiletes.*.*' => 'nullable|numeric',
            ]
        );

        if( $validator->passes() ){

            $classe = ClasseSignalement::find( $data['id'] );
            
            if( $request->libelle ){  $classe->libelle = $data['libelle'];   }
            if( $request->habiletes ){  $classe->habiletes = $data['habiletes'];   }
          

            $status = $classe->save();
            if( $status ){
                return response()->json([
                    'error' => false,
                    'message' => "La classe de signalement a été modifié"
                ],200);
            }else{
                return response()->json([
                    'error' => true,
                    'message' => "Une erreur est survenue. Veuillez réessayer !"
                ],501);
            }

        }else{

            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);

        }
    }

    /**
     * Supprimer une classe de signalement
     */
    public function destroy(string $id)
    {
        $classe = ClasseSignalement::find( $id );

        //Verifier si la categorie à supprimer existe
        if( !$classe ){
            return response()->json([
                'error' => true,
                'message' => "Classe de signelement introuvable!"
            ]);
        }
        
        $status = $classe->delete();
        if( $status ){           
            return response()->json([
                'error' => false,
                'message' => "Suppression effectuée !",
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => "Une erreur est survenue. Veuillez réessayer !"
            ]);
        }
    }
}
