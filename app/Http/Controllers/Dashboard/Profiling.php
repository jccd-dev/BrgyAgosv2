<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

class Profiling extends Controller
{
    public function render(){
        return view('dashboard.profiling');
    }
}
