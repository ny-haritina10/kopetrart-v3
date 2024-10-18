<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Exercice extends Model
{
    use HasFactory;

    protected $table = 'exercice';
    public $timestamps = false;

    protected $fillable = [
        'no_account',
        'id_exercice_year',
        'label',
        'debit',
        'credit',
        'date'
    ];

    public static function list()
    {
        return DB::table('v_l_exercice')
                    ->select('id', 'no_account', 'label', 'id_exercice_year', 'exercice_year', 'debit', 'credit', 'date')
                    ->get();
    }
}
