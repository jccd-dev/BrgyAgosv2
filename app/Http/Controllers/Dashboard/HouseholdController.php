<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Dashboard\FamilyMembers;
use App\Models\Dashboard\HouseholdFamilies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Dashboard\Household;
use App\Http\Controllers\Controller;

class HouseholdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.household');
    }

    //get all the household data in database
    public function get_households(){
        $data = Household::all();

        return response()->json(['households' => $data], 200);
    }

    //add or insert new household data in database
    public function add_household(Request $request){
        $household_details = $request->post('householddata');
        $household_members = $request->post('members');

        DB::beginTransaction();

        try{
            $household = Household::create($household_details);

            foreach($household_members as $members){
                $mem_instance = new HouseholdFamilies([
                    'families_id' => $members
                ]);

                // $household->household_fam()->insert($members);
                $household->household_fam()->save($mem_instance);
            }

            DB::commit();
        }
        catch (\Throwable $th){
            DB::rollBack();
            dd($th);
        }
    }

    public function household_update($household_id){
        $household_data = Household::find($household_id);

        return view('dashboard.update-household', ['data' => $household_data]);
    }
    public function get_household_families($household_id){
        $household_data = HouseholdFamilies::with('families')->where('household_id', $household_id)->get();

        return response()->json(['fam' => $household_data], 200);
    }



}
