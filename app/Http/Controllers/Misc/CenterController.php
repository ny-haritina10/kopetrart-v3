<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use App\Models\Misc\Center;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    private $list_view = 'pages.center.list';
    private $form_view = 'pages.center.form';
    /**
     * Display a listing of the resource.
     */
    public function index()
    { return view($this->list_view)->with('data', Center::all()); }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->form_view)->with([
            'form_action' => '/center',
            'form_method' => 'POST',
            'form_title' => 'Ajout de Centre'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|unique:center,label'
        ]);

        $unit = new Center();
        $unit->label = trim($request->input('label'));

        $unit->save();

        return redirect('/center')->with('success', 'Centre ajoutée avec succès');
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
            'item' => Center::find($id),
            'form_action' => '/center/'.$id,
            'form_method' => 'PUT',
            'form_title' => 'Modification de Centre'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'label' => 'required|string|unique:center,label'
        ]);

        $unit = Center::find($id);
        $unit->label = trim($request->input('label'));

        $unit->save();

        return redirect('/center')->with('success', 'Centre modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Center::destroy($id);
        return redirect('/center')->with('success', 'Centre supprimée avec succès');
    }
}
