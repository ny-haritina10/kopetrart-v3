<?php

namespace App\Models\Misc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    public $timestamps = false;

    public static function list()
    {
        return DB::table('v_l_product')
                    ->select('id', 'label', 'quantity', 'id_unit', 'unit')
                    ->get();
    }
}
