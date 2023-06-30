<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Dashboard\ProfilingModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Profiling extends Controller
{
    //initialize validation rules
    protected array $rules = [
        'fname'     => "required|regex:/^[A-Za-z\s]+$/",
        'mname'     => 'required|regex:/^[A-Za-z\s]+$/',
        'lname'     => 'required|regex:/^[A-Za-z\s]+$/',
        'suffix'    => 'nullable|max:2|alpha',
        'dob'       => 'required|date_format:Y-m-d',
        'age'       => 'required|numeric|digits_between:1,3|max:150',
        'sex'       => 'required|alpha',
        'cstatus'   => 'required|alpha',
        'zone'      => 'required|numeric|digits:1',
        'bplace'    => "required",
        'cpnumber'  => "nullable|regex:/^09\d{9}$/",
        'email'     => 'nullable|email',
        'pwd'       => 'nullable',
        'senior'    => 'nullable',
        'deseased'  => 'nullable'
    ];

    protected array $message = [
        'dob.required'    => 'Birthday is required',
        'dob.date_format' => 'Invalid date format'
    ];

    public function __construct(
        public ProfilingModel $profilingModel
    ){
        $this->$profilingModel = $profilingModel;
    }
    public function render(){
        return view('dashboard.profiling');
    }

    public function add_profile(Request $request): JsonResponse{

        $validator = Validator::make($request->all(), $this->rules, $this->message);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $profile_data = $validator->validated();
        $profile_data['fname'] = ucwords($profile_data['fname']);
        $profile_data['mname'] = ucwords($profile_data['mname']);
        $profile_data['lname'] = ucwords($profile_data['lname']);

        // dd($profile_data);
        $this->profilingModel->fill($profile_data);
        if($this->profilingModel->save()){
            return response()->json(['success' => 'New Profile Inserted'], 200);
        }

        return response()->json(['errors' => 'Server Error'], 500);
    }


    public function update_page($id){

        // return 'test';
        $profile_data = ProfilingModel::where('id', $id)->first();
        return view('dashboard.update-profile', ['user' => $profile_data]);
    }

    public function update_profile(Request $request){

        // dd($request->all());
        $validator = Validator::make($request->all(), $this->rules, $this->message);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $resident = ProfilingModel::find($request->post('id'));

        $resident->fname = ucwords($request->post('fname'));
        $resident->mname = ucwords($request->post('mname'));
        $resident->lname = ucwords($request->post('lname'));
        $resident->suffix = $request->post('suffix');
        $resident->dob = $request->post('dob');
        $resident->age = $request->post('age');
        $resident->sex = $request->post('sex');
        $resident->cstatus = $request->post('cstatus');
        $resident->zone = $request->post('zone');
        $resident->bplace = $request->post('bplace');
        $resident->cpnumber = $request->post('cpnumber');
        $resident->email = $request->post('email');
        $resident->pwd = $request->post('pwd');
        $resident->senior = $request->post('senior');
        $resident->deseased = $request->post('deceased');

        if($resident->save()){
            return response()->json(['success' => 'Profile Updated'], 200);
        }

        return response()->json(['errors' => 'Server Error'], 500);

    }

    public function delete_profile(Request $request){

        $resident = ProfilingModel::find($request->id);

        if($resident->delete()){
            return response()->json(['success' => 'Profile Deleted'], 200);
        }

        return response()->json(['errors' => 'Server Error'], 500);
    }

    public function get_all_profiles(){

        $data = ProfilingModel::select('id','fname','mname','lname','suffix','age','sex','cstatus','zone','pwd','senior', 'deseased')->get();
        // dd($data);
        return response()->json(['users' => $data], 200);
    }
}
