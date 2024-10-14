<?php

namespace App\Http\Controllers\Cost;

use App\Http\Controllers\Controller;
use App\Models\Cost\CostCenterShared;
use App\Models\Cost\ProductCostUnit;
use Illuminate\Http\Request;

class ProductCostUnitController extends Controller
{
    private $list_view = 'pages.product-cost-unit.list';

    public function index()
    { return view($this->list_view)->with([
        'data' => ProductCostUnit::all(),
        'shares' => CostCenterShared::list(),
    ]); }
}