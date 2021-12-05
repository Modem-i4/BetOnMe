<?php


namespace App\Repositories;


use App\Models\Bet;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventRepository
{
    function startConditions()
    {
        return app(Event::class);
    }
    public function getAll($own)
    {
        $perPage = request('perPage');
        $columns = [
            'base.id',
            'base.title',
            'base.description',
            'base.image',
            'base.created_at',
            'base.cases',
            'base.sum_limit',
            'base.due_date',

            'users.id as user_id',
            'users.name',
        ];
        $query = $this->startConditions()
            ->from('events as base')
            ->select($columns)
            ->join('users', 'base.author', '=', 'users.id');

        if($own) {
            $userId = Auth::id();
            $query = $query
                ->where('author', $userId);
        }
        return $query
            ->filter()
            ->paginate($perPage);

    }
    public function changeLimit() {
        return $this->startConditions()
            ->where('id', request('event_id'))
            ->update(['sum_limit' => request('new_limit')]);
    }
    public function add() {
        $userId = Auth::id();
        return $this->startConditions()
            ->select('events')
            ->insert([
                'author' => $userId,
                'title' =>  request('title'),
                'description' =>  request('description'),
                'sum_limit' =>  request('limit'),
                'due_date' =>  request('due_date'),
                'cases' => json_encode(request('cases')),
            ]);
    }
}
