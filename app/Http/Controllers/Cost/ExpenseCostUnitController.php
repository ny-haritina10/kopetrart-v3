<?php

namespace App\Http\Controllers\Cost;

use App\Http\Controllers\Controller;
use App\Models\Cost\ExpenseCostUnit;
use Illuminate\Http\Request;

class ExpenseCostUnitController extends Controller
{
    private $list_view = 'pages.expense-cost-unit.list';

    public function index()
    { return view($this->list_view)->with('data', ExpenseCostUnit::all()); }
}
