<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorizationsRequest;
use App\Models\Audit;
use App\Models\Authorization;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthorizationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AuthorizationsRequest $request): View
    {
        $this->authorize('viewAny', Authorization::class);

        $request = $request->validated();
        extract($request);

        try {
            $authorizations = Authorization::select('id', 'user_id', 'role_code', 'status', 'language', 'created_at')
                ->with([
                    'user' => fn($user) => $user->select('id', 'name'),
                    'role' => fn($role) => $role->select('id', 'role_code', 'role_name')
                ])
                ->when($search, function($query, $search){
                    $query->whereHas('user', function($user) use($search){
                        $user->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('role', function($role) use($search){
                        $role->where('role_name', 'like', "%{$search}%");
                    });
                })
                ->paginate(10);

            return view('pages.authorizations.index', compact('authorizations'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', Authorization::class);

        try {
            $users = User::select('id', 'name')
                ->whereNotIn('id', Authorization::pluck('user_id'))
                ->orderBy('name')
                ->get();
            
            $roles = Role::select('id', 'role_name', 'role_code')->orderBy('role_name')->get();
            
            return view('pages.authorizations.create', compact('users', 'roles'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorizationsRequest $request): RedirectResponse
    {
        $this->authorize('create', Authorization::class);

        try {
            $create = Authorization::create($request->validated());
            return redirect()->route('authorizations.show', $create->id)->with('success', __('Saved'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): View
    {
        $this->authorize('view', Authorization::class);

        try {
            $authorization = Authorization::select('id', 'user_id', 'role_code', 'status', 'language', 'created_at')->find($id);
            return view('pages.authorizations.show', compact('authorization'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $this->authorize('update', Authorization::class);

        try {
            $authorization = Authorization::select('id', 'user_id', 'role_code', 'status', 'language')->find($id);
            $roles = Role::select('id', 'role_name', 'role_code')->orderBy('role_name')->get();
            return view('pages.authorizations.edit', compact('authorization', 'roles'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorizationsRequest $request, int $id): RedirectResponse
    {
        $this->authorize('update', Authorization::class);

        # update language if authorized user is update themself
        if(Auth::user()->id == Authorization::find($id)->user_id){
            Session::put('language', $request->language);
        }

        try {
            Authorization::find($id)->update($request->validated());
            return redirect()->route('authorizations.show', $id)->with('success', __('Updated'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->authorize('delete', Authorization::class);

        try {
            Authorization::destroy($id);
            return redirect()->back()->with('success', __('Deleted'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Display the audits of specified resource.
     */
    public function audits(AuthorizationsRequest $request, int $id): View
    {
        $this->authorize('view', Authorization::class);
        
        $request = $request->validated();
        extract($request);

        try {
            $audits = Audit::select('id', 'user_id', 'event', 'old_values', 'new_values')
                ->addSelect('user_agent', 'ip_address', 'created_at')
                ->whereAuditableType('App\\Models\\Authorization')
                ->whereAuditableId($id)
                ->when($search, function($query, $search){
                    $query->whereHas('user', function($user) use($search){
                        $user->where('name', 'like', "%{$search}%");
                    });
                })
                ->orderByDesc('id')
                ->paginate(10)
                ->appends($request);

            return view('pages.authorizations.audits', compact('id', 'audits'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }
}
