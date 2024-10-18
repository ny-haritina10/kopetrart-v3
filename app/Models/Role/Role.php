<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model 
{
    use HasFactory;
    protected $fillable = ['label'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}