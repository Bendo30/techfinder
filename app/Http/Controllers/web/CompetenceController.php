<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use Illuminate\Http\Request;

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $competence_list = Competence::paginate(10); //récupère les enregistrements de la table competences par page de 10
        return view('competences.index', compact('competence_list')); //transmet la liste paginée des compétences à la vue 'competences' pour affichage
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('web.competences.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label_comp'=>'required|string|max:255',
            'description_comp'=>'nullable|string'

        ]);

        Competence::create($request->only(['label_comp', 'description_comp']));

        flash()->addSuccess('Produit ajouté avec succès !');

        return redirect()->route('web.competences.index')->with('success', 'competence cree avec succes');
    }

    /**
     * Display the specified resource. 
     */
    public function show(int $code_comp)
    {
        $competence = Competence::findOrFail($code_comp);
        return view('competences.show', compact('competence'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $code_comp)
    {
        $competence_edit = Competence::findOrFail($code_comp);
        return view('competences.edit', compact('competence_edit'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $code_comp)
    {
        $request->validate([
            'code_comp'=>'required|integer|unique:competences, code_comp,'.$code_comp.',code_comp',
            'label_comp'=>'required|string|max:255',
            'description_comp'=>'nullable|string'

        ]);

        $competence_update = Competence::findOrFail($code_comp);
        $competence_update->update($request->all());

        return redirect()->route('web.competences.index')->with('success', 'competence modifie avec succes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $code_comp)
    {
        $competence_delete = Competence::findOrFail($code_comp);
        $competence_delete->delete(); 

        try {
                    flash()->addWarning('competence supprimee !')
                        ->setTimeout(2000)
                        ->setPosition('top-right');

            return redirect()->route('web.competences.index')->with('success', 'competence supprime avec succes');
        } catch (\Exception $e) {
            return redirect()->route('web.competences.index');
        }
    }
}
