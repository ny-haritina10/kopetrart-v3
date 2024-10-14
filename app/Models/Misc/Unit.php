<?php

namespace App\Models\Misc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'unit';
    public $timestamps = false;

    public static function options()
    { return DB::table('unit')->pluck('label', 'id'); }
}
