<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Dashboard\FamilyMembers;
use Illuminate\Http\Request;
use App\Models\Dashboard\Families;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FamiliesController extends Controller
{
    public function render(){
        return view('dashboard.family');
    }

    public function add_family(Request $request){
        $family_details = $request->post('familydata');
        $family_members = $request->post('members');

        $formatted_members = [];

        foreach($family_members as $key => $val){
            array_push($formatted_members, [
                'resident_id' => $key,
                'family_role' => $val
            ]);
        }

        // create a database transaction
        DB::beginTransaction();

        //it make sure that inserting to database is completed without error
        try {
            $family = Families::create($family_details);
            $family->family_members()->createMany($formatted_members);
            DB::commit();

            return response()->json(['success'=> 'family successfully saved'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            // dd($th);
            return response()->json(['error'=> 'family successfully saved'], 500);
        }

    }

    // get all families data
    public function get_families(){
         $data = Families::all();

        return response()->json(['families' => $data], 200);
    }

    public function update_family($family_id){
         $family = Families::with('family_members.resident')->find($family_id);

         return view('dashboard.update-family', ['fam_data' => $family]);
    }

    public function get_family_members($family_id){
        $fam_members = FamilyMembers::with('resident')->where('families_id', $family_id)->get();
        // dd($fam_members);
        return response()->json(['members' =>$fam_members], 200,);
    }

    public function delete_family(Request $request){

        $family = Families::find($request->id);
        if($family->delete()){
            return response()->json(['success' => 'Profile Deleted'], 200);
        }

        return response()->json(['errors' => 'Server Error'], 500);
    }

    public function update_family_data(Request $req){
        $family_details = $req->post('familydata');
        $family_members = $req->post('members');
        $to_delete = $req->post('removedMembers');
        $fam_id = $req->post('famID');

        // dd($family_details);

        $formatted_members = [];

        foreach($family_members as $key => $val){
            array_push($formatted_members, [
                'resident_id' => $key,
                'family_role' => $val
            ]);
        }

        DB::beginTransaction();

        //it make sure that inserting to database is completed without error
        try {
            $family = Families::find($fam_id);

            $family->update($family_details);

            // update existing data and if id is not in the database then it create
            foreach ($formatted_members as $member) {
                $family->family_members()->updateOrCreate(['resident_id' => $member['resident_id']], $member);
            }

            if(!empty($to_delete)){
                $family->family_members()->whereIn('resident_id', $to_delete)->delete();
            }

            DB::commit();

            return response()->json(['success'=> 'family successfully updated'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            $errorCode = $th->getCode();
            if ($errorCode == "23000") {
                return response()->json(['error' => 'Try to save the data first'], 500);
            } else {
                // Handle other errors
                return response()->json(['error' => 'An error occurred'], 500);
            }
        }

    }

    // use to get all families base from search inputs
    // and use to populate the option
    public function families_option(Request $request){

        $searchTerm = $request->input('search');
        $options = null;
        if($searchTerm != null){
            $options = Families::query()
                ->when($searchTerm, function ($query, $searchVal){
                    $query->select('id','family_name')
                        ->where('family_name', 'LIKE', '%'.$searchVal.'%');
                })->get();
        }
        return response()->json($options);
    }

    // get the family heads and solo parents only for picking the household head
    public function get_all_famheads(Request $request){
        $searchTerm = $request->input('search');
        $options = FamilyMembers::query()
            ->when($searchTerm, function ($query, $searchVal){
                $query->whereHas('resident', function ($query) use ($searchVal){
                        $query->where('fname', 'like', '%'.$searchVal.'%')
                            ->orWhere('lname', 'like', '%'.$searchVal.'%');
                    });
            })
            ->whereIn('family_role', ['Head', 'Solo Parent'])
            ->with('resident')
            ->get();
        return response()->json($options);
    }
}
