<?php

namespace App\Http\Controllers;

use App\Repositories\AchievementRepository;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    private $repos;
    public function __construct()
    {
        $this->middleware('auth');

        $this->repos = app(AchievementRepository::class);
    }
    public function index() {
        return view('pages.achievements');
    }
    public function all()
    {
        return $this->repos->getAll();
    }
}
