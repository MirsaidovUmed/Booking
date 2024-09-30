<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        $users = $this->adminService->index();
        return response($users);
    }
}
