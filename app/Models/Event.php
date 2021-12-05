<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class Event extends Model
{
    use HasFactory, Filterable;
    protected $casts = [
        'due_date' => 'datetime:d M H:i',
        'cases' => 'array',
        ];
}
