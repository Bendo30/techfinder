<?php

namespace App\Http\Controllers;

use App\Models\User_Competence;
use Illuminate\Http\Request;

class UserCompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $userCompetences = User_Competence::all();
            return response()->json($userCompetences, 200);
        }catch(\Exception $e){
            return response()->json(['error' => 'Failed to retrieve user competences', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code_user' => 'required|string|max:255',
            'code_comp' => 'required|integer',
        ]);
        try{
            $userCompetence = User_Competence::create(['code_user' => $request->code_user, 'code_comp' => $request->code_comp]);
            return response()->json($userCompetence, 201);
        }catch(\Exception $e){
            return response()->json(['error' => 'Failed to create user competence', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $code_user, int $code_comp)
    {
        try{
            $userCompetence = User_Competence::where('code_user', $code_user)->where('code_comp', $code_comp)->first();
            if(!$userCompetence){
                return response()->json(['error' => 'User competence not found'], 404);
            }
            return response()->json($userCompetence, 200);
        }catch(\Exception $e){
            return response()->json(['error' => 'Failed to retrieve user competence', 'message' => $e->getMessage()], 500);
        }
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $code_user, int $code_comp)
    {
        try{
            $userCompetence = User_Competence::where('code_user', $code_user)->where('code_comp', $code_comp)->first();
            if(!$userCompetence){
                return response()->json(['error' => 'User competence not found'], 404);
            }
            $userCompetence->update($request->only(['code_user', 'code_comp']));
            return response()->json($userCompetence, 200);
        }catch(\Exception $e){
            return response()->json(['error' => 'Failed to update user competence', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $code_user, int $code_comp)
    {
        try{
            $userCompetence = User_Competence::where('code_user', $code_user)->where('code_comp', $code_comp)->first();
            if(!$userCompetence){
                return response()->json(['error' => 'User competence not found'], 404);
            }
            $userCompetence->delete();
            return response()->json(['message' => 'User competence deleted successfully'], 200);
        }catch(\Exception $e){
            return response()->json(['error' => 'Failed to delete user competence', 'message' => $e->getMessage()], 500);
        }
    }
}
