<?php

namespace App\Http\Controllers\Cost;

use App\Http\Controllers\Controller;
use App\Models\Cost\CostCenterShared;
use App\Models\Misc\Center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CostCenterSharedController extends Controller
{
    private $list_view = 'pages.cost-center-shared.list';
    public function index()
    {
        return view($this->list_view)->with([
            'data' => CostCenterShared::list(),
            'structures' => DB::table('center')->where('id_center_type', 1)->get()
        ]);
    }
}
