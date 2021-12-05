<?php


namespace App\Filters;


class AchievementFilter extends QueryFilter
{
    protected $searchable = [
        'base.name',
    ];

    protected $sortable = [
        'base.name',
        'base.display',
    ];
}
