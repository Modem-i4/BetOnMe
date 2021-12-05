<?php


namespace App\Repositories;


use App\Models\Bet;
use Illuminate\Support\Facades\Auth;

class BetsRepository
{
    function startConditions()
    {
        return app(Bet::class);
    }

    public function add() {
        $userId = Auth::id();
        return $this->startConditions()
            ->select('bets')
            ->insert([
                'user_id' => $userId,
                'event_id' => request('event_id'),
                'cases' => json_encode(request('cases')),
            ]);
    }
}
