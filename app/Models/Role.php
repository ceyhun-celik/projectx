<?php

namespace App\Models;

use App\Enums\Roles\RoleCodes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<string>
     */
    protected $fillable = [
        'role_name',
        'role_code'
    ];

    public function authorization(): HasMany
    {
        return $this->hasMany(Authorization::class, 'role_code', 'role_code');
    }

    /**
     * Where role code equal to root
     */
    public function scopeRoot(Builder $query): Role
    {
        return $query->whereRoleCode(RoleCodes::ROOT->value)->first();
    }

    /**
     * Where role code equal to visitor
     */
    public function scopeVisitor(Builder $query): Role
    {
        return $query->whereRoleCode(RoleCodes::VISITOR->value)->first();
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::deleted(function (Role $role) {
            Authorization::whereRoleCode($role->role_code)->delete();
        });
    }
}
