<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuditsRequest;
use App\Models\Audit;
use Illuminate\Support\Facades\Log;

class AuditsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\AuditsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(AuditsRequest $request)
    {
        $this->authorize('viewAny', Audit::class);

        $request = $request->validated();
        extract($request);

        try {
            $audits = Audit::select('id', 'user_id', 'event', 'auditable_type', 'auditable_id', 'ip_address', 'created_at')
                ->with([
                    'user' => fn($user) => $user->select('id', 'name')
                ])
                ->when($search, function($query, $search){
                    $query->whereHas('user', function($user) use($search){
                        $user->where('name', 'like', "%{$search}%");
                    })
                    ->orWhere('event', 'like', "%{$search}%")
                    ->orWhere('auditable_type', 'like', "%{$search}%")
                    ->orWhere('ip_address', 'like', "%{$search}%");
                })
                ->orderByDesc('id')
                ->paginate(10)
                ->appends($request);
                
            return view('pages.audits.index', compact('audits'));
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
        $this->authorize('view', Audit::class);

        try {
            $audit = Audit::select('id', 'user_id', 'event', 'auditable_type', 'auditable_id')
                ->addSelect('old_values', 'new_values', 'ip_address', 'user_agent', 'created_at')
                ->with([
                    'user' => fn($user) => $user->select('id', 'name')
                ])
                ->find($id);

            return view('pages.audits.show', compact('audit'));
        } catch (\Throwable $th) {
            Log::channel('catch')->info($th);
        }
    }
}
