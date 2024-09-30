<?php

namespace App\Services;

use App\Models\User;

class AdminService {
    public function index()
    {
        return User::paginate(10);
    }
}