<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\Exercice;
use App\Models\General\ExerciceYear;
use App\Models\Misc\Expense;
use Illuminate\Http\Request;

class ExerciceController extends Controller
{
    protected $list_view = 'pages.exercice.list';
    protected $form_view = 'pages.exercice.form';
    /**
     * Display a listing of the resource.
     */
    public function index()
    { return view($this->list_view)->with('data', Exercice::list()); }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->form_view)->with([
            'form_title' => 'Ajout Ecriture',
            'form_method' => 'POST',
            'form_action' => '/exercice',
            'exercice_years' => ExerciceYear::options()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no-account' => 'required|numeric|integer|gte:1',
            'id-exercice-year' => 'required|exists:exercice_year,id',
            'label' => 'required|string',
            'debit' => 'numeric|gte:0',
            'credit' => 'numeric|gte:0',
            'date' => 'date'
        ]);

        $exercice = new Exercice;

        $exercice->no_account = $request->input('no-account');
        $exercice->id_exercice_year = $request->input('id-exercice-year');
        $exercice->label = $request->input('label');
        $exercice->debit = $request->input('debit');
        $exercice->credit = $request->input('credit');
        $exercice->date = $request->input('date');

        $exercice->save();

        return redirect('/exerice')->with('success', 'Ecriture ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view($this->form_view)->with([
            'form_title' => 'Modification Ecriture',
            'form_method' => 'PUT',
            'form_action' => '/exercice/'.$id,
            'item' => Exercice::find($id),
            'exercice_years' => ExerciceYear::options()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'no-account' => 'required|numeric|integer|gte:1',
            'id-exercice-year' => 'required|exists:exercice_year,id',
            'label' => 'required|string',
            'debit' => 'numeric|gte:0',
            'credit' => 'numeric|gte:0',
            'date' => 'date'
        ]);

        $exercice = Exercice::find($id);

        $exercice->no_account = $request->input('no-account');
        $exercice->id_exercice_year = $request->input('id-exercice-year');
        $exercice->label = $request->input('label');
        $exercice->debit = $request->input('debit');
        $exercice->credit = $request->input('credit');
        $exercice->date = $request->input('date');

        $exercice->save();

        return redirect('/exercice')->with('success', 'Ecriture modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expense = Expense::where('id_exercice', $id)->get();
        if($expense->empty())
        { Exercice::destroy($id); }
        else
        { $expense->destroy(); }

        return redirect('/exercice')->with('success', 'Ecriture supprimé avec succès');
    }
}
