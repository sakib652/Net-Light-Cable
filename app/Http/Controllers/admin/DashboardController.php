<?php

namespace App\Http\Controllers\admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.pages.dashboard');
    }

    // public function table()
    // {
    //     return view('pages.table');
    // }

    // public function form()
    // {
    //     return view('admin.pages.form');
    // }
}