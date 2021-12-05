<?php


namespace App\Filters;


class UserFilter extends QueryFilter
{
    protected $searchable = [
        'id',
        'name',
        'email',
    ];

    protected $sortable = [
        'id',
        'name',
        'email',
        'reg_time',
    ];
}
