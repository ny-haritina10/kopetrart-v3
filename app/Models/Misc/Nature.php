<?php

namespace App\Models\Misc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Nature extends Model
{
    use HasFactory;

    protected $table = 'nature';

    public static function options()
    { return DB::table('nature')->pluck('label', 'id'); }
}
