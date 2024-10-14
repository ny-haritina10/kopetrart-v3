<?php

namespace App\Models\Misc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Incorporation extends Model
{
    use HasFactory;

    protected $table = 'incorporation';

    public static function options()
    { return DB::table('incorporation')->pluck('label', 'id'); }
}
