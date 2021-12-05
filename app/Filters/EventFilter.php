<?php


namespace App\Filters;


class EventFilter extends QueryFilter
{
    protected $searchable = [
        'base.id',
        'name',
        'text',
        'base.url',
        'categories',
        'published_at',
    ];

    protected $sortable = [
        'id',
        'published_at',
        'important'
    ];
}
