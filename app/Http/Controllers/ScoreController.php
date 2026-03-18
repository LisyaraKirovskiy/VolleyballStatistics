<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScoreStoreRequest;
use App\Models\Player;
use App\Repository\Score\ScoreRepository;
use Illuminate\Http\RedirectResponse;

class ScoreController extends Controller
{
    public function __construct(private readonly ScoreRepository $scoreRepository)
    {
        $this->middleware('auth');
    }
    public function store(ScoreStoreRequest $scoreStoreRequest, Player $player): RedirectResponse
    {
        $this->scoreRepository->store($scoreStoreRequest, $player);
        return redirect()->back()->with("success", "Данные успешно добавлены.")->withFragment('display-options');
    }

    public function destroy(string $id)
    {
        //
    }

    public function clearAllScores(Player $player): RedirectResponse
    {
        $this->scoreRepository->clearAllScores($player);
        return redirect()->back()->with('success', 'Данные успешно очищены');
    }
}
