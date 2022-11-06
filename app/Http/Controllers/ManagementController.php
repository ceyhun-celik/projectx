<?php

namespace App\Http\Controllers;

class ManagementController extends Controller
{
    public function index()
    {
        return view('pages.management.index');
    }
}
