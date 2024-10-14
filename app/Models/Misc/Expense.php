<?php

namespace App\Models\Misc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'expense';
    public $timestamps = false;

    public static function list()
    {
        return DB::table('v_l_expense')
                        ->select('id', 'id_section', 'quantity', 'price', 'date', 'label', 'id_unit', 'unit', 'id_nature', 'nature', 'id_incorporation', 'incorporation')
                        ->get();
    }
}
