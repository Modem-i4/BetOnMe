<?php


namespace App\Filters;


class EventFilter extends QueryFilter
{
    protected $searchable = [
        'base.id',
        'title',
        'description'
    ];

    protected $sortable = [
    ];
}
