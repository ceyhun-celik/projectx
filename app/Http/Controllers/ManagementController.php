<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class ManagementController extends Controller
{
    public function index(): View
    {
        return view('pages.management.index');
    }
}
