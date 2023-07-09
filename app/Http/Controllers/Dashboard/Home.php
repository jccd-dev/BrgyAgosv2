<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Dashboard\Families;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\ProfilingModel;

class Home extends Controller{

    public function render(){
        $counts = $this->dashboard_counting();
        return view('dashboard.home', $counts);
    }

    public function dashboard_counting() {

        $profileModel = new ProfilingModel();

        return [
            'total'     => $profileModel::all()->count(),
            'female'    => $profileModel::where('sex', 'Female')->count(),
            'male'      => $profileModel::where('sex', 'Male')->count(),
            'senior'    => $profileModel::where('senior', 'sc')->count(),
            'pwd'       => $profileModel::where('pwd', 'pwd')->count(),
            'families'  => Families::all()->count()
        ];
    }
}
