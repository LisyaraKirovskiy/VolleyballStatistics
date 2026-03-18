<?php
namespace App\Repository\Player;
use App\Http\Requests\PlayerStoreRequest;
use App\Http\Requests\PlayerUpdateRequest;
use App\Models\Player;
use App\Repository\Player\PlayerRepositoryInterface;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;



class PlayerRepository implements PlayerRepositoryInterface
{
    private function checkPlayerAccess(Player $player): void
    {
        if (!auth()->check()) {
            throw new AuthorizationException('Пользователь не авторизован');
        }

        if ($player->user_id !== auth()->id()) {
            throw new AuthorizationException('У вас нет прав доступа к этому игроку');
        }
    }
    public function store(PlayerStoreRequest $playerStoreRequest): Player
    {
        $validated = $playerStoreRequest->validated();
        DB::beginTransaction();
        try {
            $newPlayer = Player::create([
                'name' => $validated['name'],
                'position' => $validated['position'],
                'team' => $validated['team'],
                'number' => $validated['number'],
                'user_id' => auth()->id(),
            ]);

            $newPlayer->save();
            DB::commit();
            return $newPlayer;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::critical($exception->getMessage());
            throw new BadRequestException($exception->getMessage());
        }
    }

    public function update(PlayerUpdateRequest $playerUpdateRequest, Player $player): Player
    {
        $this->checkPlayerAccess($player);
        $validated = $playerUpdateRequest->validated();
        DB::beginTransaction();
        try {
            $updateData = [
                'name' => $validated['name'],
                'position' => $validated['position'],
                'team' => $validated['team'],
                'number' => $validated['number'],
                'user_id' => auth()->id(),
            ];

            $player->update($updateData);
            DB::commit();

            return $player;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::critical($exception->getMessage());
            throw new BadRequestException($exception->getMessage());
        }

    }
    public function destroy(Player $player): Player
    {
        $this->checkPlayerAccess($player);
        DB::beginTransaction();
        try {
            $player->delete();
            DB::commit();
            return $player;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::critical($exception->getMessage());
            throw new BadRequestException($exception->getMessage());
        }
    }
}
