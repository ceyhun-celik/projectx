<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'updated_at',
        'deleted_at'
    ];

    public const ROOT = 'root';
    public const VISITOR = 'visitor';

    public function authorization(): HasMany
    {
        return $this->hasMany(Authorization::class, 'role_code', 'role_code');
    }

    public function scopeRoot(Builder $query)
    {
        return $query->whereRoleCode(self::ROOT)->first();
    }

    public function scopeVisitor(Builder $query)
    {
        return $query->whereRoleCode(self::VISITOR)->first();
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::deleted(function (Role $role) {
            Authorization::whereRoleCode($role->role_code)->delete();
        });
    }
}
