<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Support\Facades\Log;

class RolesController extends Controller
{
    public function index()
    {
        try {
            $roles = Role::select('id', 'role_name', 'role_code', 'created_at')->paginate(10);
            return view('pages.roles.index', compact('roles'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }
}