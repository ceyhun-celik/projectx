<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Contracts\View\View;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('pages.profile.index');
    }


    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        //
    }
}
