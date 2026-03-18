<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerStoreRequest;
use App\Http\Requests\PlayerUpdateRequest;
use App\Models\Player;
use App\Repository\Player\PlayerRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;



class PlayerController extends Controller
{
    public function __construct(private readonly PlayerRepository $playerRepository)
    {
        $this->middleware('auth');
    }

    public function index(Request $request): View
    {
        $players = auth()->user()->players()

            ->filter($request)
            ->orderBy('name', 'asc')
            ->paginate(10);
        return view("players.index", compact("players"));
    }


    public function create()
    {
        return view("players.create");
    }


    public function store(PlayerStoreRequest $playerStoreRequest): RedirectResponse
    {
        $this->playerRepository->store($playerStoreRequest);
        return redirect()->route("players.index")->with("success", "Игрок успешно добавлен.");
    }


    public function show(Player $player): View
    {
        if ($player->user_id !== auth()->id()) {
            abort(403, 'У вас нет прав для просмотра этого игрока');
        }
        return view("players.show", ['player' => $player]);
    }


    public function edit(Player $player): View
    {
        if ($player->user_id !== auth()->id()) {
            abort(403, 'У вас нет прав для редактирования этого игрока');
        }
        return view('players.edit', ['player' => $player]);
    }


    public function update(PlayerUpdateRequest $playerUpdateRequest, Player $player)
    {
        if ($player->user_id !== auth()->id()) {
            abort(403, 'У вас нет прав для редактирования этого игрока');
        }
        $this->playerRepository->update($playerUpdateRequest, $player);
        return redirect()->route('players.show', $player->id)->with('success', 'Игрок успешно изменен.');
    }


    public function destroy(Player $player): RedirectResponse
    {
        if ($player->user_id !== auth()->id()) {
            abort(403, 'У вас нет прав для удаления этого игрока');
        }
        $this->playerRepository->destroy($player);
        return redirect()->route('players.index')->with('success', 'Игрок успешно удален');
    }
}
