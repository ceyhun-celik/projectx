<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Contracts\View\View;

class ChangePasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('pages.change-password.index');
    }


    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ChangePasswordRequest $request)
    {
        //
    }
}
