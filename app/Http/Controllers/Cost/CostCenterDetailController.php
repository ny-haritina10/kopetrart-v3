<?php

namespace App\Http\Controllers\Cost;

use App\Http\Controllers\Controller;
use App\Models\Cost\CostCenterDetail;
use App\Models\Misc\Center;
use App\Models\Misc\Nature;
use Illuminate\Http\Request;

class CostCenterDetailController extends Controller
{
    private $list_view = 'pages.cost-center-detail.list';

    public function index()
    { return view($this->list_view)->with([
        'centers' => Center::all(),
        'natures' => Nature::all(),
        'data' => CostCenterDetail::list()
    ]); }
}
