<?php

namespace App\Http\Controllers;

use App\Repositories\BetsRepository;
use App\Repositories\EventRepository;
use Illuminate\Http\Request;

class BetController extends Controller
{
    private $repos;
    public function __construct()
    {
        $this->middleware('auth');

        $this->repos = app(BetsRepository::class);
    }
    public function add()
    {
        app(EventController::class)->changeLimit();
        app(UserController::class)->changeBalance();
        app(UserController::class)->progress(2);
        return $this->repos->add();
    }
}
