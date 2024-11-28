<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    protected AdminService $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index(): Response
    {
        $users = $this->adminService->index();
        return response($users);
    }
}
