<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Score extends Model
{
    protected $fillable = [
        'player_id',
        'type',
        'x',
        'y',
        'result',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
}
