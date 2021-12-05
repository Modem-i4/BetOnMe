<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;

class UserController extends Controller
{
    private $repos;
    public function __construct()
    {
        $this->middleware('auth');

        $this->repos = app(UserRepository::class);
    }
    public function index() {
        return view('admin.users');
    }
    public function all()
    {
        return $this->repos->getAllWithPaginateAndFiltering();
    }
    public function achievements() {
        return $this->repos->achievements();
    }
    public function progress($id) {
        return $this->repos->progress($id);
    }
    public function changeBalance() {
        return $this->repos->changeBalance();
    }
}
