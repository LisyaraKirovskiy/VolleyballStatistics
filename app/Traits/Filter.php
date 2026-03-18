<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait Filter
{

    public function scopeFilter($query, Request $request): Builder
    {
        if ($request->has("name") && $request->get('name') != null) {
            $query->where('name', 'like', '%' . $request->get('name') . '%');
        }
        if ($request->has("position") && $request->get('position') != null) {
            $query->where('position', 'like', '%' . $request->get('position') . '%');
        }
        if ($request->has("team") && $request->get('team') != null) {
            $query->where('team', 'like', '%' . $request->get('team') . '%');
        }
        if ($request->has("number") && $request->get('number') != null) {
            $query->where('number', 'like', '%' . $request->get('number') . '%');
        }
        return $query;
    }
}
