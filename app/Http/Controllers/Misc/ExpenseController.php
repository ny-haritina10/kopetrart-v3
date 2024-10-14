<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use App\Models\General\Exercice;
use App\Models\Misc\Center;
use App\Models\Misc\Expense;
use App\Models\Misc\Section;
use App\Rules\SumHundred;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    private $list_view = 'pages.expense.list';
    private $form_view = 'pages.expense.form';
    /**
     * Display a listing of the resource.
     */
    public function index()
    { return view($this->list_view)->with('data', Expense::list()); }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->form_view)->with([
            'sections' => Section::options(),
            'centers' => Center::all(),
            'form_action' => '/expense',
            'form_method' => 'POST',
            'form_title' => 'Ajout de Charge'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id-section' => 'required|exists:section,id',
            'quantity' => 'required|numeric|gte:0',
            'price' => 'required|numeric|gte:0',
            'date' => 'required|date',
            'percentage' => ['required', 'array', new SumHundred],
            'percentage.*' => 'required|numeric|gte:0|lte:100'
        ]);

        $centers = Center::all();

        // insert exercice
        $section = DB::table('v_l_section')->where('id', $request->input('id-section'))->first();
        $exercice = new Exercice;

        $exercice->no_account = $section->no_account;
        $exercice->id_exercice_year = DB::table('exercice_year')->first()->id;
        $exercice->label = $section->label;
        $exercice->debit = trim($request->input('price'));
        $exercice->credit = 0;
        $exercice->date = trim($request->input('date'));

        $exercice->save();

        // insert expense
        $expense = new Expense();
        $expense->id_section = $request->input('id-section');
        $expense->id_exercice = $exercice->id;
        $expense->quantity = trim($request->input('quantity'));
        $expense->price = trim($request->input('price'));
        $expense->date = trim($request->input('date'));

        $expense->save();

        // insert percentages
        foreach($request->input('percentage') as $i => $percentage)
        {
            DB::table('expense_center')->insert([
                'id_expense' => $expense->id,
                'id_center' => $centers[$i]->id,
                'percentage' => $percentage/100
            ]);
        }

        return redirect('/expense')->with('success', 'Charge ajoutée avec succès');
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
            'item' => Expense::find($id),
            'percentages' => DB::table('expense_center')->where('id_expense', $id)->pluck('percentage')->map(fn($value) => $value * 100),
            'centers' => Center::all(),
            'sections' => Section::options(),
            'form_action' => '/expense/'.$id,
            'form_method' => 'PUT',
            'form_title' => 'Modification de Charge'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id-section' => 'required|exists:section,id',
            'quantity' => 'required|numeric|gte:0',
            'price' => 'required|numeric|gte:0',
            'date' => 'required|date',
            'percentage' => ['required', 'array', new SumHundred],
            'percentage.*' => 'required|numeric|gte:0|lte:100'
        ]);

        $centers = Center::all();

        $expense = Expense::find($id);
        $expense->id_section = $request->input('id-section');
        $expense->quantity = trim($request->input('quantity'));
        $expense->price = trim($request->input('price'));
        $expense->date = trim($request->input('date'));

        $expense->save();

        foreach($request->input('percentage') as $i => $percentage)
        {
            DB::table('expense_center')->where([
                'id_expense' => $expense->id,
                'id_center' => $centers[$i]->id
            ])->update([
                'percentage' => $percentage/100
            ]);
        }

        return redirect('/expense')->with('success', 'Charge modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Expense::destroy($id);
        return redirect('/expense')->with('success', 'Charge supprimée avec succès');
    }
}
