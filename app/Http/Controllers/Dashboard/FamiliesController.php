<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Families;
use Illuminate\Http\Request;

class FamiliesController extends Controller
{
    public function render(){
        return view('dashboard.family');
    }

    public function add_family(Request $request){
        dd($request->all());
    }
}
