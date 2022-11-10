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
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function setAuditableTypeWithoutPath()
    {
        $auditable_type = explode('\\', $this->auditable_type);
        return end($auditable_type);
    }

    public function decodeOldValues()
    {
        return json_decode($this->old_values, true);
    }

    public function decodeNewValues()
    {
        return json_decode($this->new_values, true);
    }
}
