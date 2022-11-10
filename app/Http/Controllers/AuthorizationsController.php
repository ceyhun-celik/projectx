<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorizationsRequest;
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
        $request = $request->validated();
        extract($request);

        try {
            $authorizations = Authorization::query()
                ->with([
                    'user' => fn($user) => $user->select('id', 'name'),
                    'role' => fn($role) => $role->select('id', 'role_name')
                ])
                ->select('id', 'user_id', 'role_id', 'status', 'created_at')
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
        try {
            $users = User::query()
                ->select('id', 'name')
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
        return view('pages.authorizations.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Authorization::destroy($id);
            return redirect()->back()->with('success', __('Deleted'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }
}
