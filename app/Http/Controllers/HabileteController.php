<?php

namespace App\Http\Controllers;

use App\Http\Resources\HabileteResource;
use App\Models\Habilete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


/**
 * @authenticated
 *
 * APIs pour gerer les types de signalement
 */
class HabileteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groupes = Habilete::with('permissions')->latest()->get();    
        return view('admin.workflow.groupe', compact('groupes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all() ;
        $validator = Validator::make(
            $data,
            [
                'libelle'=> 'required|string',
            ]
        );

        if( $validator->passes() ){
            $habilete = Habilete::create($data);
            if( $habilete ){
                
                return redirect()->back()->with('success_message', 'Le groupe a été ajouté avec succès');
 
            }else{

                return redirect()->back()->with('error_message', 'Le groupe n\'a pas été ajouté avec succès');
               
            }
            
        }else{

            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ],501);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Habilete::find($id);
        if( ! $data )
        return response()->json([
            'error' => false,
            'data' => [],
        ],200);
        $hab = new HabileteResource($data);
        return response()->json([
            'error' => false,
            'data' => $hab,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all() ;
        $validator = Validator::make(
            $data,
            [
                'libelle'=> 'required|string',
            ]
        );

        if( $validator->passes() ){

            $type = Habilete::find( $id );
            
            if( $request->libelle ){  $type->libelle = $data['libelle'];   }
          
            $status = $type->save();
            if( $status ){
                
                return redirect()->back()->with('success_message', 'Le groupe a été ajouté avec succès');
 
            }else{

                return redirect()->back()->with('error_message', 'Le groupe n\'a pas été mis à jour avec succès');
               
            }
     

        }else{

            return redirect()->back()->with('error_message', 'Le groupe n\'a pas été mise à jour avec succès');


        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = Habilete::find( $id );

        if( !$type ){
            return response()->json([
                'error' => true,
                'message' => "Habileté introuvable!"
            ]);
        }
        
        $status = $type->delete();
        if( $status ){
                
            return redirect()->back()->with('success_message', 'Le groupe a été supprimé avec succès');

        }else{

            return redirect()->back()->with('error_message', 'Le groupe n\'a pas été suprimé avec succès');
           
        }
    }
}
