<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Filter;

class Player extends Model
{
    /** @use HasFactory<\Database\Factories\PlayerFactory> */
    use HasFactory, Filter;
    protected $fillable = [
        'name',
        'position',
        'team',
        'number',
        'user_id'
    ];

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
