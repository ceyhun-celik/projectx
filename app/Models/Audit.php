<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Audit extends Model
{
    use HasFactory;

    protected $table = 'audits';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function setAuditableTypeWithoutPath(): string
    {
        $auditable_type = explode('\\', $this->auditable_type);
        return end($auditable_type);
    }

    public function decodeOldValues(): array
    {
        return json_decode($this->old_values, true);
    }

    public function decodeNewValues(): array
    {
        return json_decode($this->new_values, true);
    }
}
