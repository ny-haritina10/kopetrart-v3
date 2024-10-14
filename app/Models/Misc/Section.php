<?php

namespace App\Models\Misc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Section extends Model
{
    use HasFactory;

    protected $table = 'section';
    public $timestamps = false;

    public static function options()
    { return DB::table('section')->pluck('label', 'id'); }

    public static function list()
    {
        return DB::table('v_l_section')
                    ->select('id', 'label', 'id_unit', 'unit', 'id_nature', 'nature', 'id_incorporation', 'incorporation')
                    ->get();
    }
}
