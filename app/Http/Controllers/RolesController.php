<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;

class RolesController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Role::class);

        try {
            $roles = Role::select('id', 'role_code', 'created_at')->paginate(10);
            return view('pages.roles.index', compact('roles'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }
}
