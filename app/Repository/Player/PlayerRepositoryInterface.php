<?php

namespace App\Repository\Player;
use App\Models\Player;
use App\Http\Requests\PlayerStoreRequest;
use App\Http\Requests\PlayerUpdateRequest;

interface PlayerRepositoryInterface
{
    public function store(PlayerStoreRequest $playerStoreRequest): Player;
    public function update(PlayerUpdateRequest $playerUpdateRequest, Player $player): Player;
    public function destroy(Player $player): Player;
}
