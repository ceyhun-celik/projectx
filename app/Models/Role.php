<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'roles';

    protected $fillable = [
        'role_name',
        'role_code'
    ];

    public function authorization()
    {
        return $this->hasMany(Authorization::class);
    }
}
