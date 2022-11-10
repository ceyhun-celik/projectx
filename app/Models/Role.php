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

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public const ROOT = 'root';
    public const VISITOR = 'visitor';

    public function authorization()
    {
        return $this->hasMany(Authorization::class);
    }

    public function scopeRoot($query)
    {
        return $query->whereRoleCode(self::ROOT)->first();
    }

    public function scopeVisitor($query)
    {
        return $query->whereRoleCode(self::VISITOR)->first();
    }
}
