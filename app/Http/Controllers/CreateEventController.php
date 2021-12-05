<?php

namespace App\Http\Controllers;

use App\Repositories\EventRepository;
use Illuminate\Http\Request;

class CreateEventController extends Controller
{
    private $repos;
    public function __construct()
    {
        $this->middleware('auth');

        $this->repos = app(EventRepository::class);
    }
    public function index() {
        return view('pages.create-event');
    }
    public function all()
    {
        return $this->repos->all();
    }
}
