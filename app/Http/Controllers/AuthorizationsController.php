<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorizationsRequest;
use App\Models\Audit;
use App\Models\Authorization;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AuthorizationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AuthorizationsRequest $request)
    {
        $this->authorize('viewAny', Authorization::class);

        $request = $request->validated();
        extract($request);

        try {
            $authorizations = Authorization::select('id', 'user_id', 'role_id', 'status', 'created_at')
                ->with([
                    'user' => fn($user) => $user->select('id', 'name'),
                    'role' => fn($role) => $role->select('id', 'role_name')
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
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Authorization::class);

        try {
            $users = User::select('id', 'name')
                ->whereNotIn('id', Authorization::pluck('user_id'))
                ->orderBy('name')
                ->get();
            
            $roles = Role::select('id', 'role_name')->orderBy('role_name')->get();
            
            return view('pages.authorizations.create', compact('users', 'roles'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AuthorizationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorizationsRequest $request)
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Authorization::class);

        try {
            $authorization = Authorization::select('id', 'user_id', 'role_id', 'status', 'created_at')->find($id);
            return view('pages.authorizations.show', compact('authorization'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Authorization::class);

        try {
            $authorization = Authorization::select('id', 'user_id', 'role_id', 'status')->find($id);
            $roles = Role::select('id', 'role_name')->orderBy('role_name')->get();
            return view('pages.authorizations.edit', compact('authorization', 'roles'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AuthorizationsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorizationsRequest $request, $id)
    {
        $this->authorize('update', Authorization::class);

        try {
            Authorization::find($id)->update($request->validated());
            return redirect()->route('authorizations.show', $id)->with('success', __('Updated'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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
     *
     * @param  int  $id
     * @param  \App\Http\Requests\AuthorizationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function audits(AuthorizationsRequest $request, $id)
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
