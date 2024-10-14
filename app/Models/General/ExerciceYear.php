<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ExerciceYear extends Model
{
    use HasFactory;
    protected $table = 'exercice_year';

    public $timestamps = false;

    public static function options()
    { return DB::table('exercice_year')->pluck('label', 'id'); }
}
