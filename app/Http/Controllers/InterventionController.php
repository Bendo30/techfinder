<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $interventions = Intervention::all();
            return response()->json($interventions, 200);
        }catch(\Exception $e){
            return response()->json(['error' => 'Failed to retrieve interventions', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_int' => 'required|date',
            'note_int' => 'sometimes|integer|min:0|max:65535',
            'commentaire_int' => 'nullable|string',
            'code_user_client' => 'required|string|exists:utilisateurs,code_user',
            'code_user_techn' => 'required|string|exists:utilisateurs,code_user',
            'code_comp' => 'required|integer|exists:competences,code_comp',
        ]);
        try{
            $intervention = Intervention::create([
                'date_int' => $request->date_int,
                'note_int' => $request->note_int ?? 0,
                'commentaire_int' => $request->commentaire_int,
                'code_user_client' => $request->code_user_client,
                'code_user_techn' => $request->code_user_techn,
                'code_comp' => $request->code_comp,
            ]);
            return response()->json($intervention, 201);
        }catch(\Exception $e){
            return response()->json(['error' => 'Failed to create intervention', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $code_int)
    {
        try{
            $intervention = Intervention::findOrFail($code_int);
            return response()->json($intervention, 200);
        }catch(\Exception $e){
            return response()->json(['error' => 'Failed to retrieve intervention', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $code_int)
    {
        $request->validate([
            'date_int' => 'required|date',
            'note_int' => 'sometimes|integer|min:0|max:65535',
            'commentaire_int' => 'nullable|string',
            'code_user_client' => 'required|string|exists:utilisateurs,code_user',
            'code_user_techn' => 'required|string|exists:utilisateurs,code_user',
            'code_comp' => 'required|integer|exists:competences,code_comp',
        ]);
        try{
            $intervention = Intervention::findOrFail($code_int);
            $intervention->update([
                'date_int' => $request->date_int,
                'note_int' => $request->note_int ?? $intervention->note_int,
                'commentaire_int' => $request->commentaire_int,
                'code_user_client' => $request->code_user_client,
                'code_user_techn' => $request->code_user_techn,
                'code_comp' => $request->code_comp,
            ]);
            return response()->json($intervention, 200);
        }catch(\Exception $e){
            return response()->json(['error' => 'Failed to update intervention', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $code_int)
    {
        try{
            $intervention = Intervention::findOrFail($code_int);
            $intervention->delete();
            return response()->json(['message'=>'Intervention deleted successfully'], 200);
        }catch(\Exception $e){
            return response()->json(['error' => 'Failed to delete intervention', 'message' => $e->getMessage()], 500);
        }
    }

    //fonction pour rechercher à partir d'un mot clé dans le commentaire
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
        ]);
        try{
            $query = $request->input('query');
            $interventions = Intervention::where('commentaire_int', 'like', "%$query%")
                ->orWhere('code_user_client', 'like', "%$query%")
                ->orWhere('code_user_techn', 'like', "%$query%")
                ->get();
            return response()->json($interventions, 200);
        }catch(\Exception $e){
            return response()->json(['error' => 'Failed to search interventions', 'message' => $e->getMessage()], 500);
        }
    }
}
