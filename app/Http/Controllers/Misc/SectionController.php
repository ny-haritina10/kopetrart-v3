<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use App\Models\Misc\Incorporation;
use App\Models\Misc\Nature;
use App\Models\Misc\Section;
use App\Models\Misc\Unit;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    private $list_view = 'pages.section.list';
    private $form_view = 'pages.section.form';

    public function index()
    { return view($this->list_view)->with('data', Section::list()); }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->form_view)->with([
            'units' => Unit::options(),
            'natures' => Nature::options(),
            'incorporations' => Incorporation::options(),
            'form_action' => '/section',
            'form_method' => 'POST',
            'form_title' => 'Ajout de Rubrique'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no-account' => 'required|numeric|integer',
            'label' => 'required|string|unique:section,label',
            'id-unit' => 'required|exists:unit,id',
            'id-nature' => 'required|exists:nature,id',
            'id-incorporation' => 'required|exists:incorporation,id'
        ]);

        $section = new Section;
        $section->no_account = trim($request->input('no-account'));
        $section->label = trim($request->input('label'));
        $section->id_unit = $request->input('id-unit');
        $section->id_nature = $request->input('id-nature');
        $section->id_incorporation = $request->input('id-incorporation');

        $section->save();

        return redirect('/section')->with('success', 'Rubrique ajoutée avec succès');
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
            'item' => Section::find($id),
            'units' => Unit::options(),
            'natures' => Nature::options(),
            'incorporations' => Incorporation::options(),
            'form_action' => '/section/'.$id,
            'form_method' => 'PUT',
            'form_title' => 'Modification de Rubrique'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'no-account' => 'required|numeric|integer',
            'label' => 'required|string|unique:section,label',
            'id-unit' => 'required|exists:unit,id',
            'id-nature' => 'required|exists:nature,id',
            'id-incorporation' => 'required|exists:incorporation,id'
        ]);

        $section = Section::find($id);
        $section->no_account = trim($request->input('no-account'));
        $section->label = trim($request->input('label'));
        $section->id_unit = $request->input('id-unit');
        $section->id_nature = $request->input('id-nature');
        $section->id_incorporation = $request->input('id-incorporation');

        $section->save();

        return redirect('/section')->with('success', 'Rubrique modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Section::destroy($id);
        return redirect('/section')->with('success', 'Rubrique supprimée avec succès');
    }
}
