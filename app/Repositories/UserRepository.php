<?php


namespace App\Repositories;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    function startConditions()
    {
        return app(User::class);
    }
    public function getAllWithPaginateAndFiltering()
    {
        $perPage = request('perPage');
        $columns = [
            'id',
            'name',
            'email',
            'role',
            'created_at as reg_time',
            'notifications_receiver',
        ];

        return $this->startConditions()
            ->select($columns)
            ->filter()
            ->paginate($perPage);
    }
    public function achievements() {
        $userId = Auth::id();
        return $this->startConditions()
            ->where('id',$userId)
            ->first('achievements');
    }
    public function progress($id) {
        $userId = Auth::id();
        $id = $id === null ? request('id') : $id;
        $achievements = $this->startConditions()
            ->where('id',$userId)
            ->first('achievements')['achievements'];
        $achievements = $this->updateProgress($achievements,$id);
        return $this->startConditions()
            ->where('id',$userId)
            ->update(['achievements' => $achievements]);
    }
    private function updateProgress($achievements,$id) {
        foreach ($achievements as &$achievement) {
            if($achievement['id'] === $id) {
                $achievement['progress']++;
                return $achievements;
            }
        }
        $o = new \stdClass();
        $o->id = $id;
        $o->progress = 1;
        $achievements[] = $o;
        return $achievements;
    }
    public function changeBalance() {
        $userId = Auth::id();
        $balance = $this->startConditions()
            ->where('id',$userId)
            ->first('balance')['balance'];
        return $this->startConditions()
            ->where('id',$userId)
            ->update(['balance' => $balance+request('balance')]);
    }
}
