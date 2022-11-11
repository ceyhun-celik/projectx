<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Audit extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'audits';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    /**
     * Auditable type returns with path. This function is removed them.
     */
    public function setAuditableTypeWithoutPath(): string
    {
        $auditable_type = explode('\\', $this->auditable_type);
        return end($auditable_type);
    }

    /**
     * old values column keeps value as json. This function is return as array
     */
    public function decodeOldValues(): array
    {
        return json_decode($this->old_values, true);
    }

    /**
     * old values column keeps value as json. This function is return as array
     */
    public function decodeNewValues(): array
    {
        return json_decode($this->new_values, true);
    }
}
