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
        $family_details = $request->post('familydata');
        $family_members = $request->post('members');

        $formated_members = [];

        foreach($family_members as $key => $val){
            array_push($formated_members, [
                'resident_id' => $key,
                'family_role' => $val
            ]);
        }

        dd($formated_members);

        $family = Families::create($family_details);
    }
}
