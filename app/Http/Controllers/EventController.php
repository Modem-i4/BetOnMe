<?php

namespace App\Http\Controllers;

use App\Repositories\EventRepository;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private $repos;
    public function __construct()
    {
        $this->middleware('auth');

        $this->repos = app(EventRepository::class);
    }
    public function index() {
        return view('pages.events');
    }
    public function myEventsIndex() {
        return view('pages.my_events');
    }
    public function all()
    {
        return $this->repos->getAll(false);
    }
    public function own() {
        return $this->repos->getAll(true);
    }
    public function changeLimit() {
        return $this->repos->changeLimit();
    }
    public function add() {
        app(UserController::class)->changeBalance();
        app(UserController::class)->progress(4);
        return $this->repos->add();
    }
}
