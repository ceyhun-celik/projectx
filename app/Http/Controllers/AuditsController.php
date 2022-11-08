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
     * @param  \App\Http\Requests\AuditsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(AuditsRequest $request)
    {
        extract($request->validated());

        try {
            $audits = Audit::query()
                ->with([
                    'user' => fn($user) => $user->select('id', 'name')
                ])
                ->select('id', 'user_id', 'event', 'auditable_type', 'auditable_id', 'ip_address', 'created_at')
                ->when($search, function($query, $search){
                    $query->whereHas('user', function($user) use($search){
                        $user->where('name', 'like', "%{$search}%");
                    })
                    ->orWhere('event', 'like', "%{$search}%")
                    ->orWhere('auditable_type', 'like', "%{$search}%")
                    ->orWhere('ip_address', 'like', "%{$search}%");
                })
                ->orderByDesc('id')
                ->paginate(10);
                
            return view('pages.audits.index', compact('audits'));
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AuditsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuditsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $audit = Audit::query()
                ->with([
                    'user' => fn($user) => $user->select('id', 'name')
                ])
                ->select('id', 'user_id', 'event', 'auditable_type', 'auditable_id', 'old_values', 'new_values', 'ip_address', 'user_agent', 'created_at')
                ->find($id);

            return view('pages.audits.show', compact('audit'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AuditsRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AuditsRequest $request, $id)
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
        //
    }
}
