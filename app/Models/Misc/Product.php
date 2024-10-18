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

    public static function get_unit_price(int $id) 
    {
        return DB::table('v_product_cost_unit')
                ->select('price_unit')
                ->where('id', '=', $id)
                ->first(); 
    }

    public static function get_selling_price(int $id)
    {
        return DB::table('v_product_selling_price')
                    ->select('selling_price')
                    ->where('id', '=', $id)
                    ->first();
    }
}
