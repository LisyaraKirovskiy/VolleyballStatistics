<?php
namespace App\Repository\Score;
use App\Http\Requests\ScoreStoreRequest;
use App\Models\Player;
use App\Models\Score;
use App\Repository\Score\ScoreRepositoryInterface;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;



class ScoreRepository implements ScoreRepositoryInterface
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

    public function store(ScoreStoreRequest $scoreStoreRequest, Player $player): Score
    {

        $this->checkPlayerAccess($player);
        $validated = $scoreStoreRequest->validated();
        DB::beginTransaction();
        try {
            $newScore = $player->scores()->create([
                'x' => $validated['x'],
                'y' => $validated['y'],
                'type' => $validated['type'],
                'result' => $validated['result'],
            ]);

            DB::commit();
            return $newScore;

        } catch (Exception $exception) {
            DB::rollBack();
            Log::critical($exception->getMessage());
            throw new BadRequestException($exception->getMessage());
        }
    }

    public function destroy(Score $score): Score
    {
        $this->checkPlayerAccess($score->player);
        if ($score->player()->user_id != auth()->id()) {
            throw new AuthorizationException('Нет прав доступа');
        }
        DB::beginTransaction();
        try {
            $score->delete();
            DB::commit();
            return $score;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::critical($exception->getMessage());
            throw new BadRequestException($exception->getMessage());
        }
    }

    public function clearAllScores(Player $player): Player
    {
        $this->checkPlayerAccess($player);
        DB::beginTransaction();
        try {
            $player->scores()->delete();
            DB::commit();
            return $player;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::critical($exception->getMessage());
            throw new BadRequestException($exception->getMessage());
        }
    }
}
