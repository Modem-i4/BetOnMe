<?php


namespace App\Repositories;


use App\Models\Achievement;
use Illuminate\Support\Facades\DB;

class AchievementRepository
{
    function startConditions()
    {
        return app(Achievement::class);
    }
    public function getAll()
    {
        $columns = [
            'base.id',
            'base.title',
            'base.description',
            'base.congratulation',
            'base.image',
            'base.quantity',
        ];
        return $this->startConditions()
            ->from('achievements as base')
            ->select($columns)
            ->get();
    }
}
