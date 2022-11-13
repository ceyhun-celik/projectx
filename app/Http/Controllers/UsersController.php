<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Models\Audit;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersRequest $request): View
    {
        $this->authorize('viewAny', User::class);

        $request = $request->validated();
        extract($request);

        try {
            $users = User::select('id', 'name', 'email', 'created_at')
                ->when($search, function($query, $search){
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                ->orderBy('name')
                ->paginate(10)
                ->appends($request);

            return view('pages.users.index', compact('users'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', User::class);

        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsersRequest $request): RedirectResponse
    {
        $this->authorize('create', User::class);

        try {
            $create = User::create($request->validated());
            return redirect()->route('users.show', $create->id)->with('success', __('Saved'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): View
    {
        $this->authorize('view', User::class);

        try {
            $user = User::select('id', 'name', 'email', 'created_at')->find($id);
            return view('pages.users.show', compact('user'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $this->authorize('update', User::class);

        try {
            $user = User::select('id', 'name', 'email')->find($id);
            return view('pages.users.edit', compact('user'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsersRequest $request, int $id): RedirectResponse
    {
        $this->authorize('update', User::class);

        $request = $request->validated();

        if(! $request['password']){
            unset($request['password']);
        }

        try {
            User::find($id)->update($request);
            return redirect()->route('users.show', $id)->with('success', __('Updated'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->authorize('delete', User::class);

        try {
            User::destroy($id);
            return redirect()->back()->with('success', __('Deleted'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Display a listing of the trash resource.
     */
    public function trash(UsersRequest $request)
    {
        $this->authorize('trash', User::class);

        $request = $request->validated();
        extract($request);

        try {
            $users = User::select('id', 'name', 'email', 'created_at', 'deleted_at')
                ->when($search, function($query, $search){
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                ->orderBy('name')
                ->onlyTrashed()
                ->paginate(10)
                ->appends($request);

            return view('pages.users.trash', compact('users'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Display the specified deleted resource.
     */
    public function deleted(int $id): View
    {
        $this->authorize('trash', User::class);

        try {
            $user = User::select('id', 'name', 'email', 'created_at', 'deleted_at')->onlyTrashed()->find($id);
            return view('pages.users.deleted', compact('user'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Restore the specified resource in storage.
     */
    public function restore(int $id): RedirectResponse
    {
        $this->authorize('restore', User::class);

        try {
            User::onlyTrashed()->find($id)->restore();
            return redirect()->back()->with('success', __('Restored'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Display the watch of specified resource.
     */
    public function watch(UsersRequest $request, int $id): View
    {
        $this->authorize('view', User::class);

        $request = $request->validated();
        extract($request);

        try {
            $audits = Audit::select('id', 'user_id', 'event', 'auditable_type', 'auditable_id', 'old_values')
                ->addSelect('new_values', 'url', 'ip_address', 'user_agent', 'created_at')
                ->where('user_id', $id)
                ->when($search, function($query, $search){
                    $query->where('event', 'like', "%{$search}%")
                        ->orWhere('auditable_type', 'like', "%{$search}%")
                        ->orWhere('ip_address', 'like', "%{$search}%");
                })
                ->orderByDesc('id')
                ->paginate(10);

            return view('pages.users.watch', compact('id', 'audits'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }

    /**
     * Display the audits of specified resource.
     */
    public function audits(UsersRequest $request, int $id): View
    {
        $this->authorize('view', User::class);
        
        $request = $request->validated();
        extract($request);

        try {
            $audits = Audit::select('id', 'user_id', 'event', 'old_values', 'new_values')
                ->addSelect('user_agent', 'ip_address', 'created_at')
                ->whereAuditableType('App\\Models\\User')
                ->whereAuditableId($id)
                ->when($search, function($query, $search){
                    $query->whereHas('user', function($user) use($search){
                        $user->where('name', 'like', "%{$search}%");
                    });
                })
                ->orderByDesc('id')
                ->paginate(10)
                ->appends($request);

            return view('pages.users.audits', compact('id', 'audits'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }
}
