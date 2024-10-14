<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use App\Models\Misc\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    private $list_view = 'pages.unit.list';
    private $form_view = 'pages.unit.form';

    /**
     * Display a listing of the resource.
     */
    public function index()
    { return view($this->list_view)->with('data', Unit::all()); }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->form_view)->with([
            'form_action' => '/unit',
            'form_method' => 'POST',
            'form_title' => 'Ajout d\'Unité d\'Oeuvre'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|unique:unit,label'
        ]);

        $unit = new Unit();
        $unit->label = trim($request->input('label'));

        $unit->save();

        return redirect('/unit')->with('success', 'Unité d\'oeuvre ajoutée avec succès');
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
            'item' => Unit::find($id),
            'form_action' => '/unit/'.$id,
            'form_method' => 'PUT',
            'form_title' => 'Modification d\'Unité d\'Oeuvre'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'label' => 'required|string|unique:unit,label'
        ]);

        $unit = Unit::find($id);
        $unit->label = trim($request->input('label'));

        $unit->save();

        return redirect('/unit')->with('success', 'Unité d\'oeuvre modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Unit::destroy($id);
        return redirect('/unit')->with('success', 'Unité d\'oeuvre supprimée avec succès');
    }
}
