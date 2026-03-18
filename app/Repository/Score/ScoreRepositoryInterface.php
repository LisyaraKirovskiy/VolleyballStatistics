<?php

namespace App\Repository\Score;
use App\Http\Requests\ScoreStoreRequest;
use App\Models\Player;
use App\Models\Score;

interface ScoreRepositoryInterface
{
    public function store(ScoreStoreRequest $scoreStoreRequest, Player $player): Score;
    public function destroy(Score $score): Score;
    public function clearAllScores(Player $player): Player;
}
