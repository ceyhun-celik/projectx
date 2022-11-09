<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;

    protected $table = 'audits';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setAuditableTypeWithoutPath()
    {
        $auditable_type = explode('\\', $this->auditable_type);
        return end($auditable_type);
    }
}
